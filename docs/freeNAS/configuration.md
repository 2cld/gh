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
