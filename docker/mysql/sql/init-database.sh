#!/usr/bin/env bash

MYSQL_DATABASE=${MYSQL_DATABASE:-default}
MYSQL_USER=${MYSQL_USER:-root}
MYSQL_PASSWORD=${MYSQL_PASSWORD:-root}

envsubst < "/docker-entrypoint-initdb.d/000-create-database.sql" | mysql -u root -proot
envsubst < "/docker-entrypoint-initdb.d/001-create-users.sql" | mysql -u root -proot
envsubst < "/docker-entrypoint-initdb.d/002-create-users-table.sql" | mysql -uroot -proot -D "$MYSQL_DATABASE"