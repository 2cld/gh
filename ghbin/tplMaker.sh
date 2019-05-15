#!/bin/bash

# !!!! THIS SCRIPT MUST BE RUN ON GALAXY !!!!

# This is a script that is to be used to help create the tpl files for the shots and elements
# that need to be created for MAGMA's tools to run.

# 1. First we need to create a file that looks like this if it has not already been created.

# administrator@rn09:/media/gh/ghprojects$ cat 0188_000.tpl 
# projectName='0188_000'
# seriesNumber='0188'
# showNumber='000'
# zipName='_zip'
# rendName='_rend'

# The only variable parts of this are seriesNumber and showNumber which combined make up the
# projectName which is also the .tpl file name

# Then we need to make shot or element templates like this. 

# administrator@rn09:/media/gh/ghprojects$ cat 0188_001_0001A.tpl
# shotName='_0001A'
# start='1'
# end='58'
# step='2'

# The name shotName reveals that most likely it will be a shot that we are working with. 
# This is where we really have the greatest need.  The goal is to have the code 
# run all shots and elements in the database for a given show so we don't have to 
# individually make them. 

# So we need to call the database to retrieve a list of all the shots and elements along 
# with their respective start and end frames.  Since step is typically a project wide 
# variable, we will just enter that manually by querying the user for input. 

# mysql -u magma -pG0B0tsMicr0B0ts69 <<MY_QUERY
# USE mysql
# SHOW tables
# SELECT * FROM shotTable WHERE projectNumber = $projectNumber
# MY_QUERY

mysql -u magma -pG0B0tsMicr0B0ts69 -e "USE protomotion_db ; SELECT projectName,shotName,startFrame,endFrame FROM shotTable WHERE projectName = '0188_001' ; " | grep "_" | awk '{print $1,$2,$3,$4}'
