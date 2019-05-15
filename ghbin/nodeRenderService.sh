#!/bin/bash

# This was in the directory as nodeRenderService2.sh
# BLARGH!
# Version 0.6.03
# 04-04-2017

# nodeRenderService.sh is Chris Trees attempt to make Blargh into a service
# NOTES:
#  1 - Service should only read from gh/XXXX_XXX_XXXXA_3danim
#  2 - Service should only write good PNG to gh/XXXX_XXX_XXXXA_rend
#  3 - Service should scan for and load project jobs
#  4 - Service should validate blender output and stay with a project job
#  5 - Sevvice should output status updates 


# s3://XXXX_XXX_XXXXA_rend - The nodes knows which buckets to look in (rend)
# s3://XXXX_XXX_XXXXA_3danim - The nodes know where the zips are, because they are in the (3danim)

# XXXX_XXX_XXXXA_3danim_v001.cfg -> .png
# The image to render is the number of the cfg.
# The name of the image is the name of the cfg.

# The bucket the image goes in is the bucket the cfg is in. 
# 1,3,5,7 etc. - Tbe step of a render doesnt render because its not there.

# METADATA IN CFG
# The blend file name should be in metadata inthe cfg.
# The zip file is the same name as the blend in the metadata in the cfg.
# The computer can only accept renders of it's type in the cfg.
# Time stamp of file creation
# Time stamp of render start (Part of Lock)
# Computer appends metadata with nodeURL in cfg (Part of Lock)

# PROJECT TEMPLATE
# This file is stored in the ghprojects bucket.
# Example Name  0183_001.tpl
# projectName='0183_001'
# seriesNumber='0183'
# showNumber='001'
# animName='_3danim'
# rendName='_rend'
# instanceType='c3.4xlarge'

# LEGACY PROJECT CFG
# This file is stored in the ghprojects bucket.
# This is a hold-over from a prior version of BLAM! This information should be integrated into the project and shot templates.
# Example Name 0183_001_0004A.cfg
# baseName='0183_001_0004A'
# seriesName='0183'
# showName='001'
# shotName='0004A'
# cfgName=$baseName'.cfg'
# animBucket=$baseName'_3danim'
# rendBucket=$baseName'_rend'
# instanceType='c3.2xlarge'
# start=675
# end=838

# SHOT TEMPLATE
# This file is currently stored in the animBucket for the shot.  It may actually be more needed in the ghprojects directory.
# Example Name 0183_001_0004.tpl
# shotName='_0004A'
# start='675'
# end='838'
# step='1'

# The following file is created from the above information as well as some version specific questions passed to the user.

# JOB CFG FORMAT
# projectTplName='0183_001.tpl'
# shotTplName='0183_001_0004A.tpl'
# baseName='0183_001_0004A'
# animBucket='0183_001_0004A_3danim'
# rendBucket='0183_001_0004A_rend'
# zip='0183_001_0004A_3danim_v122.zip'
# blend='0183_001_0004A_3danim_v122.blend'
# fileName='0183_001_0004A_3danim_v122'
# frameName='0183_001_0004A_3danim_v122.0838'
# start='838'
# end='838'
# step='1'

# The following is information that is addended to the cfg file at the time of job bidding, rendering and completion.
# blamURL='rn01'
# created='Wed Dec 14 12:50:54 CST 2016' 
# renderStart='Fri Dec  2 21:46:58 CST 2016'
# renderFinished='Fri Dec  2 21:46:58 CST 2016'


function ghDebug () {
	if [ "$debug" == 1 ]; then 
		echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>"
		echo ">>>ghadminDEBUG: $1 "
		echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>"
	fi
}

# Pass in $1 frame, $2 status
function ghRemoteStatusLog () {
	## BEGIN: Append log status of node
	local iamNode=$(hostname)
	local iamNodeLogStatusFilePath=$nodeServiceCentralLogDir"nodeStatus_$iamNode.list"
	cat <<EOF >> $iamNodeLogStatusFilePath
{"node": "$(hostname)", "dateTime": "$(date)", "frame": "$1", "status": "$2"}
EOF
	## END: Append log status of node
}

