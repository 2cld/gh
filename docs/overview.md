# Overview

gh site buildout generics

## Stations

### Grid Infra front
- [192.168.9.1](http://192.168.9.1) SOHO router PUBLIC-IP: 192.168.254.x (has inbound blocks)
- [192.168.9.2](http://192.168.9.2) FreeNAS root-What#Time
- [192.168.9.3](http://192.168.9.3) GitLAB root-What#Time
- [192.168.9.4](http://192.168.9.4) nginx (was tobe the inbound web proxy config through freenas)

### Grid Infra DHCP - for stuff that may need to grab IP via DHCP
- 192.168.9.20-99 DHCP via 192.168.9.1 
- [3C:07:54:72:49:E2 - 192.168.9.20](http://192.168.9.20) catmini - workstation
- [00:1A:4B:CD:01:95 - 192.168.9.21](http://192.168.9.21) HPE BladeSystem Onboard Admin (use firefox) Administrator-What#Time
- [messed up - 192.168.9.xx](http://192.168.9.xx) Cisco Switch in HPE (DHCP) (use firefox)
- [VARIOUS - 192.168.9.180-250](---) ILO HPE


### Grid Infra static back HPE BladeStack
- [3C:4A:92:F7:62:30 - 192.168.9.121:8009](https://192.168.9.221:8009) ProxMox pm1  (master node) root-Color#What!
- [98:4B:E1:61:3E:20 - 192.168.9.122:8009](https://192.168.9.222:8009) ProxMox pm2 (cluster node)
- [98:4B:E1:62:01:A8 - 192.168.9.123:8009](https://192.168.9.223:8009) ProxMox pm3 (cluster node)
- [192.168.9.124:8009](https://192.168.9.224:8009) ProxMox pm4 (cluster node)
- [192.168.9.125:8009](https://192.168.9.225:8009) ProxMox pm5 (cluster node)
- [192.168.9.126:8009](https://192.168.9.226:8009) ProxMox pm6 (cluster node)
- [192.168.9.127:8009](https://192.168.9.227:8009) ProxMox pm7 (cluster node)
- [192.168.9.128:8009](https://192.168.9.228:8009) ProxMox pm8 (cluster node)
- [192.168.9.129:8009](https://192.168.9.229:8009) ProxMox pm9 (cluster node)
- [192.168.9.130:8009](https://192.168.9.230:8009) ProxMox pm10 (cluster node)
- [192.168.9.131:8009](https://192.168.9.231:8009) ProxMox pm11 (cluster node)
- [192.168.9.132:8009](https://192.168.9.232:8009) ProxMox pm12 (cluster node)
- [192.168.9.133:8009](https://192.168.9.233:8009) ProxMox pm13 (cluster node)
- [192.168.9.134:8009](https://192.168.9.234:8009) ProxMox pm14 (cluster node)
- [192.168.9.135:8009](https://192.168.9.235:8009) ProxMox pm15 (cluster node)
- [192.168.9.136:8009](https://192.168.9.236:8009) ProxMox pm16 (cluster node)

## FreeBSD Gateway Router (not working)
- Look at the routes: netstat -rn
- Delete the bad: route del default
- Add default route: route add default 192.168.9.1
- Add default route: vi /etc/rc.conf: defaultrouter="192.168.9.1"
- Enable NAT: vi /etc/rc.conf: gateway_enable="YES"
- Restart networking: /etc/rc.d/netif restart && /etc/rc.d/routing restart

## FreeNAS tweak of FreeBSD setup (reference only)
- Go to [192.168.9.2](http://192.168.9.2) FreeNAS
- System -> Tunables -> Add -> Variable: gateway_enable | Value: YES | Type: rc.conf
- Reboot

## Vitrual Machines
- cent7min on Proxmox
  - [192.168.9.201:8009](http://192.168.9.201:8009) ProxMox cf
  - cf->local(cf)->Upload->"CentOS-7-x86_64-Minimal-1810.iso"
  - Create VM (cent7min) - proxcatgrid Color#What!
    - Node: cf | VM ID: 100 | Name: cent7min | Pool: catgridPool
    - Boot: CD - Storge: local ISO image: CentOS-7-x86_64-Minimal-1810.iso
    - OS: Linux 4.x/3.x/2.6 Kernel
    - System: Graphic: Default SCSI Ctr: VirtIO SCSI
    - SCSI Controller: VirtIO | Bus: SCSI | Storage: local-lvm | Size: 9G
    - CPU: 2 | Memory: 1024
  - Create VM (bareMetal)
    - Node: cf | VM ID: 101 | Name: bareMetal | Pool: catgridPool
    - Boot: Do not use any media
    - OS: Linux 4.x/3.x/2.6 Kernel  
    - System: Graphic: Default SCSI Ctr: VirtIO SCSI
    - SCSI Controller: VirtIO | Bus: SCSI | Storage: local-lvm | Size: 6G
    - CPU: 1 | Memory: 512
    - Network Bridge: vmbr0 | Model: VirtIO
    
## VLAN for Testing pxe

- Go to [192.168.9.9](http://192.168.9.9) HPE BladeSystem Onboard Admin (use firefox) admin-What#Time
- Enclosure->Interconnect->CiscoSwtich->ManagementConsole
- should take you to [192.168.9.72](http://192.168.9.72) Cisco Switchroot

## Setup digital-rebar on cent7min

## Test PXE boot

## Proxmox

### proxmox install

- USB key boot
- Install options
  - root-Color#What!
  - FQDN: pm01-gh.2cld.net
  - IP: 192.168.9.221 NM: 24 GW: 192.168.9.1

### proxmox storage
- Create CIFS (samba) storage
- Datacenter -> Storage -> Add -> CIFS
   - ID: GridShare
   - Server: 192.168.9.2 (freenas)
   - Username: ghadmin (What#time)
   - Share: GridShare
   - Content: Disk Image, ISO Image

### proxmox vm 
[CreateTemplate Video](https://www.youtube.com/watch?v=8qwnXd1yRK4&t=752s)


### proxmox cluster
[CreateCluster Video](https://youtu.be/s9FODQi2-20?t=79)

- on pm01-gh: 
    - Datacenter -> Cluster -> Create Cluster -> Cluster Name: ghcluster (Create)
    - Datacenter -> Cluster -> Join Information (Copy Information)
- on pm02-gh: 
    - Datacenter -> Cluster -> Join Cluster -> (Paste Information)
    - input pm01-gh root password
    - click JOIN
- after refresh... should see both nodes
- repeat for nodes pm03-gh to pm16-gh
- Now clone and migrate vm to the nodes

   
 
## Reference docs
- [CreateCluster Video](https://youtu.be/s9FODQi2-20?t=79)
- [CreateTemplate Video](https://www.youtube.com/watch?v=8qwnXd1yRK4&t=752s)
- [CreateContainer Video](https://youtu.be/cyjXxsQ8Igw?t=8)
- [ProxMox Interface](https://youtu.be/GHzMaTar0fw?t=5)
- [CreateImage via ISO](https://youtu.be/BiIFLFhXByE?t=105)
- [Install ProxMox](https://youtu.be/MO4CaHn1EjM?t=96)
- [gh.2cld.net cat9box](https://docs.google.com/spreadsheets/d/1cPcjizKYg8XDHQctY8t1wBhW3g6rClCJ6O_DGaXIscI/edit#gid=1544884858)
- [2cld-NetworkLayout](https://docs.google.com/spreadsheets/d/1fIs0hXZehy1KZmvjHQ6srktOA0otWPfx2Bo0VUg2oa4/edit?ts=5cd30e41#gid=0) via christrees@gmail.com
- [2cld-DataCenterLayout](https://docs.google.com/spreadsheets/d/1QBA9OzsOhxs5W3kwlhxLZCmulFgd5uHMqu2qgrbMdxE/edit#gid=0) via admin@2cld.net (me)
