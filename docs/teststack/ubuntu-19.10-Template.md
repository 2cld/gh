# ubuntu-19.10 Template in 2cld grid

## Creation 

- Create on [pm01 VM 300](https://192.168.9.121:8006/#v1:0:=qemu%2F300:4::::::=cluster) 
- Used ubuntu-19.10-live-server-amd64.iso [pm01 -> local -> Content](https://192.168.9.121:8006/#v1:0:=storage%2Fpm01%2Flocal:4::19::::=cluster)
- SSH server

## Updates pre-template

```bash
radmin@ratestweb:~$ sudo apt update
radmin@ratestweb:~$ sudo apt install unzip
radmin@ratestweb:~$ sudo apt install apt-transport-https ca-certificates curl software-properties-common
radmin@ratestweb:~$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
radmin@ratestweb:~$ sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"
radmin@ratestweb:~$ sudo apt update
radmin@ratestweb:~$ apt-cache policy docker-ce
radmin@ratestweb:~$ sudo apt install docker-ce
radmin@ratestweb:~$ sudo docker
radmin@ratestweb:~$ sudo systemctl status docker
radmin@ratestweb:~$ sudo usermod -aG docker ${USER}
radmin@ratestweb:~$ su - ${USER}
radmin@ratestweb:~$ docker
radmin@ratestweb:~$ ip addr
radmin@ratestweb:~$ curl -s https://install.zerotier.com | sudo bash
radmin@ratestweb:~$ sudo zerotier-cli join af78bf94368a72f4
```

## Network pre-template

```bash
radmin@ratestweb:~$ ip addr
1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
    inet 127.0.0.1/8 scope host lo
       valid_lft forever preferred_lft forever
    inet6 ::1/128 scope host 
       valid_lft forever preferred_lft forever
2: ens18: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether xx:xx:xx:xx:xx:x8 brd ff:ff:ff:ff:ff:ff
    inet 192.168.9.19/24 brd 192.168.9.255 scope global dynamic ens18
       valid_lft 84527sec preferred_lft 84527sec
    inet6 xx/64 scope link 
       valid_lft forever preferred_lft forever
3: zthnhdlzwc: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 2800 qdisc fq_codel state UNKNOWN group default qlen 1000
    link/ether xx:xx:xx:xx:xx:xe brd ff:ff:ff:ff:ff:ff
    inet 10.147.19.89/24 brd 10.147.19.255 scope global zthnhdlzwc
       valid_lft forever preferred_lft forever
    inet6 xxx/64 scope link 
       valid_lft forever preferred_lft forever
4: docker0: <NO-CARRIER,BROADCAST,MULTICAST,UP> mtu 1500 qdisc noqueue state DOWN group default 
    link/ether xx:xx:xx:xx:xx:xa brd ff:ff:ff:ff:ff:ff
    inet 172.17.0.1/16 brd 172.17.255.255 scope global docker0
       valid_lft forever preferred_lft forever
radmin@ratestweb:~$ 
```

## Cloud-Init config [See docs/proxmox](https://github.com/2cld/gh/new/master/docs/proxmox)

### Prep VM

1. Install cloud-init package
    ```bash
    radmin@ratestweb:~$ sudo apt install cloud-init
    [sudo] password for radmin: 
    Reading package lists... Done
    Building dependency tree       
    Reading state information... Done
    cloud-init is already the newest version (19.2-36-g059d049c-0ubuntu3).
    0 upgraded, 0 newly installed, 0 to remove and 20 not upgraded.
    radmin@ratestweb:~$ 
    ```
2. Remove extra cloud config stuff
  - Edit cloud.cfg [See Video](https://youtu.be/8qwnXd1yRK4?list=PLT98CRl2KxKGDJbitpQQPOKE__pXlWH7U&t=118)
m    ```bash
    radmin@ratestweb:~$ sudo vi /etc/cloud/cloud.cfg
    ```
    - Go to: cloud_config_modules
      - Remove "snap stuff" 2 lines
      - Remove "ubuntu-advantage"
      - Remove "disable-ec2-metadata"
      - Remove "byobu"
    - Go to: cloud_final_modules
      - Remove snappy
      - Remove fan, lxd, puppet, chef, mcollective, salt-minion, rightscale_userdata
3. Fix MAC Clone Issue
    - REMOVE machine ID from VM
      ```bash
      radmin@ratestweb:~$ sudo rm /etc/machine-id 
      radmin@ratestweb:~$ sudo touch /etc/machine-id
      radmin@ratestweb:~$ cat /etc/machine-id 
      radmin@ratestweb:~$ 
      ```
    - soft link machine-id seemed to be fixed in 19.10 (softlink was there)
      ```bash
      radmin@ratestweb:~$ cat /etc/machine-id 
      radmin@ratestweb:~$ cat /var/lib/dbus/machine-id 
      radmin@ratestweb:~$ ls -l /var/lib/dbus/machine-id 
      lrwxrwxrwx 1 root root 15 Dec  9 03:45 /var/lib/dbus/machine-id -> /etc/machine-id
      radmin@ratestweb:~$ sudo apt clean
      radmin@ratestweb:~$ sudo poweroff
      Connection to 10.147.19.89 closed by remote host.
      Connection to 10.147.19.89 closed.
      ```
4. Create Cloud Init Drive (Remove CD as it causes issues durning migration)
    - pm01 -> Hardware -> Add -> CloudInit Drive
      - Storage: local-lvm
    - pm01 -> Hardware -> Click "CD/DVD Drive" -> Click "Remove"
    - pm01 -> Cloud-Init -> Edit
      - User: radmin
      - Password: see#note
5. Create Clone of Template 
    - Target Node: pm01
    - VM ID: 601
    - Name: raweb01
    - Mode: Full Clone
    - Repeat... should get machines
6. Fix zerotier - Remove /var/lib/zerotier-one/identity.public and /var/lib/zerotier-one/identity.secret and regen
    - ra01web   10.147.19.90
    - ra02auth  10.147.19.91
    - ra03api   10.147.19.115
    - ra04db    10.147.19.189
    - Following Edits
    ```bash
    radmin@ratestweb:~$ sudo vi /etc/hostname
    radmin@ratestweb:~$ sudo vi /etc/hosts
    radmin@ratestweb:~$ sudo rm /var/lib/zerotier-one/identity.* 
    radmin@ratestweb:~$ sudo zerotier-cli join af78bf94368a72f4
    radmin@ratestweb:~$ sudo reboot
    ```
    - After REBOOT Add new machine to zerotier auth

<!--
Before cloud init

radmin@ratestweb:~$ ip addr
1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
    inet 127.0.0.1/8 scope host lo
       valid_lft forever preferred_lft forever
    inet6 ::1/128 scope host 
       valid_lft forever preferred_lft forever
2: ens18: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether 66:28:39:ef:63:58 brd ff:ff:ff:ff:ff:ff
    inet 192.168.9.19/24 brd 192.168.9.255 scope global dynamic ens18
       valid_lft 84527sec preferred_lft 84527sec
    inet6 fe80::6428:39ff:feef:6358/64 scope link 
       valid_lft forever preferred_lft forever
3: zthnhdlzwc: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 2800 qdisc fq_codel state UNKNOWN group default qlen 1000
    link/ether f6:a5:79:0d:b0:5e brd ff:ff:ff:ff:ff:ff
    inet 10.147.19.89/24 brd 10.147.19.255 scope global zthnhdlzwc
       valid_lft forever preferred_lft forever
    inet6 fe80::f4a5:79ff:fe0d:b05e/64 scope link 
       valid_lft forever preferred_lft forever
4: docker0: <NO-CARRIER,BROADCAST,MULTICAST,UP> mtu 1500 qdisc noqueue state DOWN group default 
    link/ether 02:42:6d:7a:49:0a brd ff:ff:ff:ff:ff:ff
    inet 172.17.0.1/16 brd 172.17.255.255 scope global docker0
       valid_lft forever preferred_lft forever
radmin@ratestweb:~$ sudo apt install cloud-init

After clone

radmin@ratestweb:~$ ip addr
1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
    inet 127.0.0.1/8 scope host lo
       valid_lft forever preferred_lft forever
    inet6 ::1/128 scope host 
       valid_lft forever preferred_lft forever
2: ens18: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether 06:a2:31:2f:c2:15 brd ff:ff:ff:ff:ff:ff
    inet 192.168.9.15/24 brd 192.168.9.255 scope global dynamic ens18
       valid_lft 86302sec preferred_lft 86302sec
    inet6 fe80::4a2:31ff:fe2f:c215/64 scope link 
       valid_lft forever preferred_lft forever
3: zthnhdlzwc: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 2800 qdisc fq_codel state UNKNOWN group default qlen 1000
    link/ether f6:a5:79:0d:b0:5e brd ff:ff:ff:ff:ff:ff
    inet 10.147.19.89/24 brd 10.147.19.255 scope global zthnhdlzwc
       valid_lft forever preferred_lft forever
    inet6 fe80::f4a5:79ff:fe0d:b05e/64 scope link 
       valid_lft forever preferred_lft forever
4: docker0: <NO-CARRIER,BROADCAST,MULTICAST,UP> mtu 1500 qdisc noqueue state DOWN group default 
    link/ether 02:42:94:89:46:7e brd ff:ff:ff:ff:ff:ff
    inet 172.17.0.1/16 brd 172.17.255.255 scope global docker0
       valid_lft forever preferred_lft forever
       
-->
