#!/bin/bash

# This is a script to take a series of frames that have been rendered with a step and 
# index them into a sequence on ones.

echo "What is the file path to the folder holding the frames?"
read path

echo "What would you like the new frames to be called (hint: not the same name)"
read filename

echo "What frame would you like the new indexed frames to start?"
read start

echo "What is the extension for the outputted frames?"
read extension

index=$start

while read frame
do
	paddedNumber=$(printf "%04d" $index)
	echo "moving $frame to $path/$filename.$paddedNumber.$extension"
	cp $frame $path/$filename.$paddedNumber.$extension
        # ( index++ )
	let index=$index+1

	# if [ "${#projectQuery}" < "5" ]
	# then
	# 	break
	# fi
	# source $projectQuery
	# ghDebug "scanProject $baseName $animBucket $rendBucket"
	# scanProject $baseName $animBucket $rendBucket

done < <( ls -1 $path/*$extension )
