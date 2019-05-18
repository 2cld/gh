# Blender Cache Bake

## Issue with blender smoke test.

- For rendering baked smoke cache files are needed but not included in blend zip
- For large baked files, zip on windows workstation had issues with large files (we think)
- Each frame only need the one bake file
- See [Blender Cache](https://docs.blender.org/manual/en/latest/physics/particles/emitter/cache.html)

### Test
Testing some ideas out...

#### FIX1 - Move cache via tar to node b037
- at the same dir level as the .blend needs to be the smoke_cashe
- Use tar to bundle and move the smoke_cashe (takes over 20min to bundle and move)
- tar smoke_cashe and move .tar and .zip to bn037
```
ghadmin@magma:/media/projects/0215/002/prod/0215_002_0007A/3d/3danim$ tar -cvf smoke_cashe-test.tar smoke_cashe/
ghadmin@magma:/media/projects/0215/002/prod/0215_002_0007A/3d/3danim$ scp smoke_cashe-test.tar ghadmin@bn037:/home/ghadmin/
ghadmin@magma:/media/projects/0215/002/prod/0215_002_0007A/3d/3danim$ scp 0215_002_0007A_3danim_v002.zip ghadmin@bn037:/home/ghadmin/
```
- extract tar
```
ghadmin@bn037:~$ tar -xvf smoke_cashe-test.tar
```
- prep and render a frame
```
ghadmin@bn037:~$ unzip 0215_002_0007A_3danim_v002.zip
ghadmin@bn037:~$ blender -b 0215_002_0007A_3danim_v002.blend -y -F PNG -o testout -t 0 -f 52
```
- move to Check that it works
```
ghadmin@bn037:~$ cp testout0052.png /media/farm/
```
- !!!_YES_!!! THAT WORKS

#### FIX2 - Move only one bake frame to b037
- copy just .zip to bn040
```
ghadmin@magma:/media/projects/0215/002/prod/0215_002_0007A/3d/3danim$ scp 0215_002_0007A_3danim_v002.zip ghadmin@bn040:/home/ghadmin/
```
- create smoke-frame and put just frame 52 bake in it
```
ghadmin@bn040:~$ mkdir smoke_cashe
```
- from magma push the frame
```
ghadmin@magma:/media/projects/0215/002/prod/0215_002_0007A/3d/3danim$ scp smoke_cashe/_000052_01.bphys  ghadmin@bn040:/home/ghadmin/smoke_cashe/
```
- prep and Render frame 52
```
ghadmin@bn040:~$ unzip 0215_002_0007A_3danim_v002.zip 
ghadmin@bn040:~$ blender -b 0215_002_0007A_3danim_v002.blend -y -F PNG -o testout -t 0 -f 52
```
- move to Check that it works
```
ghadmin@bn040:~$ cp testout0052.png /media/farm/testout0052-check.png
```
- __YES__ THAT WORKS

#### FIX3 - Just link the cache
- create a link to smoke_cashe
```
ghadmin@bn037:~$ mv smoke_cashe testlink
ghadmin@bn037:~$ mkdir smoke_cashe
ghadmin@bn037:~$ ln -s /home/ghadmin/testlink smoke_cashe
ghadmin@bn037:~$ ls -alu smoke_cashe
lrwxrwxrwx 1 ghadmin ghadmin 22 May 17 18:08 smoke_cashe -> /home/ghadmin/testlink
```
- Render a new frame 60
```
ghadmin@bn037:~$ blender -b 0215_002_0007A_3danim_v002.blend -y -F PNG -o testout -t 0 -f 60
```
- move to Check that it works
```
ghadmin@bn037:~$ cp testout0060.png /media/farm/
```
- !!!_YES_!!! THAT WORKS

#### FIX4 - Move tar to farm and expand, create link to this on each node
- Setup ghcache on farm
```
ghadmin@magma:~$ mkdir /media/farm/ghcache
ghadmin@magma:~$ cd /media/farm/ghcache/
ghadmin@magma:/media/farm/ghcache$ cp /media/projects/0215/002/prod/0215_002_0007A/3d/3danim/smoke_cashe-test.tar .
ghadmin@magma:/media/farm/ghcache$ tar -xvf smoke_cashe-test.tar
```
- create link on each node
- bn0xx - 192.168.254.1xx
```
catmini:~ cat$ ssh ghadmin@192.168.254.1xx
ghadmin@bn0xx:~$ ln -s /media/farm/ghcache/smoke_cashe smoke_cashe
```
- bn036 - 192.168.254.176 - ALSO re-installed blender
- bn037 - 192.168.254.177
- bn040 - 192.168.254.180
- bmbn000 - 192.168.254.110
- bn039 - 192.168.254.179 - ISSUE with mount (need to install nfs client helper)



### NOTES:

#### magma 192.168.254.4
```
ghadmin@magma:~$ cd /media/projects/0215/002/prod/0215_002_0007A/3d/3danim/
ghadmin@magma:/media/projects/0215/002/prod/0215_002_0007A/3d/3danim$ ls
0215_002_0007A_3danim_v001.blend  0215_002_0007A_3danim_v002.blend1  smoke_cashe
0215_002_0007A_3danim_v002.blend  0215_002_0007A_3danim_v002.zip     smoke_cashe-test.tar
ghadmin@magma:/media/projects/0215/002/prod/0215_002_0007A/3d/3danim$ 
```

#### bn040 92.168.254.180
```
ghadmin@bn040:~$ ls -alu
total 1716
drwxr-xr-x 9 ghadmin ghadmin  12288 May 17 17:51 .
drwxr-xr-x 3 root    root      4096 Feb 23 13:20 ..
-rw-rw-rw- 1 ghadmin ghadmin 511936 May 17 17:47 0215_002_0007A_3danim_v002.blend
-rwxrwxr-x 1 ghadmin ghadmin 105467 May 17 17:45 0215_002_0007A_3danim_v002.zip
-rw------- 1 ghadmin ghadmin  20741 May 18 11:33 .bash_history
-rw-r--r-- 1 ghadmin ghadmin    220 May 17 18:22 .bash_logout
-rw-r--r-- 1 ghadmin ghadmin   3771 May 17 17:43 .bashrc
drwx------ 4 ghadmin ghadmin   4096 Jan  5  2017 .cache
drwx------ 3 ghadmin ghadmin   4096 Apr 22  2017 .config
drwx------ 3 ghadmin ghadmin   4096 Feb 22 08:50 .gnupg
drwxrwxr-x 2 ghadmin ghadmin   4096 May  5  2017 .nano
-rwxr-xr-x 1 ghadmin ghadmin  13293 Aug  3  2017 nodeRenderService2.sh
-rwxrwxr-x 1 ghadmin ghadmin  13297 May 16 16:19 nodeRenderService3.sh
-rw-rw-r-- 1 ghadmin ghadmin  38394 May 17 12:54 nodeServiceBlender.log
-rw-rw-r-- 1 ghadmin ghadmin  18121 May 17 12:53 nodeService.log
-rw-r--r-- 1 ghadmin ghadmin    673 May 17 17:43 .profile
-r-------- 1 ghadmin ghadmin     38 Feb  7  2018 .smbcredentials
drwxrwxr-x 2 ghadmin ghadmin   4096 May 17 17:47 smoke_cashe
drwx------ 2 ghadmin ghadmin   4096 Jan  9  2017 .ssh
-rw-r--r-- 1 ghadmin ghadmin      0 Jan  5  2017 .sudo_as_admin_successful
-rw-rw-r-- 1 ghadmin ghadmin 941160 May 17 17:52 testout0052.png
drwxr-xr-x 2 ghadmin ghadmin   4096 Jan  5  2017 .vim
-rw------- 1 ghadmin ghadmin   4160 Jul 29  2017 .viminfo
ghadmin@bn040:~$
```

#### bn037 92.168.254.177
```
ghadmin@bn037:~$ ls -alu
total 9033448
drwxr-xr-x 8 ghadmin ghadmin      16384 May 18 11:35 .
drwxr-xr-x 3 root    root          4096 May 17 17:58 ..
-rw-rw-rw- 1 ghadmin ghadmin     511936 May 17 17:33 0215_002_0007A_3danim_v002.blend
-rwxrwxr-x 1 ghadmin ghadmin     105467 May 17 17:27 0215_002_0007A_3danim_v002.zip
-rw------- 1 ghadmin ghadmin      14903 May 18 11:34 .bash_history
-rw-r--r-- 1 ghadmin ghadmin        220 May 16 18:38 .bash_logout
-rw-r--r-- 1 ghadmin ghadmin       3771 May 17 16:26 .bashrc
drwx------ 4 ghadmin ghadmin       4096 May 17 15:02 .cache
drwx------ 3 ghadmin ghadmin       4096 May 17 15:02 .config
drwx------ 3 ghadmin ghadmin       4096 May 17 15:02 .gnupg
-rwxrwxr-x 1 ghadmin ghadmin      13297 May 16 16:25 nodeRenderService3.sh
-rw-rw-r-- 1 ghadmin ghadmin       1901 May 17 17:30 nodeService.log
-rw-r--r-- 1 ghadmin ghadmin        673 May 17 16:26 .profile
-r-------- 1 ghadmin ghadmin         38 Apr 28  2018 .smbcredentials
lrwxrwxrwx 1 ghadmin ghadmin         22 May 17 18:08 smoke_cashe -> /home/ghadmin/testlink
-rwxrwxr-x 1 ghadmin ghadmin 9248501760 May 17 17:28 smoke_cashe-test.tar
drwx------ 2 ghadmin ghadmin       4096 May 17 15:02 .ssh
-rw-r--r-- 1 ghadmin ghadmin          0 Jan  5  2017 .sudo_as_admin_successful
drwxrwxr-x 2 ghadmin ghadmin       4096 May 17 18:08 testlink
-rw-rw-r-- 1 ghadmin ghadmin       9384 May 17 17:38 testout0052.png
-rw-rw-r-- 1 ghadmin ghadmin    1006885 May 17 18:13 testout0060.png
drwxr-xr-x 2 ghadmin ghadmin       4096 May 17 15:02 .vim
-rw------- 1 ghadmin ghadmin       7330 May 17 17:25 .viminfo
ghadmin@bn037:~$ ls .cache/
motd.legal-displayed  thumbnails  update-manager-core
ghadmin@bn037:~$ ls .cache/update-manager-core/
meta-release-lts
ghadmin@bn037:~$ 
```
