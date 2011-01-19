#!/bin/sh

# get hostname
hostname=`hostname`

lHost="snitch.5th.ch/post.php"

#echo "hostname: $hostname"

curl -s --get --data "hostname=$hostname" http://$lHost
