# Grid Template
Overview of components and innterconnect for an IaS grid deployment.

## Components
![gridtemplate-overview](gridtemplate-overview.svg)

Note: gridtemplate-overview [Edit via draw.io](https://app.diagrams.net/#H2cld%2Fgh%2Fmaster%2Fdocs%2Fgridtemplate%2Fgridtemplate-overview.drawio)

1. POE Node - WAN Point of Entry 
  - Router [pfsense](https://www.pfsense.org/)
  - Firewall [pfsense](https://www.pfsense.org/)
  - Switch [pfsense](https://www.pfsense.org/) or [cumulus](https://cumulusnetworks.com/products/cumulus-linux/)
2. LAN SDN - Local Area Network (LAN) Software Defined Network (SDN)
  - DHCP [drp](http://rebar.digital/)
  - iPXE [drp](http://rebar.digital/)
  - DNS [drp](http://rebar.digital/)
  - Subnets
  - VLAN
3. CPU SDC - Central Processing Unit (CPU) Software Defined Compute (SDN) 
  - Bare Metal Boot iPXE [drp](http://rebar.digital/)
  - Virtual Machines [proxmox](https://www.proxmox.com/en/proxmox-ve)
  - K8s [k8s](https://kubernetes.io/)
4. Storage SDS - Software Defined Storage (SDS)
  - local [drp](http://rebar.digital/)
  - iSCSI [drp](http://rebar.digital/) [freeNAS](https://www.freenas.org/)
  - NFS [freeNAS](https://www.freenas.org/)
  - ceph [proxmox](https://www.proxmox.com/en/proxmox-ve)
