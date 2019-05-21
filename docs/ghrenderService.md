# Created ghrender.service 

## Create bare min ghrender.service
```
ghadmin@bn01:~$ cp /media/farm/ghbin/nodeRenderService.sh .
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
ghadmin@bn01:~$ sudo poweroff
Connection to 192.168.9.41 closed by remote host.
Connection to 192.168.9.41 closed.
```

### Reference
- [systemd service file example](https://www.shellhacks.com/systemd-service-file-example/)
