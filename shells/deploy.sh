rm -rf wordpress/main/.htaccess wordpress/main/wp-content
cp -r wordpress/wp-content wordpress/main
cp wordpress/.htaccess wordpress/main

DBHOST='localhost'
DBNAME='DBNAME'
DBUSER='DBUSER'
DBPASSWORD='DBPASSWORD'
SITEREALURL='SITEREALURL'
HOST=localhost:9400

sed -i -e "s/'db:3306'/'${DBHOST}'/" wordpress/main/wp-config.php
sed -i -e "s/'user'/'${DBUSER}'/" wordpress/main/wp-config.php
sed -i -e "s/'12345678'/'${DBPASSWORD}'/" wordpress/main/wp-config.php
sed -i -e "s/'wordpress'/'${DBNAME}'/" wordpress/main/wp-config.php
sed -i -e "s/${HOST}/${SITEREALURL}/" wordpress/main/wp-config.php

zip -r main.zip wordpress/main

sed -i -e "s/${SITEREALURL}/${HOST}/" wordpress/main/wp-config.php
sed -i -e "s/'${DBNAME}'/'wordpress'/" wordpress/main/wp-config.php
sed -i -e "s/'${DBPASSWORD}'/'12345678'/" wordpress/main/wp-config.php
sed -i -e "s/'${DBHOST}'/'db:3306'/" wordpress/main/wp-config.php
sed -i -e "s/'${DBUSER}'/'user'/" wordpress/main/wp-config.php

rm -rf wordpress/main/.htaccess wordpress/main/wp-content