# Pass in projectJobConfig
function deployProject () {
	source $1
	echo " ___CODE: function deployProject sourced $1" >> $nodeServiceLogFileName
	echo "zipBucket is $zipBucket" >> $nodeServiceLogFileName
	echo "zipName is $zip" >> $nodeServiceLogFileName
	echo "fileName is $fileName" >> $nodeServiceLogFileName

	if [ ! -e $fileName.projectready ]
	then
		# No or wrong project so cleanup and load a new one
		rm -rf __ 0* *.tpl *.blend *.zip *.projectready rend
		# s3cmd get --force s3://$animBucket/* ~/ && unzip ~/$zipName
		cp $zipBucket$zip . && unzip $zip
		echo "Unzip complete" >> $nodeServiceLogFileName

		echo "About to check to see if the rend folder exists";
		# If the rend folder exists outside the directory structure, copy it into the directory structure.
		# if [ -e rend ]
		if [ -d "rend" ]
		then
			echo "The rend folder exists.  Moving it in the working path.";
			cp -r rend __/__/
			touch $fileName.copiedRend
		fi

		echo "About to check to see if the 000 folder exists";
		# If the 000 folder exists outside the direcotory structure, copy it into the directory structure.
		if [ -d "000" ]
		then
			touch $fileName.copiedSharedFolder
			echo "The 000 folder exists.  Moving it into the working path";
			cp -r 000 __/__/__/__/__/
		fi

		touch $fileName.projectready

		if [ -e $fileName.projectready ]
		then
			echo "currentJobProject="$fileName >> $fileName.projectready
			echo "# Project: "$fileName >> $fileName.projectready
			echo "# Date: $(date)" >> $fileName.projectready
			echo "Loaded Project "$fileName" on $(date)" >> $nodeServiceLogFileName
			ghRemoteStatusLog $frameName "ProjectLoaded"
		else
			echo "Project Deploy Error." >> $nodeServiceLogFileName
			ghRemoteStatusLog $frameName "ERROR-ProjectLoad"
			exit
		fi
	else
		echo "Project was Ready: $fileName.projectready" >> $nodeServiceLogFileName
	fi
}

function cleanUpHome {
	echo " ___CODE: function cleanUpHome" >> $nodeServiceLogFileName
	ghDebug "Cleaning up the home directory."
	rm -rf *.cfg *.png *.tpl *.old *.lock
	# rm -rf ~/*.cfg ~/*.png ~/*.2s3 ~/*.tpl ~/*.old ~/*.go
	# s3cmd get s3://ghprojects/*.cfg .
	# cp -p /media/projects/gh/ghprojects/*.cfg .
}

