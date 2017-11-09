---
title: Doodle3D
---

===== doodle3d firmware readme =====
https://github.com/Doodle3D/Doodle3D-firmware
```
d3dapi p=/network/scan r=GET
```

===== adding a 3D-printer to Doodle3D =====
* http://doodle3d.com/help/adding-3d-printer

===== notes @ DaVinci exhibition =====
* http://connect.doodle3d.com/api/list.php
* http://wifibox/d3dapi/network/signin
* http://192.168.7.216/d3dapi/network/alive?_=1417511804341
* http://192.168.7.216/
* http://wifibox/d3dapi/network/status
* http://wifibox/d3dapi/info/status
* last number of IP's from left to right: 132, 194, 110, 164

===== bootscripts Doodle3D =====
Print3D already has scripts, that where created for the WiFi-Box. It seems to use inotifyd, I'm not sure if that is something we can reuse. 
* [print3d_init](https://github.com/Doodle3D/print3d/blob/master/src/script/print3d_init). A init script that starts the print3d-manager as a deamon. 
* [print3d-manager](https://github.com/Doodle3D/print3d/blob/master/src/script/print3d-manager.sh). Uses inotifyd to start `print3d-new-device` when a new device is connected. 
* [print3d-new-device](https://github.com/Doodle3D/print3d/blob/master/src/script/print3d-new-device.sh). Figures out whether to start print3d in a seemingly crude way. If appropriate it tries to start print3d-runner
* [print3d-runner.sh](https://github.com/Doodle3D/print3d/blob/master/src/script/print3d-runner.sh). Starts the print3d deamon. 

===== Help system =====
* we might want to try: http://www.helpscout.net. It is used by 3dverkstan.