Install TrueNAS scale on proxmos

# TrueNAS Scale on Proxmox [youtube](https://youtu.be/2Ja_e6CMkNY?list=PLOgmFrM3hTGdPanIqKXMI5yx76cPlsOHO)

- [tc 10:35 Create vm](https://youtu.be/2Ja_e6CMkNY?t=635) - TrueNAS scale iso [download url](https://download.truenas.com/TrueNAS-SCALE-Bluefin/22.12.0/TrueNAS-SCALE-22.12.0.iso)
  - node: cg VM ID: 102 Name: truenas StartupOrder: 2 StatupDelay: 30
  - Qemu Agent: checked
  - scsi0 50GB QEMU image format SSD emulation
  - 4 more drives for testing
  - CPU: 4 cores Type host
  - Mem 24576, uncheck Ballooning Device
  - Passthrough PCI Hardware->Add->PCI Device find controller and pass through check all functions
 
## Plex app install issues
- [TrueNAS: Full Setup Guide for Setting Up Portainer, Containers and Tailscale](https://www.youtube.com/watch?v=R7BXEuKjJ0k) - [level1 techs store](https://store.level1techs.com/)
- [TrueNAS Scale Apps - Official, Unofficial, Docker, and Kubernetes](https://www.youtube.com/watch?v=oafOky5GSzc)
- [truenas-scale-cannot-deploy-plex](https://www.truenas.com/community/threads/truenas-scale-cannot-deploy-plex.100397/)
- [Plex Docker Container with NFS mounts](https://www.youtube.com/watch?v=OffGg2F6TlU)

## Truenas scale k3s issues
- [k3s.yaml permission denied issue](https://devops.stackexchange.com/questions/16043/error-error-loading-config-file-etc-rancher-k3s-k3s-yaml-open-etc-rancher)/config
- [.kube config issue](https://devops.stackexchange.com/questions/16013/k3s-the-connection-to-the-server-localhost8080-was-refused-did-you-specify-t/16014#16014)
- [expose k3s api in truenas scale](https://www.reddit.com/r/truenas/comments/onu407/exposing_k3s_api_in_truenas_scale/)
