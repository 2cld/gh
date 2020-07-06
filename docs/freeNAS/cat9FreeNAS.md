[Original Document cat9FreeNAS](https://docs.google.com/document/d/1kE2nafGL4KOyLlbPjma4ittpz_pkTlQPhcBlV2qrHMU/edit)

----

1. Setup Install KEY
  - Download [FreeNAS](http://www.freenas.org/download-freenas-release/)
  - Create Install USB Key
  - [Install - Preparing the media](http://doc.freenas.org/11/install.html#preparing-the-media)
  ```bash
  catmini:~ cat$ diskutil list
  catmini:~ cat$ diskutil unmountDisk /dev/disk1
  catmini:~ cat$ sudo dd if=Downloads/FreeNAS-11.0-U4.iso of=/dev/disk1 bs=64k
  ```
2. Setup DELL PowerEdge 2950
  - F2 during boot to set USB boot
  - Ctrl-R ? to get into RAID
  - SET DiskGroup and Virtural Drive RAID-0 for each drive
3. Install FreeNAS to 32GB USB Drive
  - Put 2 32GB USB Drives in
  - Select them both in the INSTALL and it will mirror them
4. Reboot
5. Browse to IP 192.168.88.148 (the IP shown on console)
6. SETUP [Video Tutorial](https://youtu.be/sMZ-s8wHkHw?list=PLjGQNuuUzvmug2-LMfh43ehP9nt8gmCSf&t=179)
  - System - Advanced
    - Check Enable autotune:
    - Show console messages in the footer:
  - System - Certificates
    - (add at a later time, may be a Chrome bug but FF works)
    - Tbd
  - System - Boot (System Volumes, the USB drives)
    - Status (the volumes.. You’ll see just the usb drives)
    - List all the systems, you can Delete, Clone Activate, Rename, Keep
  - Storage - Volumes
    - Volume Create
      - Volume Name: cat9storage
      - No Encryption (NOTE… some may need this)
      - RaidZ2 (2 drive tolerant)
      - Mfid0-5
      - Add Volume
    - Volume Manage
      - Create a KeyPhrase (This is for encrypted disks)
      - Download GELI key (stored ON USB drives, BUT you need IF using Encryption AND you lose the USB drives.  This allows you to import the ArrayVolume and then read the Volume)
      - The System General “Save Config” does NOT backup this key.
    - DataSet Create
      - Storage -> Volumes -> Create Dataset (under the Volume OR Dataset you desire)


