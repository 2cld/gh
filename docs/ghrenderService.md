# Created ghrender.service 

## Create bare min ghrender.service
```
ghadmin@bn01:~$ cp /media/farm/ghbin/nodeRenderService.sh .
ghadmin@bn01:~$ chmod +x nodeRenderService.sh
ghadmin@bn01:~$ sudo touch /etc/systemd/system/ghrender.service
ghadmin@bn01:~$ sudo chmod 664 /etc/systemd/system/ghrender.service 
ghadmin@bn01:~$ sudo vi /etc/systemd/system/ghrender.service 
[Unit]
Description=ghrender

[Service]
ExecStart=/home/ghadmin/nodeRenderService.sh

[Install]
WantedBy=multi-user.target
```

## Load, start, stop and enable on 'startup'
```
ghadmin@bn01:~$ sudo systemctl daemon-reload
ghadmin@bn01:~$ sudo systemctl enable ghrender
Created symlink /etc/systemd/system/multi-user.target.wants/ghrender.service → /etc/systemd/system/ghrender.service.

ghadmin@bn01:~$ sudo systemctl start ghrender
ghadmin@bn01:~$ sudo systemctl stop ghrender
```

### Verify by checking log
```
ghadmin@bn02:~$ cat /media/farm/ghlogs/gridNodes.list 
Tue May 21 19:38:55 UTC 2019 STARTED: bn02
Tue May 21 19:38:55 UTC 2019 ALLSTOP: bn02
```

# Check the service logs
```
ghadmin@bn01:~$ journalctl -u ghrender
-- Logs begin at Wed 2019-05-15 19:16:09 UTC, end at Mon 2019-05-20 22:17:19 UTC. --
May 20 22:10:11 bn01 systemd[1]: Started ghrender.
May 20 22:10:11 bn01 nodeRenderService.sh[2156]: /home/ghadmin/nodeRenderService.sh: line 309: cd: HOME not set
May 20 22:10:11 bn01 nodeRenderService.sh[2156]: /home/ghadmin/nodeRenderService.sh: line 340: cd: HOME not set
May 20 22:10:11 bn01 nodeRenderService.sh[2156]: rm: cannot remove '*.log': No such file or directory
May 20 22:10:11 bn01 nodeRenderService.sh[2156]: Current Loop Count: 1
May 20 22:10:11 bn01 nodeRenderService.sh[2156]: 0215_002_0007A_rend/*.cfg
May 20 22:10:11 bn01 nodeRenderService.sh[2156]: Scanning Project
May 20 22:10:11 bn01 nodeRenderService.sh[2156]: LoopSleep for 10
May 20 22:10:21 bn01 nodeRenderService.sh[2156]: Current Loop Count: 2
May 20 22:10:21 bn01 nodeRenderService.sh[2156]: 0215_002_0007A_rend/*.cfg
May 20 22:10:21 bn01 nodeRenderService.sh[2156]: Scanning Project
May 20 22:10:21 bn01 nodeRenderService.sh[2156]: LoopSleep for 10
May 20 22:10:31 bn01 nodeRenderService.sh[2156]: Current Loop Count: 3
May 20 22:10:31 bn01 nodeRenderService.sh[2156]: 0215_002_0007A_rend/*.cfg
May 20 22:10:31 bn01 nodeRenderService.sh[2156]: Scanning Project
May 20 22:10:31 bn01 nodeRenderService.sh[2156]: Scanning Project
May 20 22:10:32 bn01 nodeRenderService.sh[2156]: LoopSleep for 10
May 20 22:10:38 bn01 systemd[1]: Stopping ghrender...
May 20 22:10:38 bn01 systemd[1]: Stopped ghrender.
```

# Remove logfiles and restart node
```
root@catfreenas:/mnt/MediaVolume/farm/ghlogs # rm gridNode.list 
root@catfreenas:/mnt/MediaVolume/farm/ghlogs # rm gridNodes.list 
root@catfreenas:/mnt/MediaVolume/farm/ghlogs # rm nodeStatus_bn01.list
```

```
ghadmin@bn01:~$ ç
Connection to 192.168.9.41 closed by remote host.
Connection to 192.168.9.41 closed.
```
### command line proxmox things
- Look at shared storage
```
root@pm01-gh:~# pvesm status
Name             Type     Status           Total            Used       Available        %
GridShare        cifs     active      8402763435         5444186      8397319249    0.06%
local             dir     active        34829920         5814320        27216640   16.69%
local-lvm     lvmthin     active        79896576         8628830        71267745   10.80%
root@pm01-gh:~# 
```
- Force the node into cluster-master
```
root@pm01-gh:~# pvecm e 1
```
- Look at cluster members registered
```
root@pm01-gh:~# cat /etc/pve/.members
{
"nodename": "pm01-gh",
"version": 74,
"cluster": { "name": "ghcluster", "version": 16, "nodes": 16, "quorate": 1 },
"nodelist": {
  "pm01-gh": { "id": 1, "online": 1, "ip": "192.168.9.121"},
  "pm02-gh": { "id": 2, "online": 1, "ip": "192.168.9.122"},
  "pm03-gh": { "id": 3, "online": 0, "ip": "192.168.9.123"},
  "pm04-gh": { "id": 4, "online": 1, "ip": "192.168.9.124"},
  "pm05-gh": { "id": 5, "online": 1, "ip": "192.168.9.125"},
  "pm06-gh": { "id": 6, "online": 1, "ip": "192.168.9.126"},
  "pm07-gh": { "id": 7, "online": 1, "ip": "192.168.9.127"},
  "pm08-gh": { "id": 8, "online": 1, "ip": "192.168.9.128"},
  "pm09-gh": { "id": 9, "online": 1, "ip": "192.168.9.129"},
  "pm11-gh": { "id": 11, "online": 1, "ip": "192.168.9.131"},
  "pm12-gh": { "id": 12, "online": 1, "ip": "192.168.9.132"},
  "pm13-gh": { "id": 13, "online": 1, "ip": "192.168.9.133"},
  "pm14-gh": { "id": 14, "online": 1, "ip": "192.168.9.134"},
  "pm15-gh": { "id": 15, "online": 1, "ip": "192.168.9.135"},
  "pm16-gh": { "id": 16, "online": 1, "ip": "192.168.9.136"},
  "pm10-gh": { "id": 10, "online": 1, "ip": "192.168.9.130"}
  }
}
```
- List backups in dump share
```
root@pm01-gh:~# ls /var/lib/vz/dump/
vzdump-qemu-100-2019_05_15-15_48_22.log  vzdump-qemu-101-2019_05_15-16_15_57.log  vzdump-qemu-101-2019_05_15-16_15_57.vma.gz
root@pm01-gh:~# 
```
- Storage config
```
root@pm01-gh:~# cat /etc/pve/storage.cfg 
dir: local
	path /var/lib/vz
	content backup,iso,vztmpl

lvmthin: local-lvm
	thinpool data
	vgname pve
	content rootdir,images

cifs: GridShare
	path /mnt/pve/GridShare
	server 192.168.9.2
	share GridShare
	content images,iso
	username ghadmin

root@pm01-gh:~#
```
- Fix graphics... sometimes
```
root@pm01-gh:~# service pvestatd restart
```
### Reference
- [systemd service file example](https://www.shellhacks.com/systemd-service-file-example/)
- [boot requirments](https://forums.servethehome.com/index.php?threads/proxmox-5-1-boot-drive-size.17792/)
- [proxmox-cmap service](https://forum.proxmox.com/threads/one-node-cannot-initialize-cmap-service.31075/)
