#!/bin/bash

# This was saved as mp4Service2.sh
# mp4Service
# Version 0.1
# 04-04-2017


# This script should be run to take all of the shots on the G: drive that have completed rendering 
# and process them into MP4 files.  The mp4 files would then be transferred over to _dailies and the
# respective movies folder for the shot/element.

# This is an example command that uses ffmpeg to process image sequences into an mp4 
# ffmpeg -framerate 25 -i image-%05d.jpg -c:v libx264 -profile:v high -crf 20 -pix_fmt yuv420p output.mp4

# The assumption being made is that if all the CFG's for a basename then the shot is "complete"
# and can be converted into an mp4 as long as a mp4 does not already exist, or one is not 
# currently being created.

# Foreach directories in /media/gh/ that end with _rend
# function rendFoldersList () {

# 	while read rendFolders
# 	do
# 		echo "rendFolders is $rendFolders"
# 	done < <( ls -1 /media/gh/ | grep "_rend" )
# }

# listRendFolders

# <<<<<<<<<< Render folder functions >>>>>>>>>>

function listRendFolders () {

	if [ -e temp/listRendFolders.txt ]
	then
		rm -rf temp/listRendFolders.txt
	fi

	while read rendFolders
	do
		echo "$rendFolders" >> temp/listRendFolders.txt
	done < <( ls -1 /media/gh/ | grep "_rend" )
}

listRendFolders

function selectRendFolder() {

        while read rendFolder
        do
                echo "$rendFolder"
        done < <( sed -n $1p temp/listRendFolders.txt )
        echo $rendFolder 
}

echo "selecting rendFolder" 

selectRendFolder 2


# <<<<<<<<<< Series Functions >>>>>>>>>>

function listSeries () {

	if [ -e temp/listSeries.txt ]
	then
		rm -rf temp/listSeries.txt
	fi

	while read series
	do
		echo "$series" >> temp/listSeries.txt
	done < <( cat temp/listRendFolders.txt | awk -F "_" '{print $1}' | sort -u )
}

echo "Writing a list of series to disk"
listSeries

function totalSeries () {
	listSeries

        while read numberOfSeries
        do
                echo $numberOfSeries
        done < <( wc -l temp/listSeries.txt  | awk '{print $1}')
}

echo "The total number of series is"
totalSeries


# Determine the seriesNumber
function selectSeries () {
	listSeries

	while read series
	do
		echo "$series"
	done < <( sed -n $1p temp/listSeries.txt )
	echo $series
}

echo "selecting series"

selectSeries 2

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
	done < <( cat temp/listRendFolders.txt | grep "$series" | sort -u | awk -F "_" '{print $1"_"$2}' | sort -u)
}

echo "Writing a list of shows to disk."
listShows 2

function totalShows () {
	listShows $1

	while read numberOfShows
	do
		echo $numberOfShows
	done < <( wc -l temp/listShows.txt  | awk '{print $1}')
}

echo "totalShows"
totalShows 2

# Determine the showNumber
function selectShow () {
	listShows $1

	while read show
	do
		echo $show
        done < <( sed -n $2p temp/listShows.txt | awk -F "_" '{print $2}' )
}

echo "selecting show"
selectShow 2 1

# Determine the projectNumber
function selectProject () {
        listShows $1

        while read project
        do
                echo $project
        done < <( sed -n $2p temp/listShows.txt )
}

echo "selecting project"
selectProject 2 1

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
        done < <( cat temp/listRendFolders.txt | grep "$projectName" | awk -F "_" '{print $1"_"$2"_"$3}' | sort -u)
}

echo  "Writing a list of shots to disk"
listShots 2 2

# Total Shots/Elements
function totalShots () {
	listShots $1 $2

        while read totalShots
        do
                echo $totalShots
        done < <( wc -l temp/listShots.txt  | awk '{print $1}')
}

echo "totalShots"
totalShots 2 2

# Select Shot/Element

function selectShot () {
        listShots $1 $2

        while read shot
        do
                echo $shot
        done < <( sed -n $3p temp/listShots.txt )
}

echo "Selecting shot"
selectShot 2 2 3

# List All Bucket Files
function listBucketFiles () {
        shotName=$(selectShot $1 $2 $3)
        echo "shotName is $shotName"

	if [ -e temp/listBucketFiles.txt ]
	then
		rm -rf temp/listBucketFiles.txt
	fi

        while read bucketFiles
        do
                echo $bucketFiles >> temp/listBucketFiles.txt
        done < <( ls -1 /media/gh/$shotName\_rend/ )
}

# echo "Writing list of all bucket files to disk"
# listBucketFiles 3 2 1


# List Verisons
function listBasenames () {
	shotName=$(selectShot $1 $2 $3)
	echo "shotName is $shotName"

	if [ -e temp/listBasenames.txt ]
	then
		rm -rf temp/listBasenames.txt
	fi

	while read basenames
	do
		echo $basenames >> temp/listBasenames.txt
	done < <( ls -1 /media/gh/$shotName\_rend/  | awk -F "." '{print $1}' | sort -u )
}

echo "Writing basenames to disk"
listBasenames 3 2 1

# Select Basename
function selectBasename () {
	basename=$(listBasenames $1 $2 $3)

	while read baseName
	do
		echo $baseName
	done < <( sed -n $4p temp/listBasenames.txt )
}

echo "Basename is"
selectBasename 3 2 1 1

