#!/bin/bash

# pngService
# Version 0.1.1
# 04-26-2017


# This script should be run to take all of the shots on the G: drive that have completed rendering 
# and process them into MP4 files.  The mp4 files would then be transferred over to _dailies and the
# respective movies folder for the shot/element.

# This is an example command that uses ffmpeg to process image sequences into an mp4 
# ffmpeg -framerate 25 -i image-%05d.jpg -c:v libx264 -profile:v high -crf 20 -pix_fmt yuv420p output.mp4

# The assumption being made is that if all the CFG's for a basename then the shot is "complete"
# and can be converted into an mp4 as long as a mp4 does not already exist, or one is not 
# currently being created.

# Foreach directories in /media/farm/ that end with _rend
# function rendFoldersList () {

# 	while read rendFolders
# 	do
# 		echo "rendFolders is $rendFolders"
# 	done < <( ls -1 /media/farm/ | grep "_rend" )
# }

# listRendFolders

# <<<<<<<<<< Render folder functions >>>>>>>>>>

function listRendFolders () {

	if [ -e temp/listRendFolders.txt ]
	then
		rm -rf temp/listRendFolders.txt
	fi

	# local count=1

	while read rendFolders
	do
		# rendFoldersList[$count]=$rendFolders
		echo "$rendFolders" >> temp/listRendFolders.txt
		# count=$($count+1))
	done < <( ls -1 /media/farm/ | grep "_rend" )
}

# Test of function
# listRendFolders

function selectRendFolder() {

        while read rendFolder
        do
                echo "$rendFolder"
        done < <( sed -n $1p temp/listRendFolders.txt )

	# rendFolder=$rendFoldersList[$1]

        echo $rendFolder
}

echo "selecting rendFolder"

# Test of function
# selectRendFolder 2


# <<<<<<<<<< Series Functions >>>>>>>>>>

function listSeries () {

	if [ -e temp/listSeries.txt ]
	then
		rm -rf temp/listSeries.txt
	fi

	local count=1

	while read series
	do
		# seriesList[$count]=$series
		echo "$series" >> temp/listSeries.txt
		# count=$(($count+1))
	done < <( cat temp/listRendFolders.txt | awk -F "_" '{print $1}' | sort -u )
}

# echo "Writing a list of series to disk"
# Test of function
# listSeries

function totalSeries () {
	listSeries

        while read numberOfSeries
        do
                echo $numberOfSeries
        done < <( wc -l temp/listSeries.txt  | awk '{print $1}')
}

# echo "The total number of series is"
# Test of function
# totalSeries


# Determine the seriesNumber
function selectSeries () {
	listSeries

	while read series
	do
		echo $series
	done < <( sed -n $1p temp/listSeries.txt )

	# seriesList[$1]
	# echo $series
}

# echo "selecting series"
# Test of function
# selectSeries 2

# <<<<<<<<<< Show Functions >>>>>>>>>>

function listShows () {
	# selectSeries $1 series
	series=$(selectSeries $1)
	if [ -e temp/listShows.txt ]
	then
		rm  -rf temp/listShows.txt
	fi

	while read shows
	do
		echo "$shows" >> temp/listShows.txt
	done < <( cat temp/listRendFolders.txt | grep $series\_ | sort -u | awk -F "_" '{print $1"_"$2}' | sort -u)
}

# echo "Writing a list of shows to disk."
# Test of function
# listShows 2

function totalShows () {
	listShows $1

	while read numberOfShows
	do
		echo $numberOfShows
	done < <( wc -l temp/listShows.txt  | awk '{print $1}')
}

# echo "totalShows"
# Test of function
# totalShows 2

# Determine the showNumber
function selectShow () {
	listShows $1

	while read show
	do
		echo $show
        done < <( sed -n $2p temp/listShows.txt | awk -F "_" '{print $2}' )
}

# echo "selecting show"
# Test of function
# selectShow 2 1

# Determine the projectNumber
function selectProject () {
        listShows $1

        while read project
        do
                echo $project
        done < <( sed -n $2p temp/listShows.txt )
}

# echo "selecting project"
# Test of function
# selectProject 2 1

# Deternime the bucketName
function selectRendBucket (){
	local shotName=$(selectShot $1 $2 $3)

	local rendBucketName=$shotName\_rend
	echo $rendBucketName
}

# Deternime the zipBucketName
function selectZipBucket (){
        local shotName=$(selectShot $1 $2 $3)

        local zipBucketName=$shotName\_zip
        echo $zipBucketName
}

