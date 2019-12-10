# [Zero Tier](https://www.zerotier.com/)

1. Login to your account [my.zerotier.com](https://my.zerotier.com/)
2. Create your own Network [https://my.zerotier.com/network](https://my.zerotier.com/network)
3. Load Client [https://www.zerotier.com/download/](https://www.zerotier.com/download/)
4. curl -s https://install.zerotier.com | sudo bash
5. Auth each node


## Videos
1. [Zerotier Tutorial](https://www.youtube.com/watch?v=Bl_Vau8wtgc)
2. [Zerotier via Wireshark](https://www.youtube.com/watch?v=9Rfqi62bo5M)

## Tests

```bash
radmin@ratestweb:~$ ls /var/log/auth.log | grep radmin | grep session
radmin@ratestweb:~$ cat /var/log/auth.log | grep radmin | grep session
Dec  9 03:54:38 ratestweb login[897]: pam_unix(login:session): session opened for user radmin by LOGIN(uid=0)
Dec  9 03:54:38 ratestweb systemd-logind[823]: New session 2 of user radmin.
Dec  9 03:54:38 ratestweb systemd: pam_unix(systemd-user:session): session opened for user radmin by (uid=0)
Dec  9 03:58:01 ratestweb sshd[1988]: pam_unix(sshd:session): session opened for user radmin by (uid=0)
Dec  9 03:58:01 ratestweb systemd-logind[823]: New session 4 of user radmin.
Dec  9 05:53:14 ratestweb sudo: pam_unix(sudo:session): session opened for user root by radmin(uid=0)
Dec  9 06:03:27 ratestweb sudo: pam_unix(sudo:session): session opened for user root by radmin(uid=0)
Dec  9 06:13:00 ratestweb sshd[3262]: pam_unix(sshd:session): session opened for user radmin by (uid=0)
Dec  9 06:13:00 ratestweb systemd-logind[823]: New session 7 of user radmin.
Dec  9 06:50:00 ratestweb sshd[3507]: pam_unix(sshd:session): session opened for user radmin by (uid=0)
Dec  9 06:50:00 ratestweb systemd-logind[823]: New session 10 of user radmin.
Dec  9 06:55:27 ratestweb sshd[3507]: pam_unix(sshd:session): session closed for user radmin
Dec  9 17:19:24 ratestweb sshd[4547]: pam_unix(sshd:session): session opened for user radmin by (uid=0)
Dec  9 17:19:24 ratestweb systemd-logind[823]: New session 22 of user radmin.
Dec  9 19:33:59 ratestweb sshd[4547]: pam_unix(sshd:session): session closed for user radmin
Dec 10 02:15:03 ratestweb sshd[5284]: pam_unix(sshd:session): session opened for user radmin by (uid=0)
Dec 10 02:15:03 ratestweb systemd-logind[823]: New session 31 of user radmin.
Dec 10 02:19:52 ratestweb sshd[5284]: pam_unix(sshd:session): session closed for user radmin
radmin@ratestweb:~$ netstat

Command 'netstat' not found, but can be installed with:

sudo apt install net-tools

radmin@ratestweb:~$ ps auxwww | grep sshd:
root      1988  0.0  0.1  12908  8056 ?        Ss   Dec09   0:00 sshd: radmin [priv]
radmin    2070  0.0  0.1  13220  6072 ?        S    Dec09   0:00 sshd: radmin@pts/0
root      3262  0.0  0.2  13216  8568 ?        Ss   Dec09   0:00 sshd: radmin [priv]
radmin    3357  0.0  0.1  13216  4940 ?        S    Dec09   0:00 sshd: radmin@pts/1
radmin    5535  0.0  0.0   6296   924 pts/1    R+   02:35   0:00 grep --color=auto sshd:
radmin@ratestweb:~$ pgrep -ai sshd
1797 /usr/sbin/sshd -D
1988 sshd: radmin [priv] 
2070 sshd: radmin@pts/0  
3262 sshd: radmin [priv] 
3357 sshd: radmin@pts/1  
radmin@ratestweb:~$ ss | grep ssh
tcp   ESTAB  0      36                    10.147.19.89:ssh         10.147.19.27:54133                                                                           
tcp   ESTAB  0      0                     192.168.9.19:ssh         192.168.9.17:59023                                                                     
```
