#!/bin/sh

. ./.env

NOW=$(date +'%Y%m%d-%H%M%S')

mv sql/dump.sql sql/"$NOW".sql
docker exec -it ${COMPOSE_PROJECT_NAME}_mysql sh -c "MYSQL_PWD=${WP_MYSQL_ROOT_PASSWORD} mysqldump -u root ${WP_MYSQL_DATABASE}" > sql/dump.sql

echo "export success"