# List Shots/Elements
function listShots () {
        # selectSeries $1 series
        seriesNumber=$(selectSeries $1)
	# echo "series number is $series"
	showNumber=$(selectShow $1 $2)
	# echo "show number is $show"
	projectName=$(selectProject $1 $2)
	# echo "projectName is $projectName"
        if [ -e temp/listShots.txt ]
        then
                rm  -rf temp/listShots.txt
        fi

        while read shots
        do
                echo "$shots" >> temp/listShots.txt
        done < <( cat temp/listRendFolders.txt | grep $projectName | awk -F "_" '{print $1"_"$2"_"$3}' | sort -u)
}

# echo  "Writing a list of shots to disk"
# Test of function
# listShots 2 2

# Total Shots/Elements
function totalShots () {
	listShots $1 $2

        while read totalShots
        do
                echo $totalShots
        done < <( wc -l temp/listShots.txt  | awk '{print $1}')
}

# echo "totalShots"
# Test of function
# totalShots 2 2

# Select Shot/Element

function selectShot () {
        listShots $1 $2

        while read shot
        do
                echo $shot
        done < <( sed -n $3p temp/listShots.txt )
}

# echo "Selecting shot"
# Test of function
# selectShot 2 2 3

# List All Bucket Files
function listBucketFiles () {
        shotName=$(selectShot $1 $2 $3)
        # echo "shotName is $shotName"

	if [ -e temp/listBucketFiles.txt ]
	then
		rm -rf temp/listBucketFiles.txt
	fi

        while read bucketFiles
        do
                echo $bucketFiles >> temp/listBucketFiles.txt
        done < <( ls -1 /media/farm/$shotName\_rend/ )
}

# echo "Writing list of all bucket files to disk"
# Test of function
# listBucketFiles 3 2 1


# List Verisons
function listBasenames () {
	shotName=$(selectShot $1 $2 $3)
	# echo "shotName is $shotName"

	if [ -e temp/listBasenames.txt ]
	then
		rm -rf temp/listBasenames.txt
	fi

	touch temp/listBasenames.txt

	while read basenames
	do
		echo $basenames >> temp/listBasenames.txt
	done < <( ls -1 /media/farm/$shotName\_rend/  | awk -F "." '{print $1}' | sort -u )
}

# echo "Writing basenames to disk"
# Test of function
# listBasenames 3 2 1

# Select Basename
function selectBasename () {
	basename=$(listBasenames $1 $2 $3)

	while read baseName
	do
		echo $baseName
	done < <( sed -n $4p temp/listBasenames.txt )
}

# echo "Basename is"
# Test of function
# selectBasename 3 2 1 1

# Total Basenames

function totalBasenames () {
        listBasenames $1 $2 $3
	totalBasenames=0

        while read totalBasenames
        do
                echo $totalBasenames
        done < <( wc -l temp/listBasenames.txt  | awk '{print $1}')
}

# echo "Total basenames"
# Test of function
# totalBasenames 3 2 1

# List Verisons
function listFrames () {
        basename=$(selectBasename $1 $2 $3 $4)
        # echo "shotName is $shotName"

        if [ -e temp/listFrames.txt ]
        then
                rm -rf temp/listFrames.txt
        fi

	# Make an empty file to populate
        touch temp/listFrames.txt

        while read frames
        do
                echo $frames >> temp/listFrames.txt
        done < <( ls -1 /media/farm/$shotName\_rend/ | grep $basename | grep png | awk -F "." '{print $2}' | sort -u )
}

# Select Frame
function selectFrame () {
        frames=$(listFrames $1 $2 $3 $4 $5)

        while read frame
        do
                echo $frame
        done < <( sed -n $5p temp/listFrames.txt )
}

# Select Start Frame
function selectStartFrame () {
        frames=$(listFrames $1 $2 $3 $4)

        while read frame
        do
                echo $frame
        done < <( sed -n 1p temp/listFrames.txt )
	# Other options
	# head -n 1
}

# Select End Frame
function selectEndFrame () {
        frames=$(listFrames $1 $2 $3 $4)

        while read frame
        do
                echo $frame
        done < <( sed '$!d' temp/listFrames.txt )
	# Other options
	# tail -n 1
	# awk 'END { print }'
}

