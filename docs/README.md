# gh docs
Documents for Grasshorse Workflows

## Video Learning [GrasshorseLearn](https://www.youtube.com/channel/UCmsVjwDg8Qc6NQbsAuXeh5A)
- Grasshorse Learning [youtube - Overview](https://youtu.be/NyJJvPpoafA)
- Grasshorse Netstack [youtube - Netstack Overview](https://youtu.be/fWCfG13xkaQ) [netstack.org](https://netstack.org/docs/)
- Grasshorse Network [youtube - network gh.lan](https://youtu.be/INU3BqtyBZQ)

### Network Gateway configuration
- [pfSense the Firewall Gateway fg.gh.lan]()
- tbd
- tbd

### Storage Gateway configuration
- Grasshorse Storage Gateway configuration with [freenas.org](https://www.freenas.org/) 
    1. Storage Gateway configuration [youtube - Part 1 - How Media Share is setup](https://youtu.be/QW0eGZtrELs) for [Netstack freeNAS](https://netstack.org/docs/lan/storage/freenas/) document
    2. [document - Netstack Freenas - Setup](https://netstack.org/docs/lan/storage/freenas/setup)
    3. Pool Setup [local link - Storage/Pools/EditPermissions on catFreeNAS](http://192.168.252.2/ui/storage/pools/id/MediaVolume/dataset/permissions/MediaVolume%2FMedia)
    4. Sharing Setup [local link - Sharing/SMB/Edit on catFreeNAS](http://192.168.252.2/ui/sharing/smb/edit/1)
    5. Storage Gateway configuration [youtube - Part 2a - Create a new dataset](https://youtu.be/kt5hubC1tX0) following the [document - Netstack Freenas - Setup - SMB Share](https://github.com/2cld/netstack/blob/master/docs/lan/storage/freenas/setup.md#freenas-smb-share-dataset-configuration)
        1. Check Status of pool
        2. Add "TestStorage" dataset
        3. Skip (instructions add "Projects" and "Public" datasets)
        4. Create user/group testuser
        5. Skip nsprojects
        6. Skip nspubuser
        7. Add TestStorage SMB share
        8. Edit ACL on TestStorage
        9. Skip 
        10. Skip
        11. RESTART SMB Service
        12. Verify TestStorge SMB share via File Browse
        13. Windows 10 SMB Share browse
            - Open File Exploer
            - Type \192.168.252.2 into path bar
            - Windows should request credintials (input testuser and pw)
        14. Windows 10 Map Network Drive
            - Right click on “This PC”
            - Select “Map network drive…”
            - Select Drive to map: “Z:”
            - Folder: “\sg.ns.lan” (or \192.168.128.4)
            - Reconnect at sign-in: checked (yes)
            - Connect using different credentials: checked (yes)
            - Enter credentials: nsprouser - thepasswordyouset
            - Finish
        15. The END - You should have access I ran out of time on the video to show the auth logic
    6. Storage [youtube - Part2b - Workstation connect and verify]() 
        1. tbd
        2. tbd


### Compute Gateway configuration
- tbd
- tbd


- [Data and Backups]()
- [Workstation Setup]()
- [Magma Useage]()
- [Blender]()
- [Render Grid]()

## General
1. Grasshorse [Artist Overview](artistOverview.md)
2. Grasshorse [Artist Workflow](artestWorkflow.md)
3. Grasshorse [rendergrid Overview](overview.html)
4. Grasshorse [rendergrid Workflow](workflow.html)
5. Grasshorse [rendergrid Manage Grid](gridmanage.html)
6. Grasshorse [rendergrid Farm - Shared Storage](gridfarm.html)

## Setup
Grasshorse rendernode bn000template](bn000template.html) setup
Grasshorse rendernode ghrenderService](ghrenderService.html) create

## FIX Notes
- Grasshorse rendernode [blenderCacheBake](blenderCacheBake.html) FIX
