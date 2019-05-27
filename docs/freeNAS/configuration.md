# freeNAS configuration for ghrender

## freeNAS install
1. Use freeNAS install USB thumbdrive
2. Install...

## freeNAS Storage Pool Config
1. Login to FreeNAS (root - What#Time)
2. From FreeNAS Dashboard -> Storage -> Pools -> Create
  - Name: drivepool
  - Type: raidz
  - Add Drives (the 4 disks) -> Set to raidz (default is raidz2)
3. Confirm Create
5. In Storage / Pools -> drivepool -> Add Dataset
  - Name: farm
  - Comments: blener render farm shared drive
5. In Services -> Enable NFS and Start Automatically

## Hindsight Jail
1. From FreeNAS Dashboard -> Jails -> ADD
  - Jail Name: hindsight
  - Release: 11.2-RELEASE
  - NEXT:
  - IPv4 Interface: em0
  - IPv4 Address: 192.168.1.6
  - IPv4 Netmask: 24
  - NEXT:
  - Confirm
```
Jail Summary
Jail Name : hindsight
Release : 11.2-RELEASE
IPv4 Address : em0|192.168.1.6/24
Confirm these settings.
```
2. Confirm 
  - Basic: Auto-Start
  - Jail: allow_set_hostname, allow_raw_sockets
  
  
## Install new FreeNAS and import existing Pool
1. USB FreeNAS install to new USB
2. Login to FreeNAS firstime set pw (What#Time)
3. Storage -> Pools -> Add 
   - Import an existing pool
   - NEXT:
   - Is the pool encrypted? No
   - NEXT:
   - Pool: drivepool
   - NEXT:
   - Confirm: IMPORT
```
Pool Import Summary
Pool to import : drivepool | 9174643673441383865
Confirm these settings.
```
