#!/bin/bash
sudo apt update
sudo apt install apache2 apache2-doc libapache2-mod-php openssl 
sudo a2enmod headers
sudo a2enmod env
sudo a2enmod dir
sudo a2enmod mime
sudo a2enmod rewrite
sudo a2enmod setenvif
sudo a2enmod ssl
sudo a2ensite default-ssl
sudo service apache2 reload
sleep 2
sudo apt install php php-common php-xml php-curl php-gd php-json php-mbstring php-zip php-mysql php-bz2 php-intl php-ldap php-smbclient php-imap php-bcmath php-gmp php-redis php-imagick
sudo php -v
sleep 2
sudo apt install mariadb-server mariadb-client
sleep 2
sudo mysql_secure_installation
sleep 2
printf "CREATE DATABASE nextcloud;\n" > ncdb.sql
printf "CREATE USER 'nextcloud'@'localhost' IDENTIFIED BY 'nextcloud123';\n"  >> ncdb.sql
printf "GRANT ALL PRIVILEGES ON nextcloud.* TO 'nextcloud'@'localhost';\n"  >> ncdb.sql
printf "FLUSH PRIVILEGES;\n\\q"  >> ncdb.sql
printf "type \"source ncdb.sql\"\n"
sleep 2
sudo mysql -u root -p
sleep 2
sudo apt install wget zip unzip
sleep 2
sudo rm -r nextcloud/
sudo rm dlds/nextcloud-21.0.3.zip*
wget -P dlds/ https://download.nextcloud.com/server/releases/nextcloud-21.0.3.zip
sleep 2
unzip dlds/nextcloud-21.0.3.zip
sleep 2
cd /var/www/html/
sudo mkdir .apps/
cd 
sudo mv nextcloud/ /var/www/html/.apps/
sudo chown -R www-data:www-data /var/www/html/.apps/nextcloud/
sudo chmod -R 755 /var/www/html/.apps/nextcloud/
printf "Alias /nextcloud \"/var/www/html/.apps/nextcloud/\"\n\n" > nextcloud.conf
printf "<Directory /var/www/html/.apps/nextcloud/>\n" >> nextcloud.conf
printf "  Require all granted\n" >> nextcloud.conf
printf "  AllowOverride All\n" >> nextcloud.conf
printf "  Options FollowSymLinks MultiViews\n\n" >> nextcloud.conf
printf "  <IfModule mod_dav.c>\n" >> nextcloud.conf
printf "    Dav off\n" >> nextcloud.conf
printf "  </IfModule>\n" >> nextcloud.conf
printf "</Directory>\n\n" >> nextcloud.conf
sudo cp nextcloud.conf /etc/apache2/sites-available/
sudo a2ensite nextcloud.conf
sleep 2
sudo service apache2 restart
sleep 3
echo Done.
