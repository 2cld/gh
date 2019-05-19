# Grid Farm shared storage setup

nodeRenderService.sh uses /media/farm nfs mount to control render nodes collect render jobs

## nodeService.sh /media/farm Storage Diagram
![nodeServiceDiagram](ghOverviewDiagram-nodeServiceDiagram.svg)

## /media/farm structure

### /media/farm/ghbin
contains scripts 
- nodeRenderService.sh

### /media/farm/ghcache
contains the BakeFix cache for projects

- smoke_cashe

### /media/farm/ghlogs
contains log status from each of the nodes

- nodeStatus_bn01.list
- nodeStatus_bn02.list
- nodeStatus_bn03.list
- nodeStatus_bn04.list

### /media/farm/ghprojects
contains jobPriority.list

- jobPriority.list

### /media/farm/PPPP_SSS_EEEEV_
contains project_rend project_zip

- /media/farm/PPPP_SSS_EEEEV_rend
- /media/farm/PPPP_SSS_EEEEV_zip

#### /media/farm/PPPP_SSS_EEEEV_rend
contains frame.cfg frame.lock frame.png

- frame.cfg 
- frame.lock 
- frame.png

