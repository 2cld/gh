# Artist Blender Station on Raspberry Pi 4
The purpose is to setup a Raspberry Pi 4 as an Artist Workstation for Blender 2.8x use.

## Setup
1. Download [Raspbian Buster with desktop and recommended software](https://www.raspberrypi.org/downloads/raspbian/).
2. The 2.65 GB file name was: 2020-02-05-raspbian-buster-full.zip at the time of this document.
3. Download [Balena.io Etcher](https://github.com/balena-io/etcher) and install.
4. Burn raspbian to SD Card.
5. Insert SD Card into rpi4 and power-on.  You will be asked config information an will be required to reboot.
6. After reboot we need to [update to debian bullseye](https://ultra-technology.org/linux_for_beginners/from-buster-to-bullseye-debian/):
    1. Edit /etc/apt/sources.list to add bullseye
    ```bash
    deb http://ftp.uk.debian.org/debian/ bullseye main contrib non-free
    ```
    2. Update the system package database. New package versions will be available:
    ```bash
    sudo apt update
    ```
    3. Make a full upgrade of the system (this may take awhile and has a few interactive prompts):
    ```bash
    sudo apt upgrade
    sudo apt dist-upgrade
    ```
    4. Reboot the system to start new kernel and services.
    5. Check the release:
    ```bash
    lsb_release -a
    ...
    Distributor ID:	Debian
    Description:	Debian GNU/Linux bullseye/sid
    Release:	testing
    Codename:	bullseye
    ```
7. Install blender:
```bash
apt-get install blender
```
8. Check blender version (should be 2.82 at the time of this document):
```bash
blender --version
```
9. Start blender and check
```bash
./blender
```