function beginRender () {
	source $1
	echo " ___CODE: function beginRender sourced $1" >> $nodeServiceLogFileName
	echo "fileName is $fileName" >> $nodeServiceLogFileName
	echo "frameName is $frameName" >> $nodeServiceLogFileName
	echo "blend is $blend" >> $nodeServiceLogFileName

	nodeType = 2 ;

	ghRemoteStatusLog $frameName "renderBegin"

	if [ "$nodeType" == "1" ] && [ -e ~/$blend ] && [ ! -e ~/badBlender.txt ]; then
		echo "blender server mode started: $(date)" >> $nodeServiceLogFileName
		blender -b $blend -y -F PNG -o $fileName.#### -s $start -e $end -j $step -t 0 -a > $nodeServiceBlenderLogFileName
		#echo "BlenderCommand: blender -b $blend -F PNG -o $fileName.#### -s $start -e $end -j $step -t 0 -a"
		#echo "BlenderSimFile" >> $frameName.png
		echo "blender server ended: $(date)" >> $nodeServiceLogFileName
	elif [ "$nodeType" == "2" ] && [ -e ~/$blend ] && [ ! -e ~/badBlender.txt ]; then
		echo "blender desktop mode started: $(date)" >> $nodeServiceLogFileName
		blender -b $blend -y -F PNG -o $fileName.#### -t 0 -f $start > $nodeServiceBlenderLogFileName
		#echo "BlenderCommand: blender -b $blend -F PNG -o $fileName.#### -t 0 -f $start"
		echo "blender desktop ended: $(date)" >> $nodeServiceLogFileName
	else
		echo "Command given falls outside of expectations" >> $nodeServiceLogFileName
		echo "nodeRenderService Exit on $(date)" >> $nodeServiceLogFileName
		ghRemoteStatusLog $frameName "ERROR-RenderBeginParm-EXIT"
		exit
	fi
	
	# file=file.txt
	minimumsize=1
	actualsize=$(wc -c <"$frameName.png")
	if [ $actualsize -ge $minimumsize ]; then
		echo "size is over $minimumsize bytes" >> $nodeServiceLogFileName
		chmod 666 $frameName.png
		cp -p $frameName.png $rendBucket$frameName.png 
		ghRemoteStatusLog $frameName "renderFinished"
	else
		echo "Blender did not produce a good image" > badBlender.txt
		echo "Blender did not produce a good image nodeRenderService exit on $(date)" >> $nodeServiceLogFileName
		#something bad happened exit blargh.
		ghRemoteStatusLog $frameName "ERROR-FrameRenderBadBlender-exit"
		exit
	fi
	echo "About to exit renderJob"
	#echo "About ready to clean up the home directory" >> $nodeServiceLogFileName
	#cleanUpHome
}


# pass the base name as a parameter
function checkProjectJob () {
	source $1
	frameLockFile=$rendBucket$frameName.lock
	echo "CheckingFrameLock: $frameLockFile" >> $nodeServiceLogFileName
	if [ -e $frameLockFile ] 
	then
		echo "Moving to next, lock found on "$frameLockFile >> $nodeServiceLogFileName
	else
		echo "found file to render" >> $nodeServiceLogFileName
		echo "Create Bid Lock for: "$frameLockFile >> $nodeServiceLogFileName
		(umask 002; touch $frameLockFile)
		local bidLock="blamURL=$(hostname)"
		local bidCreated="bidCreated='$(date)'"
		echo $bidLock >> $frameLockFile
		sleep 1
		local readLock=`cat $frameLockFile`
		echo "diff $readLock $bidLock" >> $nodeServiceLogFileName
		local diffCheckResults=$( cmp -s $readLock $bidLock )
		local diffReturnChars=${#diffCheckResults}
		ghDebug $diffCheckResults
		ghDebug $diffReturnChars
		if [ "$diffReturnChars" == 0 ]
		then
			echo "Files Match BID WIN begin work on $frameName" >> $nodeServiceLogFileName
			local bidWon="bidWon='$(date)'"
			echo $bidCreated >> $frameLockFile
			echo $bidWon >> $frameLockFile
			rm *.cfg
			cp $rendBucket$frameName.cfg .
			deployProject $frameName.cfg
			beginRender $frameName.cfg
		else
			echo "Files different BID FAIL moving on to next frame" >> $nodeServiceLogFileName
		fi
	fi
}


function getProject () {
	# Read jobPriority.list file into array to scan projects for work
	listOfJobs=`cat $nodeFileOfJobPrior`
	echo " ___CODE: function getProject" >> $nodeServiceLogFileName
	echo "fileOfJobPrior: "$nodeFileOfJobPrior >> $nodeServiceLogFileName
	for line in $listOfJobs; do
		echo "$line"
		case $line in
			allstop)
				echo "jobPriority.list is at allstop exit service on: $(date)" >> $nodeServiceLogFileName
				ghRemoteStatusLog "jobPriority.list-allstop" "ServiceStopping"
				exit
				;;
			rescan)
				echo "jobPriority.list is rescanning at: $(date)" >> $nodeServiceLogFileName
				# ghRemoteStatusLog "jobPriority.list-rescan" "ServiceJobListScan"
				break
				;;
			*)
				currentScanPath=($nodeAssetsPath$line)
				echo "setting current job project to: "$currentScanPath >> $nodeServiceLogFileName
				echo "Loading currentScanPath job project on $(date)" >> $nodeServiceLogFileName
				echo "currentScanPathConfigFilePath is: "$currentScanPath >> $nodeServiceLogFileName
				if [ -f ${currentScanPath[0]} ]
				then
					echo "Scanning Project"
					for currentJobToCheck in $( ls -A $nodeAssetsPath$line ); do
						echo " ___CODE: CALL function checkProjectJob $currentJobToCheck" >> $nodeServiceLogFileName
						# ghRemoteStatusLog $rendBucket "ScanRendBucket"
						checkProjectJob $currentJobToCheck
					done
				else
					echo "ERROR: Unknown jobPriority.List command or project on: $(date)"  >> $nodeServiceLogFileName
					echo "ERROR: no match - "$line  >> $nodeServiceLogFileName
					# ghRemoteStatusLog $line "ERROR-UnknownCommand_$line"
				fi
				;;
		esac
	done
}

