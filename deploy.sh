#!/bin/sh
set -ex

CURRENT=$(cd $(dirname $0) && pwd)

# httpd
cd /etc/httpd/conf

if [ ! -L httpd.conf ] && [ -f httpd.conf ]; then
  mv httpd.conf httpd.conf.backup
  ln -s -r $CURRENT/etc/httpd/conf/httpd.conf httpd.conf
fi

# cron
cd /etc/cron.d

if [ ! -L vilog_prepare-videos ]; then
  ln -s -r $CURRENT/etc/cron.d/vilog_prepare-videos vilog_prepare-videos
fi

# DB
cd $CURRENT/db
./migrate.sh