# Total Basenames

function totalBasenames () {
        listBasenames $1 $2 $3

        while read totalBasenames
        do
                echo $totalBasenames
        done < <( wc -l temp/listBasenames.txt  | awk '{print $1}')
}

echo "Total basenames"
totalBasenames 3 2 1

# Does an MP4 Exist?
function mp4Exist () {
	local shotName=$(selectShot $1 $2 $3)
	echo "shotname is $shotName"
	local rendBucketName=$shotName\_rend
	echo "rendBucketName is $rendBucketName"
	local basename=$(selectBasename $1 $2 $3 $4)
	echo "basename is $basename"
	local mp4Path=/media/gh/$rendBucketName/$basename.mp4
	echo "mp4Path is $mp4Path"
	if [ -e $mp4Path ]
	then
		echo "mp4 exists"
	else
		echo "mp4 does not exist"
	fi
}

mp4Exist 3 2 1 1

# Does an MP4 Lock Exist?
function mp4LockExist () {
        local shotName=$(selectShot $1 $2 $3)
        echo "shotname is $shotName"
        local rendBucketName=$shotName\_rend
        echo "rendBucketName is $rendBucketName"
        local basename=$(selectBasename $1 $2 $3 $4)
        echo "basename is $basename"
        local mp4Path=/media/gh/$rendBucketName/$basename.mp4Lock
        echo "mp4Path is $mp4Path"
        if [ -e $mp4Path ]
        then
                echo "mp4 lock exists"
        else
                echo "mp4 lock does not exist"
        fi
}

mp4LockExist 3 2 1 1

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
	echo "projectName is $projectName"
	local rendBucketName=$(selectRendBucket $1 $2 $3)
	echo "rendBucketName is $rendBucketName"
	local projectPath=/media/gh/$rendBucketName/
	local basename=$(selectBasename $1 $2 $3 $4)
	echo "basename to match is $basename"
	local imageMatch=0
	# local padddedNumber=$(paddedNumber $1 $6)
	# echo "paddedNumber is $paddedNumber"

	local cfgName=$basename.$5.cfg
	echo "cfgPath is $projectPath$cfgName"
	local cfgExists=0
	echo "cfgExists is $cfgExists"
        local pngName=$basename.$5.png
        echo "pngName is $projectPath$pngName"
	local pngExists=0
	echo "pngExists is $pngExists"

	if [ -e $projectPath$cfgName ]
	then
		cfgExists=1
	fi

	if [ -e $projectPath$pngName ]
	then
		pngExists=1
	fi

	if [ $cfgExists -eq 1 ] && [ $pngExists -eq 1 ]
	then
		echo "cfg and png both exist"
	else
		echo "cfg and png do not both exist"
	fi
}

matchCFGPNG 3 2 1 1 0191 4

#getStartFrameNumber seriesId showId shotId basenameId
#getEndFrameNumber seriesId showId shotId basenameId

# Select Version

# Determine all of the basenames within.
# Using a "." as an field seperator, select the first field and save it as $basename.
# Foreach basename check if a MP4 is not already made.
# Foreach basename check if a MP$ is not currently being made
# Foreach basename check if all CFG's have a corresponding PNG file.  If they do we know we can
# proceed in making an MP4
# Create a mp4Lock file named something like $basename.mp4Lock

# Check the database for the frames per second and save it as $framerate.
# Check to see if the step is 1, 2 or some other number.
# Save the step as $step
# If the step is something other than 1, index the numbers.
# This should be done by copying the proceeding odd frame to the second even and so on.  1 is copied to 2, 3 is copied to 4, etc.

# Once the frames are in a complete numeric set the mp4 can be made.

funnction main () {
	# create a list of all the rend folders on the G drive.
	listRendFolders

	# local currentSeries=1
	# local currentShow=1
	# local currentShot=1

	local totalSeries=$(totalSeries)
	local totalShows
	local totalShots
	local totalBasenames

	local seriesNumber
	local showNumber
	local projectName
	local shotName
	local basename

	# while [ $currentSeries -le $totalSeries ]
	for ((currentSeries=1;currentSeries<=totalSeries;currentSeries++))
	do
		# Do stuff
		seriesNumber=$(getSeriesNumber $currentSeries)
		totalShows=$(totalShows)
		# while [ $currentShow -le $totalShows ]
		for ((currentShow=1;currentShow<=totalShows;currentShow++))
		do
			# Do Show Stuff
			showNumber=$(getShowNumber $currentSeries $currentShow)
			totalShots=$(totalShots)
			for ((currentShot=1;currentShot<=totalShots;currentShot++))
			do
				# Do Shot Stuff
				shotNumber=$(getShotNumber $currentSeries $currentShow $currentShot)
				totalBasenames=$(totalBasenames $currentSeries $currentShow $currentShot $currentBasename)
				for (((currentBasename=1;currentBasename<=totalBasenames;currentBasename++))
				do
					# Do Basename Stuff
					basename=$(getBasename $currentSeries $currentShow $currentShot $currentBasename)
					# Foreach frame
				done
			done

		done
	done
}


# After the conversion is complete.
# 1. Place the mp4 in the next days dailies folder.
# 2. Place the mp4 in the shot/elements movies folder.
# 3. Make the directory for the PNG sequence in /media/projects/... if necessary
# 4. Copy the PNG sequence into the direcory on /media/projects/...

# Complete.

