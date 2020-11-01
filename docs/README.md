# gh docs
Documents for Grasshorse Workflows

## Video Learning [GrasshorseLearn](https://www.youtube.com/channel/UCmsVjwDg8Qc6NQbsAuXeh5A)
- Grasshorse Learning [Overview](https://youtu.be/NyJJvPpoafA)
- [Netstack Overview](https://youtu.be/fWCfG13xkaQ) for Grasshorse [Netstack](https://netstack.org/docs/)
- Overview of [network gh.lan](https://youtu.be/INU3BqtyBZQ)
- freeNAS Storage Gateway [Part 1 - How Media Share is setup](https://youtu.be/QW0eGZtrELs) for [Netstack freeNAS](https://netstack.org/docs/lan/storage/freenas/) document
    1. [Netstack Freenas - Setup](https://netstack.org/docs/lan/storage/freenas/setup)
    2. local link [Storage/Pools/EditPermissions on catFreeNAS](http://192.168.252.2/ui/storage/pools/id/MediaVolume/dataset/permissions/MediaVolume%2FMedia)
    3. local link [Sharing/SMB/Edit on catFreeNAS](http://192.168.252.2/ui/sharing/smb/edit/1)
- freeNAS [Storage Gateway Part 2 - Create a new dataset]() following the document [Netstack Freenas - Setup - SMB Share](https://github.com/2cld/netstack/blob/master/docs/lan/storage/freenas/setup.md#freenas-smb-share-dataset-configuration)
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
    15. The END - You should have access, you can edit or insert credentials directly see “Windows 10 credentials debug” below
- freeNAS tbd [Storage Gateway Part 3]()
- [pfSense the Firewall Gateway fg.gh.lan]()
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