# Get Step ( Requires a step of 1 or 2)
function getStep () {
	# listFrames $1 $2 $3 $4

	startFrame=$(selectStartFrame $1 $2 $3 $4)
	endFrame=$(selectEndFrame $1 $2 $3 $4)
	totalFrames=$(totalFrames $1 $2 $3 $4)
	frameRange=$(($endFrame-$startFrame+1))
	steppedRange=$((($endFrame-$startFrame+2)/2))

	if [ $totalFrames -eq $frameRange ]
	then
		step=1
		echo "$step"
	elif [ $totalFrame -eq $steppedRange ]
	then
		step=2
		echo "$step"
	else
		step=0
		echo "$step"
	fi
}

# Total Frames
function totalFrames () {
        listFrames $1 $2 $3 $4
        totalFrames=0

        while read totalFrames
        do
                echo $totalFrames
        done < <( wc -l temp/listFrames.txt  | awk '{print $1}')
}

# Does an MP4 Exist?
function mp4Exist () {
	local shotName=$(selectShot $1 $2 $3)
	# echo "shotname is $shotName"
	local rendBucketName=$shotName\_rend
	# echo "rendBucketName is $rendBucketName"
	local basename=$(selectBasename $1 $2 $3 $4)
	# echo "basename is $basename"
	local mp4Path=/media/farm/$rendBucketName/$basename.mp4
	# echo "mp4Path is $mp4Path"
	if [ -e $mp4Path ]
	then
		# echo "mp4 exists"
		echo "1"
	else
		# echo "mp4 does not exist"
		echo "0"
	fi
}

# Test of function
# mp4Exist 3 2 1 1

# Does an MP4 Lock Exist?
function mp4LockExist () {
        local shotName=$(selectShot $1 $2 $3)
        # echo "shotname is $shotName"
        local rendBucketName=$shotName\_rend
        # echo "rendBucketName is $rendBucketName"
        local basename=$(selectBasename $1 $2 $3 $4)
        # echo "basename is $basename"
        local mp4Path=/media/farm/$rendBucketName/$basename.mp4Lock
        # echo "mp4Path is $mp4Path"
        if [ -e $mp4Path ]
        then
                # echo "mp4 lock exists"
		echo "1"
        else
                # echo "mp4 lock does not exist"
		echo "0"
        fi
}

# Test of function
# mp4LockExist 3 2 1 1

# Pad a number to 4 positions
function paddedNumber () {
	local paddedNumber
	if [ $2 -eq 3 ]
	then
		paddedNumber=echo $(printf "%03d" $1)
		echo $paddedNumber
	elif [ $2 -eq 4 ]
	then
                paddedNumber=echo $(printf "%04d" $1)
                echo $paddedNumber
	else
                paddedNumber=echo $(printf "%05d" $1)
                echo $paddedNumber
	fi
}

# paddedNumber 32 4

# Does a CFG and a PNG have a matching pair?
function matchCFGPNG () {
	local projectName=$(selectProject $1 $2 $3)
	# echo "projectName is $projectName"
	local rendBucketName=$(selectRendBucket $1 $2 $3)
	# echo "rendBucketName is $rendBucketName"
	local ghPath=/media/farm/$rendBucketName/
	local basename=$(selectBasename $1 $2 $3 $4)
	# echo "basename to match is $basename"
	local imageMatch=0
	# local padddedNumber=$(paddedNumber $1 $6)
	# echo "paddedNumber is $paddedNumber"

	local cfgName=$basename.$5.cfg
	# echo "cfgPath is $ghPath$cfgName"
	local cfgExists=0
	# echo "cfgExists is $cfgExists"
        local pngName=$basename.$5.png
        # echo "pngName is $ghPath$pngName"
	local pngExists=0
	# echo "pngExists is $pngExists"

	if [ -e $ghPath$cfgName ]
	then
		cfgExists=1
	fi

	if [ -e $ghPath$pngName ]
	then
		pngExists=1
	fi

	if [ $cfgExists -eq 1 ] && [ $pngExists -eq 1 ]
	then
		# A CFG and PNG both exist
		echo "1"
	else
		# A CFG and PNG DON'T both exist
		echo "0"
	fi
}

# Test of function
# matchCFGPNG 3 2 1 1 0191 4

function selectDailiesDate () {
	dailiesDate=`date --date="next day" +%m_%d_%Y`
	echo "$dailiesDate"
}

