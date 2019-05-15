# Workflow for gh Blender Render Grid
Purpose: Data flow overview for Grasshorse Blender Render Grid.

## Main Compute Components
1. Magma (Project Portal - ghMagma)
2. Artist Workstation (Blender GUI Workstation - ghArtist)
3. /media/gh (Storage - Process Control Scripts)
4. /media/projects (Storage - Blender Render Resources)
5. /media/process (S
6. multiple - Blender Render Node (Render Node - ghBlenderNode)

## Process Steps
1. Admin - Create Project
1. Artist - Use Workstation to create resources in /media/projects
1. Director - (pooptional) Greenlight version package for Render Grid resources
1. Artist - Package x.zip
1. Artist - Use MAGMA to submit render job
1. Admin - Monitor Render Grid for problems and complete jobs
1. Admin - Transfer complete jobs to _dailies and project rend directory
1. Director / Artist / Admin - Process Feedback and submit FIX Job Tickets.

## Data Flow and Event Process
1. Admin - Create Project - MAGMA creates structure
1. Outputs ToProcess.sh in /media/process/toProcess.sh
1. Create folder structures on
   - /media/production
   - /media/process
   - ?? why not /media/gh ??
1. Artist - Use Workstation to create resources in /media/projects
   - Blender Program is mapped to /media/projects
1. Artist creates .blend file in /media/projects/0194/… 
1. Director - Greenlight version package for Render Grid resources
   - Maybe should be in MAGMA but now it’s just Artist and Director talk
1. Artist - Package x.blend and x.zip
1. Artist creates versioned x.zip
1. Artist - Use MAGMA to submit render job
1. Artist moves x.zip to /media/gh/*_zip
1. Artist uses MAGMA to generate *.cfg in /media/gh/*_rend
1. Admin - Monitor Render Grid for problems and complete jobs
   - If nodes are running old system… /media/gh/*_rend/*.lck,*.png should appear
1. Admin - Transfer complete jobs to _dailies
1. Stephen runs mp4Service.sh to generate daily review stuff
1. Stephen runs pngService.sh to transfer render to project rend directory
1. Director / Artist / Admin - Process Feedback and submit FIX Job Tickets.

### Services and Data Flow Walkthrough - Video: cat_GrasshorseRenderGrid_StephenSystemWalkthrough.mov
1. Admin - Create Project ( TC-00:24:52 ) http://galaxy.grasshorse.com/index.php/project-administration
    - Project Administration -> Shot Management
    - Select Series
    - Select Shared Folder
    - Select / Create Shot ???
    - Set Frame Range
    - Click “Create” button
      - Magma does a “GET” with values to http://galaxy.grasshorse.com/index.php/project-administration/shot-management?seriesId=55&showId=104
      - Magma runs the function processSeries() processShot() from function.php to run makeFolders and makeBucket that generate the /media/process/toProcess.sh script that needs to be run as an admin.
      - superuser@galaxy:~$ cd /media/process/ ( TC-00:26:36 )
      - Verify you can get to the storage the script needs to create in (they are on different systems)
      - superuser@galaxy:/media/process$ ls ../projects
      - superuser@galaxy:/media/process$ ls ../production
      - superuser@galaxy:/media/process$ ls ../gh
      - superuser@galaxy:/media/process$ cat toProcess.sh ( TC-00:26:29 )
1. Artist - Blender Work ( TC-00:32:30 )
    - Create some Blender data to Render.
    - Save Blend file ( TC-00:33:33 )
    - /Volumes/projects/0194/000/prod/0194_000_0002A/3d/3danim/
    - 0194_000_0002A_3danim_v001.blend
    - (Stephen saves in a machine that has Magma UI so it fills in the Magma db) ( TC-00:34:00 )
1. Director - GREEN LIGHT artist to submit grid render job (just Aritist and Stephen talking)
1. Artist - Blender Grid Submit
    - Set Blender User Pref to create zip ( TC-00:36:27 )
    - Pack Blend to Archive ( TC-00:37:00 ) 0194_000_0002A_3danim_v001.zip
    - IMPORTANT: Watch for zip package to COMPLETE
    - ( TC-00:38:00 ) Go to projects (bugatti) or /media/projects/0194/000/prod/0194_000_0002A/3d/3danim/ and see the .blend and .zip files you just created.
    - MOVE the above .zip to the render grid ( TC-00:38:26 ) to /media/gh/0194_000_0002A_zip directory.
    - Stephen talking about extra Step stuff that for future crap
1. Submit Render ( TC-00:41:14 ) 
    - Magma creates .cfg files to deploy to grid
    - Stephen explains how Magma creates files and some of the db tables involved.
1. Admin - Monitor Render Grid for problems and complete jobs
    - Looking at grid node work ready to be done ( TC-00:44:00 )
    - /media/gh/0194_000_0002A_zip see the zip file
    - /media/gh/0194_000_0002A_rend see the *.cfg files for each frame
    - ( TC-00:45:00 ) Stephen explains *.cfg file info
    - … Stephen explains more features to add with structure
1. TURN ON GRID NODE
    - Login to a grid node
    - ./nodeRenderService.sh &
    - Node should pickup *.cfg jobs
    - Reads /media/gh/ghprojects/jobPriority.list
    - ( TC-00:52:00 ) Stephen explains jobPriority.list
    - ( TC-00:54:00 ) nodeRenderService.sh output
    - ( TC-01:01:00 ) nodeRenderService creates a *.lock then a *.png
    - ( TC-01:02:30 ) Go look at badBlender.txt
    - ( TC-01:03:00 ) Go look at nodeService.log
    - ( TC-01:03:40 ) Go look at nodeRenderService.sh code
    - ( TC-01:05:30 ) Node Type = 2 issue with blender command
    - ( TC-01:06:30 ) Stephen gets into the frame feature AND how the zip thing works… AGAIN… so it’s OBVIOUSLY something he wants to do… MAGMA-TODO
    - ( TC-01:09:00 ) Chris explains why node stopped with badBlender.txt
    - ( TC-01:09:30 ) Stephen removes badBlender.txt and runs script
    - Chris and Stephen talk broken crap.
    - tbd
    - Stephen explains an issue with *.zip file when blender packs them. (TC-00:55:50 )
    - ( TC-01:12:00 ) Stephen follows node png out to bucket /media/gh/0194_000_0002A_rend
    - tbd
1. Admin - Transfer complete jobs to _dailies
    - ( TC-01:12:30 ) Stephen explains what mp4 and png maker does
    - ( TC-01:13:30 ) Stephen shows script /media/gh/ghbin/grender/mp4Service.sh
    - ( TC-01:14:10 ) Stephen shows script /media/gh/ghbin/grender/pngService.sh
    - ( TC-01:15:00 ) Stephen shows scripts /media/projects/_dailies/0194_001/07_22_2017/
    - ( TC-01:16:30 ) Stephen tells about “current status view” through MAGMA… ANOTHER website feature (MAGMA) project for someone MAGMA-TODO
    - test
    - tbd
1. Director / Artist / Admin - Process Feedback and submit FIX Job Tickets.
    - Somewhere we should keep source code and ticket system.
    - Feedback about process improvements should follow AGILE SCRUM stuff.
    - Test


#### MODS to TEST
Remote nodes in Cedar Falls.
Create tar for <projectshot>_rend and <projectshot>_zip
Push tar
Pull tar
Render tar
Create finished tar
Push tar
Pull tar
Expand project
Fix Node poll and pull to Controller job PUSH
