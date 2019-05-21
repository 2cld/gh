# Grid Farm shared storage setup

nodeRenderService.sh uses /media/farm nfs mount to control render nodes collect render jobs

## nodeService.sh /media/farm Storage Diagram
![nodeServiceDiagram](ghOverviewDiagram-nodeServiceDiagram.svg)

## /media/farm structure
On catmini (192.168.9.20) I mount farm to /private/nfs to view
```
catmini:~ cat$ sudo mount -t nfs 192.168.9.2:/mnt/MediaVolume/farm /private/nfs
```
Should see this
![ghcluster-farm](ghcluster-farm.png)

### /media/farm/ghbin
contains scripts 
- nodeRenderService.sh - main script ( installed in /home/ghadmin/ and called by ghrender.service at startup )

### /media/farm/ghcache
contains the BakeFix cache for project assets

- smoke_cashe
- smoke_cashe/0215_002_0003A_3danim_cache

### /media/farm/ghlogs
contains log status from each of the nodes and gridNodes.list with start/stop service details from all nodes

- gridNodes.list - Start/Stop status from all node services
- nodeStatus_bn01.list - Frame render start-stop times from each node
- nodeStatus_bn02.list
- nodeStatus_bn03.list
- nodeStatus_bn04.list

### /media/farm/ghprojects
contains jobPriority.list which is a list of jobs and job controls.
#### Control functions
1. "PPPP_SSS_EEEEE_rend/*.cfg" - will read all cfg files in /media/farm/PPPP_SSS_EEEEE_rend directory
2. "allstop" - if this command is read, render service will stop and exit
3. "rescan" - if this command is read, render service will re-read the jobPriority.list and start from TOP

- jobPriority.list
#### Example one project and repeat
```
0215_002_0007A_rend/*.cfg
rescan
```
#### Example two projects but have all nodes rescan after each project (verifies top of list gets done)
```
0215_002_0007A_rend/*.cfg
rescan
0215_002_0004A_rend/*.cfg
rescan
```
#### Example have nodes stop (they will finish work they are doing but next time they read jobPriority.list they will exit)
```
allstop
0215_002_0007A_rend/*.cfg
rescan
0215_002_0004A_rend/*.cfg
rescan
```

### /media/farm/PPPP_SSS_EEEEV_
contains project_rend project_zip

- /media/farm/PPPP_SSS_EEEEV_rend
- /media/farm/PPPP_SSS_EEEEV_zip

#### /media/farm/PPPP_SSS_EEEEV_rend
contains frame.cfg frame.lock frame.png this is the 'work distribution and output collection' directory

- frame.cfg 
   - configure information used to feed blender render command
```
zipBucket='/media/farm/0215_002_0007A_zip/'
rendBucket='/media/farm/0215_002_0007A_rend/'
zip='0215_002_0007A_3danim_v002.zip'
blend='0215_002_0007A_3danim_v002.blend'
fileName='0215_002_0007A_3danim_v002'
frameName='0215_002_0007A_3danim_v002.0001'
start='0001'
end='0001'
step='1'
```
- frame.lock 
   - ghrender bid / locking for node sync
```
blamURL=bn01
bidCreated='Mon May 20 23:19:38 UTC 2019'
bidWon='Mon May 20 23:19:39 UTC 2019'
```
- frame.png - output render
   - initially, the rendernode will create the frame.png with touch (empty file) while it renders
   - on completion of local frame.png output by blender, the node check the output and copies it to farm
  

