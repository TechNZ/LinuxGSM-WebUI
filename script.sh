#!/bin/bash
#

everything=${@}

fn_syntax(){
        echo "Usage: ${0} {URL|delete|clean}" >&2
        exit 0
}



case ${2} in

variable)
	variable=`su -c "cat /home/srcds/${1}/script.sh | egrep -e ^${3}\=" srcds`
	variable=${variable##*\=}
	echo ${variable}
;;
start)
	su -c "/home/srcds/${1}/script.sh start" srcds
;;
stop)
	su -c "/home/srcds/${1}/script.sh stop" srcds
;;
restart)
	su -c "/home/srcds/${1}/script.sh restart" srcds
;;
details)
	su -c "/home/srcds/${1}/script.sh details" srcds
;;
update)
	su -c "/home/srcds/${1}/script.sh update" srcds
;;
command)
	su -c "tmux send-keys -t ${1} C-z \"${everything#*command\ }\" Enter" srcds
;;
live)
#su -c "/var/www/technz.info/srv/resize.sh" srcds
su -c "tmux capture-pane -pS -20000 -t ${1} | tail -n 400" srcds
;;
  *)
  echo "Please select a valid server"
;;
esac