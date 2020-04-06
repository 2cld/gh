# ProxMox Setup for VM



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
