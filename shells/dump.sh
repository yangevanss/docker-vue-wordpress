#!/bin/sh

. ./.env # 讀取環境變數
SQL=mysql
NOW=$(date +'%Y%m%d-%H%M%S')
mv SQL/dump-newest.sql SQL/"$NOW".sql #備份
docker exec -it ${COMPOSE_PROJECT_NAME}_mysql sh -c "MYSQL_PWD=${WP_MYSQL_ROOT_PASSWORD} mysqldump -u root ${WP_MYSQL_DATABASE}" > SQL/dump-newest.sql # 輸出 SQL
echo "export success"