function main () {
        # Cleaning up the temp directory
        rm -rf /media/farm/ghbin/grender/temp/*

	# create a list of all the rend folders on the G drive.
	listRendFolders
	listSeries

	local totalSeries=$(totalSeries)
	echo "total Series is $totalSeries"
	local totalShows
	local totalShots
	local totalBasenames

	local seriesNumber
	local showNumber
	local projectName
	local shotName
	local rendBucket
	local basename
#	local mp4Exist=1
#	local mp4LockExist=1
	local startFrame
	local endFrame

	local renderComplete

        local ghPath

	# while [ $currentSeries -le $totalSeries ]
	for ((currentSeries=1;currentSeries<=totalSeries;currentSeries++))
	do
		# Do Series Stuff
		echo "currentSeries is $currentSeries"
		seriesNumber=$(selectSeries $currentSeries)
		echo "current seriesNumber is $seriesNumber"
		totalShows=$(totalShows $currentSeries)
		# while [ $currentShow -le $totalShows ]
		for ((currentShow=1;currentShow<=totalShows;currentShow++))
		do
			# seriesNumber=$(selectSeries $currentSeries)
                	# echo "current seriesNumber is $seriesNumber"
			# Do Show Stuff
			showNumber=$(selectShow $currentSeries $currentShow)
			echo "current showNumber is $showNumber"
			projectName=$(selectProject $currentSeries $currentShow)
			totalShots=$(totalShots $currentSeries $currentShow)
			for ((currentShot=1;currentShot<=totalShots;currentShot++))
			do
				# Do Shot Stuff
				shotName=$(selectShot $currentSeries $currentShow $currentShot)
				echo "current shotNumber is $shotName"
				rendBucket=$(selectRendBucket $currentSeries $currentShow $currentShot)
				echo "current rendBucket is $rendBucket"
				totalBasenames=$(totalBasenames $currentSeries $currentShow $currentShot)
				echo "totalBasenames is $totalBasenames"
				if [ "$totalBasenames" -gt 0 ]
				then
					for ((currentBasename=1;currentBasename<=totalBasenames;currentBasename++))
					do

				                # echo "currentSeries is $currentSeries"
						# seriesNumber=$(selectSeries $currentSeries)
						# echo "current seriesNumber is $seriesNumber"

						# Do Basename Stuff
						basename=$(selectBasename $currentSeries $currentShow $currentShot $currentBasename)
						echo "current basename is $basename"
						ghPath=/media/farm/$rendBucket/
						echo "ghPath is $ghpath"

						# Get the shots movies production path. 
						# projectMoviesPath=/media/projects/$seriesNumber/$showNumber/prod/$shotName/movies/
						# echo "projectMoviesPath is $projectMoviesPath"

						# Get the image sequence production path.
						projectRendPath=/media/projects/$seriesNumber/$showNumber/prod/$shotName/rend/$basename/
						echo "projectRendPath is $projectRendPath"

						# Determine the dailies folder.
						# dailiesDate=$(selectDailiesDate)
						# dailiesPath=/media/projects/_dailies/$projectName/$dailiesDate/

						# We are making the assumption that the render is complete, and then the filesystem has to prove it isn't.
						renderComplete=1

						# We are making the assumption that an mp4 already exists and the filesystem has to prove it doesn't.
						# mp4Exist=1

						# We are making the assumption that an mp4Lock file exists and the filesystem has to prove it doesn't.
						# mp4LockExist=1

						# Foreach basename check if a MP4 is not already made.
						# mp4Exist=$(mp4Exist $currentSeries $currentShow $currentShot $currentBasename)
						# mp4LockExist=$(mp4LockExist $currentSeries $currentShow $currentShot $currentBasename)

						# Select First Frame
						startFrame=$(selectStartFrame $currentSeries $currentShow $currentShot $currentBasename)
						echo "startFrame is $startFrame"

						# Select Last Frame
						endFrame=$(selectEndFrame $currentSeries $currentShow $currentShot $currentBasename)
						echo "endFrame is $endFrame"

						# Determine the padding for the frame sequence
						padding=${#startFrame}
						echo "padding is $padding"

						# There is no lock file for this basename. Let's make one.
						# touch $ghPath/$basename.mp4Lock
						# echo "ghPath is $ghPath"
						# echo "current basename is $basename"

						# Foreach frame
						totalFrames=$(totalFrames $currentSeries $currentShow $currentShot $currentBasename)
						# If totalFrames is equal to ($endFrame - $startFrame) + 1. The $step is 1

						# Else If totalFrames is equal to (($endFrame - $startFrame) + 2)/2. The $step is 2
						echo "totalFrames is $totalFrames"
						if [ "$totalFrames" -gt 0 ]
						then
							for ((currentFrame=1;currentFrame<=totalFrames;currentFrame++))
							do
								frame=$(selectFrame $currentSeries $currentShow $currentShot $currentBasename $currentFrame)
								echo "checking $basename.$frame.png"
								# Foreach basename check if all CFG's have a corresponding PNG file.  If they do we know we can
								# proceed in making an MP4
								matchCFGPNG=$(matchCFGPNG $currentSeries $currentShow $currentShot $currentBasename $frame)
								if [ "$matchCFGPNG" -eq 0 ]
								then
									echo "Found a CFG that doesn't have a corresponding PNG. This shot is still rendering."
									renderComplete=0
									break
								fi
							done

							if [ "$renderComplete" -eq 1 ]
							then
							# touch $ghPath$basename.mp4Lock
							# echo "Starting to process an mp4"
							# 1. Make the mp4 on the G drive.
							# ffmpeg -framerate 23.976 -i $ghPath$basename.%0$padding\d.png  -c:v libx264 -profile:v high -crf 20 -pix_fmt yuv420p $ghPath$basename.mp4
							# ffmpeg -framerate 23.976 -start_number $startFrame -i $ghPath$basename.%0$padding\d.png -v $totalFrames -c:v libx264 -crf 20  -pix_fmt yuv420p $ghPath$basename.mp4
							# if [ -e $ghPath$basename.mp4 ]
							# then
							# echo "Completed processing an mp4. Transferring the mp4 to the projects movie folder"
							# 2. Get the shots movies production path.
							#cp $ghPath$basename.mp4 $projectMoviesPath$basename.mp4
							# 5. If the dailies folder doesn't already exist, make it.
							# if [ -d $dailiesPath ]
							# then
							# 			echo "dailies folder existed already"
							#		else
							#			echo "dailies folder didn't exist. Making it."
							#			mkdir $dailiesPath
							#		fi
							# 		echo "Transferring the mp4 to the show's dailies folder"
							# 6. Copy the mp4 from the G drive to the dailies folder.
							# 		cp $ghPath$basename.mp4 $dailiesPath$basename.mp4
								# If the production output folder doesn't already exist, make it.
								if [ -d $projectRendPath ]
								then
									echo "The directory for the render existed already."
								else
									echo "The directory for the render didn't exist.  Creating it."
									mkdir $projectRendPath
									chmod 777 $projectRendPath
								fi
								# Transfer the PNG sequence to the output folder.
								# !!!!!!!!!! This needs to be changed into a for each frame process !!!!!!!!!!
		                                                for ((currentFrame=1;currentFrame<=totalFrames;currentFrame++))
								do
									frame=$(selectFrame $currentSeries $currentShow $currentShot $currentBasename $currentFrame)
									echo "copying $ghPath$basename.$frame.png to $projectRendPath"
									# Foreach basename check if all CFG's have a corresponding PNG file.
									# proceed in transferring the PNG to the Z drive.
									cp $ghPath$basename.$frame.png $projectRendPath
								done
								# cp $ghPath$basename.*.png $projectPath
								# 10. Move on to the next shot.
							fi
							# else
							# 	echo "There is a mp4Lock file. The basename is currently being converted."
							# fi
						# else
						# 	echo "A mp4 does not exist."
						fi
					done
				else
					echo "There are no basenames for this bucket"
				fi
			done
		done
	done
}

main

# Foreach basename check if all CFG's have a corresponding PNG file.  If they do we know we can
# proceed in making an MP4
# Create a mp4Lock file named something like $basename.mp4Lock

# Check the database for the frames per second and save it as $framerate.
# Check to see if the step is 1, 2 or some other number.
# Save the step as $step
# If the step is something other than 1, index the numbers.
# This should be done by copying the proceeding odd frame to the second even and so on.  1 is copied to 2, 3 is copied to 4, etc.

# Once the frames are in a complete numeric set the mp4 can be made.

# After the conversion is complete.
# 1. Place the mp4 in the next days dailies folder.
# 2. Place the mp4 in the shot/elements movies folder.
# 3. Make the directory for the PNG sequence in /media/projects/... if necessary
# 4. Copy the PNG sequence into the direcory on /media/projects/...

# Complete.

