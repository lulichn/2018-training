#!/bin/sh
set -ex

CURRENT=$(cd $(dirname $0) && pwd)

cd /etc/httpd/conf/

if [ ! -L httpd.conf ] && [ -f httpd.conf ]; then
  mv httpd.conf httpd.conf.backup
  ln -s -r /srv/vilog/httpd/conf/httpd.conf httpd.conf
fi


