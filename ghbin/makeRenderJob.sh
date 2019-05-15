#!/bin/bash

# makeRenderJob.sh
#
# This script creates the cfg file required to render each frame.
# This script asks the user to verify source and output before cfg generation
# REQUIRED: the four vars below

projectName='0188_001'
projectShotName='_0026A'
projectShotVersion='_v009'
projectSubelementName=''
projectDivisionType='_3danim'
controlPath='/media/gh/'
nodePath='/media/gh/'

#projectSeriesName='0183'
#projectShowName='_001'
#projectShotName='_0002A'
#projectShotVersion='_v182'

## Below should not change
##
#projectRendDir='_rend/'
#projectAnimDir='_anim/'
#projectTypeName='_3danim'
projectTemplateExtention='.tpl'
#projectConfigExtention='.cfg'
#projectBlendExtention='.blend'
#projectZipExtention='.zip'

#projectName=$projectSeriesName$projectShowName
#projectJobName=$projectName$projectShotName

#projectJobOutputName=$projectJobAssetName$projectShotVersion

#projectJobZipFileName=$projectJobAssetName$projectShotVersion$projectZipExtention
#projectJobBlendFileName=$projectJobAssetName$projectShotVersion$projectBlendExtention

projectsDir='ghprojects/'

projectTemplate=$projectName$projectTemplateExtention
projectShotTemplate=$projectName$projectShotName$projectTemplateExtention
projectShotVersionTemplate=$projectName$projectShotName$projectDivisionType$projectShotVersion$projectTemplateExtention

scriptsDir='ghbin/'

controlScriptsDir=$controlPath$scriptsDir
controlProjectsDir=$controlPath$projectsDir

nodeScriptsDir=$nodePath$scriptsDir
nodeProjectsDir=$nodePath$projectsDir

#Pickup Project Template
projectTemplatePath=$controlProjectsDir$projectTemplate
echo 'Source the Project Template: '$projectTemplatePath
echo "This OK? [YES][no]"
read projectTemplateAnswerOK
if [ "$projectTemplateAnswerOK" == "YES" ] || [ "$projectTemplateAnswerOK" == "" ]
then
    source $projectTemplatePath
else
    echo "Quit makeProject, nothing done."
    exit
fi

#Pickup ProjectShot Template
projectShotTemplatePath=$controlProjectsDir$projectShotTemplate
echo 'Source ProjectShot Template: '$projectShotTemplatePath
echo "This OK? [YES][no]"
read projectConfigAnswerOK
if [ "$projectConfigAnswerOK" == "YES" ] || [ "$projectConfigAnswerOK" == "" ]
then
    source $projectShotTemplatePath
else
    echo "Quit makeProject, nothing done."
    exit
fi

#Pickup ProjectShotVersion Template
#Pickup ProjectShot Template
projectShotVerTemplatePath=$controlPath$projectName$shotName$zipName/$projectShotVersionTemplate
echo 'Source the Version Template: '$projectShotVerTemplatePath
echo "This OK? [YES][no]"
read projectConfigAnswerOK
if [ "$projectConfigAnswerOK" == "YES" ] || [ "$projectConfigAnswerOK" == "" ]
then
    source $projectShotVerTemplatePath
else
    echo "Quit makeProject, nothing done."
    exit
fi

projectAssetsPath=$controlPath$projectName$shotName$zipName
projectOutputPath=$controlPath$projectName$shotName$rendName

nodeAssetsPath=$nodePath$projectName$shotName$zipName
nodeOutputPath=$nodePath$projectName$shotName$rendName

fileName=$projectName$shotName$projectSubelementName$projectDivisionType$shotVersion

echo "Render Source from: "$projectAssetsPath
echo "Output Job cfgs to: "$projectOutputPath

echo "Node Render Source: "$nodeAssetsPath
echo "Node Output Frames: "$nodeOutputPath


echo "projectJobOutputName: "$fileName

echo "projectTemplate='$projectTemplatePath'"
echo "projectShotTemplatePath='$projectShotTemplatePath'"
echo "projectShotVerTemplatePath='$projectShotVerTemplatePath'"
echo "zipBucket='$projectAssetsPath'"
echo "rendBucket='$projectOutputPath'"
echo "zip='$zip'"
echo "blend='$blend'"
echo "fileName='$fileName'"
echo "frameName='$fileName.####'"
echo "start='$start'"
echo "end='$end'"
echo "step='$step'"
echo "created='$(date)'"

answerDefault="yes"
echo "Is this ok? [YES][no]"
read answer

if [ "$answer" == "yes" ] || [ "$answer" == "Yes" ] || [ "$answer" == "YES" ] || [ "$answer" == "y" ] || [ "$answer" == "Y" ] || [ "$answer" == "" ]
then
	#rm -rf $frameName
	#mkdir $frameName
	# for i in {"$start".."$end"}
	for ((i=$start; i<=$end; (i=$i+$step)))
	do
		framePadded=$(printf "%04d" $i)
		frame=$i
		frameConfigOutputFile=$projectOutputPath/$fileName.$framePadded.cfg

		echo "zipBucket='$nodeAssetsPath/'" >> $frameConfigOutputFile
		echo "rendBucket='$nodeOutputPath/'" >> $frameConfigOutputFile
		echo "zip='$zip'" >> $frameConfigOutputFile
		echo "blend='$blend'" >> $frameConfigOutputFile
		echo "fileName='$fileName'" >> $frameConfigOutputFile
		echo "frameName='$fileName.$framePadded'" >> $frameConfigOutputFile
		echo "start='$frame'" >> $frameConfigOutputFile
		echo "end='$frame'" >> $frameConfigOutputFile
		echo "step='$step'" >> $frameConfigOutputFile
		echo "created='$(date)'" >> $frameConfigOutputFile
		# cat $tplName >> $frameName/$frameName.$framePadded.cfg
	done
else
	echo "Command is cancelled."
	exit
fi