#####
##### Main
#####

# Program has been created with the assumption it is running from the home directory.  Making it so.
cd
scanProjectsLoop=0
scanClearLogs=3
nodeAssetsPath='/media/gh/'
nodeServiceCentralLogDir=$nodeAssetsPath'ghlogs/'
ghRemoteStatusLog "noFrame" "ServiceBegin"
echo $(hostname) >> $nodeServiceCentralLogDir'gridNodes.list'
while true
do
	let "scanProjectsLoop++"
	let "scanClearLogs++"
	# Load config or set defaults
	if [ -f ".nodeRenderServiceConfig" ]
	then
		echo "Loading .nodeRenderServiceConfig"
		source .nodeRenderServiceConfig
	else
		debug=0
		nodeType=1
		nodeAssetsPath='/media/gh/'
		nodeProjectsConfigDir=$nodeAssetsPath'ghprojects/'
		nodeFileOfJobPrior="$nodeProjectsConfigDir/jobPriority.list"
		nodeScanLoopSleepTime=10
		nodeServiceLogFileName='nodeService.log'
		nodeServiceBlenderLogFileName='nodeServiceBlender.log'
		nodeServiceCentralLogDir=$nodeAssetsPath'ghlogs/'
		nodeLogResetLoopCount=3
	fi
	# Log maintainance
	if [ $scanClearLogs -gt $nodeLogResetLoopCount ]
	then
		cd
		rm *.log
		scanClearLogs=0
		touch $nodeServiceLogFileName
		ghDebug "Writting $nodeServiceLogFileName"
		# Create current Status File
		echo "  Current Node Settings: $(date)" >> $nodeServiceLogFileName
		echo "  Current Loop Count: "$scanProjectsLoop >> $nodeServiceLogFileName
		echo "  nodeRenderServiceConfigValues" >> $nodeServiceLogFileName
		echo "  =============================" >> $nodeServiceLogFileName
		echo "  nodeType is used for blender command mod where 1 - server 2 - desktop" >> $nodeServiceLogFileName
		echo "  current nodeType: "$nodeType >> $nodeServiceLogFileName
		echo "  -----------------------------" >> $nodeServiceLogFileName
		echo "  nodePath is used by node to access project configs and job assets" >> $nodeServiceLogFileName
		echo "  current nodePath: "$nodeAssetsPath >> $nodeServiceLogFileName
		echo "  -----------------------------" >> $nodeServiceLogFileName
		echo "  nodeProjectConfigDir is used by node to access project" >> $nodeServiceLogFileName
		echo "  current nodeProjectConfigDir: "$nodeProjectsConfigDir >> $nodeServiceLogFileName
		echo "  -----------------------------" >> $nodeServiceLogFileName
	fi
	echo "Current Loop Count: "$scanProjectsLoop
	ghDebug "GETTING PROJECT"
	getProject
	echo "LoopSleep for "$nodeScanLoopSleepTime
	# ghRemoteStatusLog "noFrame" "ScanSleep$nodeScanLoopSleepTime"
	sleep $nodeScanLoopSleepTime
	cleanUpHome
done

ghRemoteStatusLog "noFrame" "ServiceStopping"
ghDebug "Node Render service Stopping..."
