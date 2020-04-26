# proxmox vlan config

## commandline
1. List vm on server
```
qm list
```
2. Start vm on server
```
qm start 601
```
2. Stop vm on server
```
qm stop 601
```

## network config
- Where the network config that matters lives
```
vi /etc/network/interfaces

service networking restart

/etc/init.d/networking restart
```
- Adding VLAN to proxmox [Nic VLAN tagging](https://forum.proxmox.com/threads/proxmox-single-nic-vlan-tagging.44415/)

### References
- [Proxmox Networks vlan bridge nat](https://pve.proxmox.com/wiki/Network_Configuration)
- [Proxmox Command Line Tools](https://pve.proxmox.com/wiki/Command_line_tools)
- [Debian VLAN](https://wiki.debian.org/NetworkConfiguration#Howto_use_vlan_.28dot1q.2C_802.1q.2C_trunk.29_.28Etch.2C_Lenny.29)
