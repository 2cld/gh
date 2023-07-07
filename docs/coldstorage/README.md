[edit](https://github.com/2cld/gh/edit/master/docs/coldstorage/README.md)
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
# DNS Resolver 
- [https://192.168.253.254/services_unbound.php](https://192.168.253.254/services_unbound.php)
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
# Active dhcp leases 192.168.252.0/22 subnet 
- [https://192.168.253.254/status_dhcp_leases.php](https://192.168.253.254/status_dhcp_leases.php)
Note: 192.168.254.0/24 subnet is farmtel with no admin access
```
192.168.252.2	00:30:48:c7:82:b3	storage gateway	sg	sg.gh.lan freenas 4x6TB zfs2 21TB	n/a	n/a	online	static	 
192.168.252.6	00:08:9b:e2:83:93	sg2	sg2	Backup Storage Server TS-431 4x2TB raid5	n/a	n/a	offline	static	  
192.168.252.9	00:15:17:b1:cf:59	dg	dg	Grasshorse GitLab Document Gateway	n/a	n/a	offline	static	  
192.168.252.10	00:1e:67:0f:b9:1c	catghwind10	catghwin10	cat Windows 10 baremetal test machine	n/a	n/a	online	static	 
192.168.252.12	1a:59:cc:25:96:5d	lot	lot	lot storage parking for offline data	n/a	n/a	offline	static	  
192.168.252.19	3c:07:54:72:49:e2	catmini-ghgrid	macci	macci IP when on ghadmin Grid	n/a	n/a	offline	static	  
192.168.252.101	00:1e:67:0f:b7:50	ghg01	ghg01	Grasshorse proxmox grid server ghg01	n/a	n/a	offline	static	  
192.168.252.102	00:1e:67:0f:b9:b1	ghg02	ghg02	Grasshorse proxmox grid server ghg02	n/a	n/a	offline	static	  
192.168.252.103	00:1e:67:0f:ba:94	ghg03	ghg03	Grasshorse proxmox grid server ghg03	n/a	n/a	offline	static
```
# arp table
- [https://192.168.253.254/diag_arp.php](https://192.168.253.254/diag_arp.php)
```
WAN	192.168.254.91	70:8b:cd:54:d7:b4	alpine.gh.lan	Expires in 837 seconds	ethernet	
LAN	192.168.252.10	00:1e:67:0f:b9:1c	catghwin10.gh.lan	Expires in 496 seconds	ethernet	
WAN	192.168.254.103	4c:cc:6a:0d:be:32	char3.gh.lan	Expires in 1172 seconds	ethernet	
WAN	192.168.254.95	04:d9:f5:c8:c7:fc	cybertruck.gh.lan	Expires in 1140 seconds	ethernet	
WAN	192.168.254.94	1c:69:7a:90:17:1f	eclipse.gh.lan	Expires in 1091 seconds	ethernet	
WAN	192.168.254.1	00:1e:67:10:80:88	galaxy.gh.lan	Permanent	ethernet	
WAN	192.168.254.93	4c:cc:6a:0d:bd:1e	gremlin.gh.lan	Expires in 1190 seconds	ethernet	
LAN	192.168.253.254	00:1e:67:10:80:89	ng.gh.lan	Permanent	ethernet	
WAN	192.168.254.6	00:30:48:c9:ee:98	projects.gh.lan	Expires in 854 seconds	ethernet	
WAN	192.168.254.8	00:1e:67:0f:ba:2c	prowler.gh.lan	Expires in 1012 seconds	ethernet	
WAN	192.168.254.11	00:23:df:df:53:21	ram.gh.lan	Expires in 216 seconds	ethernet	
LAN	192.168.252.2	00:30:48:c7:82:b3	sg.gh.lan	Expires in 23 seconds	ethernet	
WAN	192.168.254.90	40:16:7e:37:9d:af	studebaker.gh.lan	Expires in 1163 seconds	ethernet	
WAN	192.168.254.81	4c:cc:6a:0d:be:98	viper.gh.lan	Expires in 1184 seconds	ethernet	
WAN	192.168.254.80	10:c3:7b:46:da:95		Expires in 1190 seconds	ethernet	
WAN	192.168.254.254	ec:4f:82:65:9a:cf		Expires in 1181 seconds	ethernet
```
