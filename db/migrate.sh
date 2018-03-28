#!/bin/sh -ex

CURRENT=$(cd $(dirname $0) && pwd)

mysql --defaults-extra-file=./db_conn.conf -h localhost < init.sql
mysql --defaults-extra-file=./db_conn.conf -h localhost < CREATE_TABLE_posts.sql
mysql --defaults-extra-file=./db_conn.conf -h localhost < CREATE_TABLE_upload_job_queue.sql

