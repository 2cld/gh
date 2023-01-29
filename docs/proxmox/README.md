# ProxMox Setup for VM

- [ProxMox = H2DC - How to do Computers](https://www.youtube.com/playlist?list=PLk3oVaFzBUufFbrE4Y0gnQcjzfmEmT93o0)
    - [Configuring Storage in ProxMox](https://www.youtube.com/watch?v=HqOGeqT-SCA)
- [Proxmox - Techno Tim](https://www.youtube.com/playlist?list=PL8cwSAAaP9W37Vnxkw6__sshVY-XohWNm)
- [Proxmox Tutorials - apalrd's adventures](https://www.youtube.com/playlist?list=PLZcFwaChdgSpJLyxoXd2mf_JsokmwlLKi)
    - [Turning Proxmox Into a Pretty Good NAS](https://youtu.be/Hu3t8pcq8O0)
- [Proxmox Full Course - Learn Linux TV](https://www.youtube.com/playlist?list=PLT98CRl2KxKHnlbYhtABg6cF50bYa8Ulo)

## Mantainance

1. Add Hardrives [Configuring Storage in ProxMox](https://www.youtube.com/watch?v=HqOGeqT-SCA) using [https://cf.christrees.com/ns/](https://cf.christrees.com/ns/)
    - [https://192.168.6.103:8006/](https://192.168.6.103:8006/) Proxmox server
    - [Proxmox - ZFS on Linux](https://pve.proxmox.com/wiki/ZFS_on_Linux#sysadmin_zfs_raid_considerations)
    - See all storage
      ```bash
      root@cf:~# lsblk
      ```
    - [smartctl -a /dev/sda youtube](https://youtu.be/GoZaMgEgrHw?t=354)
      ```bash
      root@cf:~# smartctl -a /dev/sdb
      ```
    - [fdisk /dev/sdb youtube](https://youtu.be/GoZaMgEgrHw?t=245)
      ```bash
      root@cf:~# fdisk /dev/sdb
      ```
      ```bash
      p - partition list
      d - delete partitions
      g - gpt
      w - write out
      ```
    - [Disk wipe Error disk/partition '/dev/sdb' has a holder (500)](https://forum.proxmox.com/threads/pve7-wipe-disk-doesnt-work-in-gui.92198/)
      ```bash
      root@cf:~# dd if=/dev/zero of=/dev/sdb
      ```
    - [Configure ZFS storage - clear disks](https://youtu.be/GoZaMgEgrHw?t=191) 
    - [Configure ZFS storage - Create ZFS](https://youtu.be/GoZaMgEgrHw?t=285) Drive-ZFS-CreateZFS
      - Name: zfs2tb - RAID: Single Disk - Compression: on - ashift 12 - device: /dev/sdb
      - Name: zfs3tc - RAID: Single Disk - Compression: on - ashift 12 - device: /dev/sdc
      - Name: zfs3td - RAID: Single Disk - Compression: on - ashift 12 - device: /dev/sdd
    - [tbd]()
2. Add NAS container [Turning Proxmox Into a Pretty Good NAS - youtube](https://youtu.be/Hu3t8pcq8O0) [blog post](https://www.apalrd.net/posts/2023/ultimate_nas/)
    - [Create container for NAS using template](https://youtu.be/Hu3t8pcq8O0?t=111) debian-11-standard
      - Node: cg Name: catnas CTID: 102 storsge: local-lvm 8G CPU: 2 Mem: 512 Net: 192.168.2.2/24 gw 192.168.2.1 vmbr0
    - [Update sources list](https://youtu.be/Hu3t8pcq8O0?t=386)
      ```bash
      vi /etc/apt/sources.list
      ```
      ```bash
      deb http://deb.debian.org/debian bullseye-backports main contrib
      ```
      ```bash
      apt update && apt full-upgrade
      ```
    - [Install Cockpit](https://youtu.be/Hu3t8pcq8O0?t=460)
      ```bash
      apt install -t bullseye-backports cockpit --no-install-recommends
      ```
    - [Allow root login](https://youtu.be/Hu3t8pcq8O0?t=531) delete root in /etc/cockpit/disallowed-users
      ```bash
      vi /etc/cockpit/disallowed-users
      ```
    - Login to cockpit ui [https://192.168.2.2:9090](https://192.168.2.2:9090) from the 192.168.2.0/24 subnet only
    - [Add cockpit modules](https://youtu.be/Hu3t8pcq8O0?t=581)
      - [https://github.com/45Drives/cockpit-file-sharing](https://github.com/45Drives/cockpit-file-sharing)
      ```bash
      wget https://github.com/45Drives/cockpit-file-sharing/releases/download/v3.2.9/cockpit-file-sharing_3.2.9-2focal_all.deb
      ```
      ```bash
      apt install ./cockpit-file-sharing_3.2.9-2focal_all.deb 
      ```
      - [https://github.com/45Drives/cockpit-navigator](https://github.com/45Drives/cockpit-navigator)
      ```bash
      wget https://github.com/45Drives/cockpit-navigator/releases/download/v0.5.10/cockpit-navigator_0.5.10-1focal_all.deb
      ```
      ```bash
      apt install ./cockpit-navigator_0.5.10-1focal_all.deb
      ```
      - [https://github.com/45Drives/cockpit-identities](https://github.com/45Drives/cockpit-identities)
      ```bash
      wget https://github.com/45Drives/cockpit-identities/releases/download/v0.1.10/cockpit-identities_0.1.10-1focal_all.deb
      ```
      ```bash
      apt install ./cockpit-identities_0.1.10-1focal_all.deb
      ```
    - remove deb packages in root
      ```bash
      cd ~
      pwd
      ls
      ```
      ```bash
      rm *.deb
      ```
    - Verify models added to cockpit ui on left tab [https://192.168.2.2:9090](https://192.168.2.2:9090) from the 192.168.2.0/24 subnet only
    - [Click on File Sharing - click on Fix Now warning](https://youtu.be/Hu3t8pcq8O0?t=692)
    - [Add Storage to catnas container](https://youtu.be/Hu3t8pcq8O0?t=710)
      - cg->102->resources->add->mountpoint
      - mountpointID: 0 Storage: zfs2tb Disksize: 1000 Path: /mnt/zfs2tbplexdvr
    - [Add Users to catnas container](https://youtu.be/Hu3t8pcq8O0?t=795)

3. Add Storage from [catfreenas.gh.lan http://192.168.252.2/](http://192.168.252.2/)
    - Datacenter -> Storage -> Add -> NFS
    - [tbd]()
    - [tbd]()
    - [tbd]()

## Setup
- [ProxMox Windows 10 VM best practices](https://pve.proxmox.com/wiki/Windows_10_guest_best_practices)
- [ProxMox Windows 10 VM idiots guide](https://jonspraggins.com/the-idiot-installs-windows-10-on-proxmox/)
    - [Windows 10 iso - Download link](https://www.microsoft.com/en-us/software-download/windows10ISO)
    - [ProxMox Windows 10 virtio link](https://docs.fedoraproject.org/en-US/quick-docs/creating-windows-virtual-machines-using-virtio-drivers/index.html)
    - [ProxMox Windows 10 virtio-win iso](https://fedorapeople.org/groups/virt/virtio-win/direct-downloads/stable-virtio/virtio-win.iso)
    - [ProxMox Windows 10 - NFS mount](https://graspingtech.com/mount-nfs-share-windows-10/)

1. Setup [ProxMox LearningLinuxTV 1/9](https://www.youtube.com/watch?v=MO4CaHn1EjM&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U)
  - Start Install (via USB Stick)
  - Select HardDrive [See Video](https://youtu.be/MO4CaHn1EjM?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=131)
  - Admin Password [See Video](https://youtu.be/MO4CaHn1EjM?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=201)
  - Network Config [See Video](https://youtu.be/MO4CaHn1EjM?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=265)
  - Checkout [WebGUI - https://192.168.9.121:8006](https://192.168.9.121:8006) [See Video](https://youtu.be/MO4CaHn1EjM?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=371)
  - Update ProxMox and Reboot [See Video](https://youtu.be/MO4CaHn1EjM?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=453)
2. Create First VM [ProxMox LearningLinuxTV 2/9](https://www.youtube.com/watch?v=BiIFLFhXByE&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=2)
  - Download ISO [https://help.ubuntu.com/community/Installation/MinimalCD](https://help.ubuntu.com/community/Installation/MinimalCD) [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=51)
  - 19.10 [Download Rochester Institute of Technology](http://mirrors.rit.edu/ubuntu-releases/19.10/)
  - 19.10 [Download TeraSwithc](http://mirror.pit.teraswitch.com/ubuntu-releases/19.10/)
  - Upload 19.10 ISO [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=116)
    - pm01 -> local -> Content -> Upload
  - Create VM [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=163)
    - General [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=180)
      - Node: pm01
      - VM ID: 300
      - Name: ubuntu-19.10
    - OS [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=230)
      - Use CD: ISO image: ubuntu-19.10-live-server-amd64.iso
    - System  no video this is new
      - Graphics: Default
      - SCSI Controller: VirtIO SCSI
    - Hard Disk [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=310)
      - Bus/Device: VirtIO Block
      - Storage: local-lvm
      - Disk size: 64 GiB
      - Cache: Default (No cache)
    - CPU [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=317)
      - Cores: 4
    - Memory [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=361)
      - Memory: 4096
    - Network [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=373)
      - Bridge: vmbr0
      - VLAN Tag: no VLAND
      - Model: VirtIO (paravirtualized)
      - MAC: auto
  - Boot Ubuntu Installer [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=481)
    - English
    - Your Name: radmin
    - Server Name: ratestweb - see#note
    - DHCP
  - Remove CD [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=633)
  - test SSH access [See Video](https://youtu.be/BiIFLFhXByE?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=685)
3. User Interface [ProxMox LearningLinuxTV 3/9](https://www.youtube.com/watch?v=GHzMaTar0fw&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=3)
  - Navigation Menu [See Video](https://youtu.be/GHzMaTar0fw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=42)
  - Summary View [See Video](https://youtu.be/GHzMaTar0fw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=213)
  - Subscription Plans [See Video](https://youtu.be/GHzMaTar0fw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=416)
  - Start On Boot Option [See Video](https://youtu.be/GHzMaTar0fw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=460)
  - Change Hardware [See Video](https://youtu.be/GHzMaTar0fw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=538)
  - Backup to Local [See Video](https://youtu.be/GHzMaTar0fw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=621)
4. Container Setup [ProxMox LearningLinuxTV 4/9](https://www.youtube.com/watch?v=cyjXxsQ8Igw&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=4)
  - Pull down a Template [See Video](https://youtu.be/cyjXxsQ8Igw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=56)
    - pm01 -> local -> Click "Template"
    - Click "ubuntu-19.10-standard" then Click "Download"
  - Create a Container [See Video](https://youtu.be/cyjXxsQ8Igw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=95)
  - Container vs VM [See Video](https://youtu.be/cyjXxsQ8Igw?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=540)
    - Use Container when you can (Dynamic Share)
    - Container smaller footprint
    - Nesting Docker in a Container is not good
    - Use VM for Docker / K8s Host
5. Create Template via CloudInit [ProxMox LearningLinuxTV 5/9](https://www.youtube.com/watch?v=8qwnXd1yRK4&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=5)
  - Install Cloud Init in VM [See Video](https://youtu.be/8qwnXd1yRK4?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=25)
    - sudo apt install cloud-init
  - Edit cloud.cfg [See Video](https://youtu.be/8qwnXd1yRK4?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=118)
    - sudo vi /etc/cloud/cloud.cfg
    - Go to: cloud_config_modules
      - Remove "snap stuff" 2 lines
      - Remove "ubuntu-advantage"
      - Remove "disable-ec2-metadata"
      - Remove "byobu"
    - Go to: cloud_final_modules
      - Remove snappy
      - Remove fan, lxd, puppet, chef, mcollective, salt-minion, rightscale_userdata
  - Talks about 18.04 MAC Address Issue [See Video](https://youtu.be/8qwnXd1yRK4?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=302)
    - REMOVE machine ID from VM
      - cat /etc/machine-id
      - sudo rm /etc/machine-id
      - sudo touch /etc/machine-id
    - soft link machine-id [See Video](https://youtu.be/8qwnXd1yRK4?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=420)
      - cat /var/lib/dbus/machine-id
      - sudo rm /var/lib/dbus/machine-id
      - sudo ln -s /etc/machine-id /var/lib/dbus/machine-id
      - ls -l /var/lib/dbus/mahcine-id
      - cat /etc/machine-id (should be an empty file)
      - sudo apt clean
      - sudo poweroff
  - Create Cloud Init Drive [See Video](https://youtu.be/8qwnXd1yRK4?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=573)
    - pm01 -> Hardware -> Add -> CloudInit Drive
    - Storage: local-lvm
    - pm01 -> Cloud-Init -> Edit
      - User: radmin
      - Password: see#note
  - Create Clone of Template [See Video](https://youtu.be/8qwnXd1yRK4?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=653)
    - Target Node: pm01
    - VM ID: 601
    - Name: ratestclone01
    - Mode: Full Clone
    - Repeat... should get machines
6. Create Cluster [ProxMox LearningLinuxTV 6/9](https://www.youtube.com/watch?v=s9FODQi2-20&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=6)
  - Datacenter [See Video](https://youtu.be/s9FODQi2-20?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=71)
    - Click on "Datacenter"
    - Click on "Cluster" under "Summary"
    - Click "Create Cluster" -> Name: cat9clusterl
    - Click on "Join Information" -> "Copy Information"
    - Go to another node (pm02)
    - Click on "Datacenter"
    - Click on "Cluster" under "Summary"
    - Click "Join Cluster"
    - Paste in Info -> type in root pw of pm01 -> Click "Join"
    - Refresh GUI
    - Should have 3 nodes to do HA
  - Migrate a Container to other node [See Video](https://youtu.be/s9FODQi2-20?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=267)
    - Stop Container 
    - Right Click on Container -> Migrate -> Select target node -> Click "Migrate"
    - You cannot Live migrate "Container" but you CAN LIVE migrate a VM
  - Live Migrate VM to other node [See Video](https://youtu.be/s9FODQi2-20?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=403)
7. [ProxMox LearningLinuxTV 7/9](https://www.youtube.com/watch?v=h1czc-ztRTQ&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=7)
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
8. Upgrade Proxmox to 6.0 [ProxMox LearningLinuxTV 8/9](https://www.youtube.com/watch?v=-izPmkID0dI&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=8)
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
9. Updates on ProxMox with no VM Downtime [ProxMox LearningLinuxTV 9/9](https://www.youtube.com/watch?v=llsB_dhTjVI&list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&index=9)
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()
  - xxx [See Video]()

## Extras
1. Upgrading Proxmox VE to 6.0 [See Video](https://www.youtube.com/watch?v=-izPmkID0dI)
1. Installing Proxmox Virtual Enviroment Updates in a Cluster [See Video](https://www.youtube.com/watch?v=llsB_dhTjVI)
1. Create custom Proxmox via CLI [See Video](https://youtu.be/BwQhG7OR5Rg?t=1282)
