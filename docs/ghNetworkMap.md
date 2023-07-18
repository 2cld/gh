[edit](https://github.com/2cld/gh/edit/master/docs/ghNetworkMap.md)

## 192.168.254.0/24 gw [http://192.168.254.254/](http://192.168.254.254/) - IPA [http://192.168.254.254/advancedsetup_dhcpreservation.html](http://192.168.254.254/advancedsetup_dhcpreservation.html)

| web proxy    |   Link  | type | description |
|--------------|---------|------|-------------|
| windstream | [https://173.191.244.125/](https://173.191.244.125/) | static | windstream public IP |
|--------------|---------|------|-------------|
| windstream | [http://192.168.254.254/](http://192.168.254.254/) | static | windstream gw and dhcp|
| pfsense | [http://192.168.254.1/](http://192.168.254.1/) | static | gh.lan dns |
|--------------|---------|------|-------------|
| ~~proxmox admin~~ | [https://192.168.6.103:8006](https://192.168.6.103:8006) | static | proxmox running on metal 192.168.2.3 IP |


## 192.168.252.0/23 gw [http://192.168.253.254/](http://192.168.253.254/)
  
| web proxy    |   Link  | type | description |
|--------------|---------|------|-------------|
| pfsense | [http://192.168.253.254/](http://192.168.253.254/) | static | pfsense dc.gh.lan gw |
| truenas | [http://192.168.2.2/](http://192.168.2.2/) | static | truenas sg on subnet |
| proxmox | [https://192.168.2.3:8006/](https://192.168.2.3:8006/) | static | proxmox cg subnet |
| ~~nginx default~~ | [http://192.168.2.103/](http://192.168.2.103/) | static | ~~default nginx proxy page running in portainer~~ |
| ~~nginx proxy admin~~ | [http://192.168.2.103:81](http://192.168.2.103:81) | macDHCP | ~~admin for nginx running in portainer~~ |
| portainer admin | [http://192.168.2.103:9000](http://192.168.2.103:9000) | macDHCP | portainer admin on proxmox docker 103 |
| ~~dockerplex web~~ | [http://192.168.2.103:32400](http://192.168.2.103:32400) | ~~macDHCP | 32400 on IP plex on portainer~~ |
| ~~tnasplex web~~ | [http://192.168.2.2:32500](http://192.168.2.2:32500) | static | ~~32500 on IP plex on portainer~~ |
| nswin11 | [http://192.168.2.195](http://192.168.2.195) | static | windows 11 vm-400 |
