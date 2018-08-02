#!/bin/bash

### BEGIN INIT INFO  
# Provides:             developserver  
# Required-Start:       $local_fs $remote_fs   
# Required-Stop:        $local_fs $remote_fs  
# X-Start-Before:  
# X-Stop-After:  
# Default-Start:        2 3 4 5  
# Default-Stop:         0 1 6  
# Description:          AutoStart  Apcid
# Short-Description:    AutoStart  Apcid 
### END INIT INFO  

dhclient &
sleep 12
oldip=$(cat /root/ip/oldip) 

ip=$(/sbin/ifconfig -a|grep inet|grep -v 127.0.0.1|grep -v 192.168.122.1 | grep -v inet6 | awk '{print $2}' | tr -d "addr:")
url=http://$ip
echo $url > /var/log/iplog
mysql -uroot -proot -e "use tcho;update type_options set value='$url' where name='siteUrl'" &>/dev/null &

/usr/local/apcid/protect.sh 1>/dev/null 2>&1 &
