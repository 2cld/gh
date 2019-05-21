# ghcluster - blenderRender Pool Management

## ghcluster startup

1. Verify ghopsGRIDrouter is on (little black router on back side of grid rack)
2. Turn on ghclusterNAS (freenas box in R4 grid rack ) and wait for clean prompt ~10min ( should say web at 192.168.9.2 )
3. Turn on Grid (botton right 2 breakers) NOTE: ghclusterNAS MUST BE UP or nodes will not be able to boot.
4. All nodes should start-up in a sequence automatically.
5. Nodes will begin to report into /media/farm/ghlogs/gridNodes.list and start rendering via /media/farm/ghprojects/jobPriority.list

## ghcluster debug

### ReferenceNotes

- [ghclusterNAS](http://192.168.9.2/ui/sessions/signin) - root-What#Time
- Render nodes are vm managed by proxmox through /media/farm/ghprojects/jobPriority.list
- [Proxmox webui - https://192.168.9.121:8006](https://192.168.9.121:8006/#v1:0:18:3:5::5:7::5) Datacenter -> Summary
![ghcluster-blenderRender](ghcluster-blenderRender.png)
- [Proxmox webui - https://192.168.9.121:8006](https://192.168.9.121:8006/#v1:0:18:3:5::5:7::5=cluster) Datacenter -> Cluster
![ghcluster-proxmox](ghcluster-proxmox.png)
