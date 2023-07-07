# gh coldstorage

Mapping the status of network and devices for coldstorage.

wip info [https://github.com/christrees/wip/edit/main/labnotes/gh-build.md](https://github.com/christrees/wip/edit/main/labnotes/gh-build.md)

## gh backup build
- based on [neststack proxmox](https://github.com/2cld/netstack/tree/master/docs/lan/compute/proxmox)

## gh.lan local 192.168.254.0/24 gw [http://192.168.254.254/](http://192.168.254.254/) 

| web proxy    |   Link  | type | description |
|--------------|---------|------|-------------|
| 0028.ftth.farmtel.net | [https://208.126.60.28/](https://208.126.60.28/) | static | farmtel public IP |
|--------------|---------|------|-------------|
| farmtel | [http://192.168.254.254/](http://192.168.254.254/) | static | farmtel gw |
| gh.lan | [http://192.168.254.1/](http://192.168.254.1/) | static | gh ns gw |
| projects | [http://192.168.254.6/](http://192.168.254.6/) | dhcp-res | gh projects gw |
| magma | [http://192.168.254.4/](http://192.168.254.4/) | dhcp-res | gh magma |

- IPA DNS [https://192.168.254.1/status_dhcp_leases.php](https://192.168.254.1/status_dhcp_leases.php)
- IPA DNS binds [https://192.168.254.1/services_unbound.php](https://192.168.254.1/services_unbound.php}
- gh does not have control of this gw router 208.126.60.28
- [https://whatismyipaddress.com/](https://whatismyipaddress.com/) [https://whatismyipaddress.com/ip/208.126.60.28](https://whatismyipaddress.com/ip/208.126.60.28)
- IPA [http://192.168.254.254/advancedsetup_dhcpreservation.html](http://192.168.254.254/advancedsetup_dhcpreservation.html)
- DNS pfsense [http://192.168.254.1](http://192.168.254.254/) route to 192.168.252.0/23 subnet


## 192.168.252.0/23 gw [http://192.168.252.1/](http://192.168.252.1/) dns 192.168.253.254
  
| web proxy    |   Link  | type | description |
|--------------|---------|------|-------------|
| ng.gh.lan | [https://192.168.253.254/](https://192.168.253.254/) | static | pfsense ng on subnet |
| sg.gh.lan | [https://192.168.252.2/](https://192.168.252.2/) | static | truenas sg on subnet |
| cg.gh.lan | [https://192.168.252.3:8006/](https://192.168.252.3:8006/) | static | proxmox cg on subnet |
| sg2.gh.lan | [https://192.168.252.6/](https://192.168.252.6/) | static | truenas sg2 garage ? on subnet |
| lot.gh.lan | [https://192.168.252.12/](https://192.168.252.12/) | static | truenas log ? on subnet |
| ~~nginx default~~ | [http://192.168.2.103/](http://192.168.2.103/) | static | ~~default nginx proxy page running in portainer~~ |
| ~~nginx proxy admin~~ | [http://192.168.2.103:81](http://192.168.2.103:81) | macDHCP | ~~admin for nginx running in portainer~~ |
| ~~portainer admin~~ | [http://192.168.2.103:9000](http://192.168.2.103:9000) | macDHCP | portainer admin on proxmox docker 103 |
| ~~dockerplex web~~ | [http://192.168.2.103:32400](http://192.168.2.103:32400) | ~~macDHCP | 32400 on IP plex on portainer~~ |
| ~~tnasplex web~~ | [http://192.168.2.2:32500](http://192.168.2.2:32500) | static | ~~32500 on IP plex on portainer~~ |
| catghwin10 | [http://192.168.252.10](http://192.168.252.10) | static | windows 10 cat zt 10.147.17.127 |

- [https://my.zerotier.com/](https://my.zerotier.com/)
- tbd

---
# DNS Resolver [https://192.168.253.254/services_unbound.php](https://192.168.253.254/services_unbound.php)
```
alpine	gh.lan	192.168.254.91	Artist Workstation	 
avanti	gh.lan	192.168.254.96	Artist Workstation	 
char1	gh.lan	192.168.254.101	Puppet Justice CHAR1	 
char2	gh.lan	192.168.254.102		 
char3	gh.lan	192.168.254.103	Puppet Station	 
cybertruck	gh.lan	192.168.254.95	cybertruck	 
eclipse	gh.lan	192.168.254.94	Reception Computer	 
galaxy	gh.lan	192.168.254.1	ghadmin DNS	 
garage	gh.lan	192.168.252.2	ghadmin storage	 
gremlin	gh.lan	192.168.254.93	Grasshorse Conference Room Workstation	 
magma	gh.lan	192.168.254.4	ghadmin project management	 
ng	gh.lan	192.168.253.254	Grasshorse Network Gateway	 
network	gh.lan	Alias for ng.gh.lan	 Long Name for Network Gateway	
peugeot	gh.lan	192.168.254.87	Vivan's Computer	 
pinzgauer	gh.lan	192.168.254.83	Grasshorse Artist Workstation	 
projects	gh.lan	192.168.254.6	gh project storage	 
prowler	gh.lan	192.168.254.8	ghadmin storage - Projects	 
ram	gh.lan	192.168.254.11	Media Computer	 
saturn	gh.lan	192.168.254.92	Conference Room Computer	 
sg	gh.lan	192.168.252.2	Grasshorse Storage Gateway FreeNAS	 
storage	gh.lan	Alias for sg.gh.lan	 Long Nmae	
stream	gh.lan	192.168.254.3	Internal Streaming Server	 
studebaker	gh.lan	192.168.254.90	Artist Workstation	 
switcher	gh.lan	192.168.254.110	Sound Room Switcher	 
tesla	gh.lan	192.168.254.88	Surface Pro Laptop	 
triumph	gh.lan	192.168.254.89	Mac Workstation	 
viper	gh.lan	192.168.254.81	viper
```
