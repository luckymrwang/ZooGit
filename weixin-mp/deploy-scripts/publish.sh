#!/bin/bash

rsync -rltDvz --delete --exclude='*.git*' --exclude='application/logs/*' ../src/ /data/webroot/weixin-mp-game
