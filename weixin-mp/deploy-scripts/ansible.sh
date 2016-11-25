#!/bin/bash

git co develop
git pull

user=rayjoy

path=/home/$user/plattech/airport/weixin-mp-game
ansible_group=weixin-mp-game

ansible $ansible_group -m shell -a "mkdir -p $path"
ansible $ansible_group -m synchronize -u $user -a "src=.. dest=$path delete=yes rsync_opts=--exclude=*.git*,--exclude=*.svn*,--exclude=*.swp"
ansible $ansible_group -m shell -a "cd $path/deploy-scripts; sh publish.sh" --sudo
