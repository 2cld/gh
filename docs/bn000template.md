# bn000template - Grasshorse Blender Node Template

- Install ISO - ubuntu-18.04.2-live-server-amd64.iso

### ISO install
1. ghamdin - What#Time
2. OpenSSH

### Basic Node Configure
1. ghadmin@bn000template:~$ sudo apt-get update
2. ghadmin@bn000template:~$ sudo apt-get install blender
3. ghadmin@bn000template:~$ sudo apt-get install unzip
4. ghadmin@bn000template:~$ blender -v
```
Blender 2.79 (sub 0)
```
5. ghadmin@bn000template:~$ sudo apt install nfs-common
6. ghadmin@bn000template:~$ sudo vi /etc/fstab
```
# Add to bottom of /etc/fstab for render farm share
192.168.9.2:/mnt/MediaVolume/farm /media/farm nfs auto,nofail,noatime,nolock,intr,tcp,actimeo=1800 0 0
```
7. ghadmin@bn000template:~$ sudo mount -a
8. ghadmin@bn000template:~$ cp /media/farm/ghbin/nodeService.sh .
9. ghadmin@bn000template:~$ sudo poweroff

### Cloud-init Configure
1. ghadmin@bn000template:~$ sudo apt install cloud-init
2. ghadmin@bn000template:~$ sudo vi /etc/cloud/cloud.cfg
   - remove from cloud_config_modules: 
      - snap
      - snap_config
      - ubuntu-advantage
      - disable-ec2-metadata
      - byobu
   - remove from cloud_final_modules:
      - snappy
      - fan
      - landscape
      - lxd
      - puppet
      - chef
      - mcollective
      - salt-minion
      - rightscale_userdata
3. Fix IP MAC id issue (new to ubuntu networking I think)
   - ghadmin@bn000template:~$ sudo rm /etc/machine-id
   - ghadmin@bn000template:~$ sudo touch /etc/machine-id
   - ghadmin@bn000template:~$ sudo rm /var/lib/dbus/machine-id
   - ghadmin@bn000template:~$ sudo ln -s /etc/machine-id /var/lib/dbus/machine-id
   - ghadmin@bn000template:~$ ls -l /var/lib/dbus/machine-id 
```
    lrwxrwxrwx 1 root root 15 May 15 18:43 /var/lib/dbus/machine-id -> /etc/machine-id
```
4. ghadmin@bn000template:~$ sudo apt clean
4. ghadmin@bn000template:~$ sudo poweroff
5. Go regen Cloud-init from proxmox

### bn000template create on ProxMox
1. Create Cloud-Init Drive
  - Datacenter -> pm01-gh -> bn000template -> Hardware -> Add -> Cloud-Init Drive
  - Device: IDE
  - Storage: local-lvm
2. Configure Cloud-Init vars
  - Datacenter -> pm01-gh -> bn000template -> Cloud-Init
  - User: ghadmin
  - Password: What#Time
3. Regenerate Image (click button)

### Clone bn000template
1. Right-click on Datacenter -> pm01-gh -> bn000template -> Clone
  - Target node: pm01-gh
  - VM ID: 101 (or next in line)
  - Name: bn01 (or next in line)
  - Resource Pool: blenderRender
  - Target Storage: Same as source (default)
2. Go to Datacenter -> pm01-gh -> bn01 -> Cloud0Init -> Reginerate Image


### Boot new node (bn01)
1. Go to Datacenter -> pm01-gh -> bn01 -> Start
2. Go to Datacenter -> pm01-gh -> bn01 -> Console
3. [hostname issue](https://forum.proxmox.com/threads/setting-host-name-via-cloud-init.45525/) cloud-init messing up hostname 
  - sudo rm -rf /var/lib/cloud/seed/nocloud-net
  - sudo poweroff
4. Start bn01 - Datacenter -> pm01-gh -> bn01 -> Start

### Backup / move vm
1. Enable your disk to store backups (on both source and destination nodes)
  - Create VXDump Storage - Datacenter -> Storage -> Add -> (Content: VZDump backup file)
2. Create Backup
  - ssh root@192.168.9.121
  - cd /var/lib/vz/dump
  - vzdump 100
  - or via gui: Datacenter -> pm01-gh -> bn000template -> Backup
3. Move backup file via scp
  - ssh root@192.168.9.121
  - cd /var/lib/vz/dump
  - scp vzdump-qemu-<xxxx>.vma root@192.168.9.122:/var/lib/vz/dump/vzdump-qemu-<xxx>.vma
4. Restore the backup
  - ssh root@192.168.9.122
  - cd /var/lib/vz/dump
  - qmrestore vzdump-qemu-<xxx>.vma <ddd(unused ID)>
  - NOTE: the ddd is machine ID and must be unsused on the node
  - via gui: Datacenter -> pm02-gh -> local<backup drive> -> vzdump-qemu-<xxxx>.vma.lzo -> Restore
5. Remove and restore Cloud-Init Drive
  - Datacenter -> pm02-gh -> bn01 -> Hardware -> CloudInit Drive (click Remove after selection)
  - Datacenter -> pm02-gh -> bn01 -> Hardware -> click Add -> CloudInit Drive
  
### Start vm
1. ssh root@192.168.9.121
2. qm list
3. qm start <VMID>
  
