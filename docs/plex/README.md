# Plex

## plex catwin2016 Setup
1. Remote to Administrator - catwin2016 - ZT (or LAN) (info at cat2net)
2. Download [Plex for Windows Server](https://www.plex.tv/media-server-downloads/)
3. Map Network Drive T: to \\192.168.254.14\SharedMedia (info at DataCenterLayout)
  - File Exlpore -> Right Click Network -> Click Map network drive
    - Drive: T:
    - Folder: \\192.168.254.14\SharedMedia
    - Check: Reconnect at sign-in
    - Check: Connect using different credentials
    - user: (see FreeNAS users)
  - Verify you can see T: and all files
4. Install and Configure Plex
  - In Downloads, Run PlexMediaServer-xxxxx-x86.exe installer
  - Add Libraries (this takes awhile to build up library media info)
    - Photos: T:\CATPhotos
    - Music: T:\CATMusic
    - Movies: T:\CATMovies
    - TV Shows: T:\CATTVShows
5. Verify Plex access
  - Browse to LOCAL [Plex http://127.0.0.1:32400/](http://127.0.0.1:32400/)
  - Browse to NETWORK [Plex http://192.168.1.133:32400/](http://192.168.1.133:32400/)
    - This network is under pfsense https://192.168.1.1 DataCenterLayout (cat9box)
  - Browse to ZT [Plex http://10.147.20.17:32400/](http://10.147.20.17:32400/)
    - This network is under [cat9boxNetwork - zerotier](https://my.zerotier.com/network/93afae596322b601)

## plex FireTV Setup
1. Add FireTV to your [Amazon Devices](https://www.amazon.com/gp/mas/your-account/myapps/yourdevices/ref=mas_ya_dv)
2. On fireTV setup to sideload applications
  - Settings -> My Fire TV -> Developer options
    - ADB debugging: on
    - USB debugging: on
    - Apps from Unknown Soruces: on
  - Settings -> Applications -> Manage Installed Applications
    - Plex - search and download if into installed
    - ZeroTier One - which probably needs installed via step 3
  - end of substeps
3. Use Controller Phone to add ZeroTier One to FireTV
  - Open Apps2Fire
  - Click _SETUP_ menu on far right of menu bar
  - Click _SEARCH FIRE TVS_ which should find all FireTV's on local subnet
  - Click the fireTV you want to sideload app to should confirm connection click OK
  - NOTE you will get a USB Debbuging alert on FireTV Click Always Allow and OK
  - Click _LOCAL APPS> on far left of menu bar
  - Click the ZeroTier One app and _INSTALL_
  - Settings -> Applications -> Manage Installed Applications
  - Select: ZeroTier One -> Launch application
  - Add zerotier network to join
  - Turn on network and OK the connection request
  - Settings: Use Cellular Data
  - Got to [my.zerotier.com/network/younetworkid](https://my.zerotier.com/network/93afae596322b601)
  - Authorize the address and note the device
4. Login to Plex app and verify server access
  - Settings -> Applications -> Manage Installed Applications
  - Select: Plex -> Launch application
  - Select -> SignIn
  - Go to [https://plex.tv/link](https://plex.tv/link) with the google user authorized on PLEX and type in Code
  - Verify access to media with Plex
  - end of substeps
  
## plex FireTV Controller Phone
1. Obtain an Android Phone with signed in google user account
2. Load the following Applications from Google Play App Store
  - [Amazon Fire TV](https://play.google.com/store/apps/details?id=com.amazon.storm.lightning.client.aosp)
  - [Apps2Fire](https://play.google.com/store/apps/details?id=mobi.koni.appstofiretv)
  - [ZeroTier One](https://play.google.com/store/apps/details?id=com.zerotier.one)


## plex in FreeNAS jail
- [Install FreeBSD packages](https://www.cyberciti.biz/faq/howto-freebsd-installing-gnu-wget-command-port/)
- [ZeroTier FreeBSD install](https://gist.github.com/dch/b36dd170209e65677d23f77c44825b5a)
- [FreshPorts.org zerotier](https://www.freshports.org/net/zerotier/)
- [net/zerotier](https://svnweb.freebsd.org/ports/head/net/zerotier/)
- [Tar command](https://www.shellhacks.com/untar-tar-gz-linux-tar-command-extract-tar-file/)

## Other stuff
- [HDHomeRun QUATRO 4K - Kickstarter](https://www.kickstarter.com/projects/1275320038/hdhomerun-atsc-30/description)
- [Sideload FireTV apps](https://www.howtogeek.com/336602/how-to-sideload-apps-on-the-fire-tv-and-fire-tv-stick/)
- [ZeroTier One App](https://play.google.com/store/apps/details?id=com.zerotier.one&hl=en_US)
- [ZeroTier libzt](https://github.com/zerotier/libzt)
- [ZeroTier API.md](https://github.com/zerotier/libzt/blob/master/API.md)
- [WebRTC examples](https://webrtc.github.io/samples/)
