# WebSense Hub
A prototype Data Mashup application for the Rasberry Pi Model B+.

The following instructions outline the software and configuration required for a fresh install of Raspbian.

# Installation Instructions #

Before starting this process:

```
sudo apt-get update

sudo apt-get upgrade
```

## VSFTPD FTP Server ##

```
sudo apt-get install vsftpd
```

Configuration (/etc/vsftpd.conf):
```
anonymous_enable=NO

local_enable=YES

write_enable=YES

force_dot_files=YES
```

## Lighttpd Web Server ##

```
sudo apt-get -y install lighttpd

sudo chown www-data:www-data /var/www

sudo chmod 775 /var/www

sudo usermod -a -G www-data <username>
```

## PHP ##

```
sudo apt-get -y install php5-common php5-cgi php5 php5-cli

sudo lighty-enable-mod fastcgi-php

sudo service lighttpd force-reload
```

## PHP cURL ##

```
sudo apt-get install php5-curl
```

## Apache Ant ##

```
sudo apt-get install ant
```

## OrientDB ##

```
git clone https://github.com/orientechnologies/orientdb.git

cd orientdb

ant clean install

sudo mkdir /etc/orientdb

sudo mkdir /etc/orientdb/releases

sudo mv ../releases/ /etc/orientdb/

```

Configuration (/etc/orientdb/releases/orientdb-community-2.0.1/bin/console.sh):

```

*set MAXHEAP=-Xmx256m*

*ORIENTDB_DIR="/etc/orientdb/releases/orientdb-community-2.0.1"*

*ORIENTDB_USER="<username>"*

```

Install as a service:

```

sudo cp /etc/orientdb/releases/orientdb-community-2.0.1/bin/orientdb.sh /etc/init.d/orientdb

sudo chmod 777 /etc/init.d/orientdb

```

Add a user to OrientDB:

```
nano /etc/orientdb/releases/orientdb-community-2.0.1/config/orientdb-server-config.xml

*<user resources="*" password="<password>" name="<username>"/>*
```

Start OrientDB server (it can take ~15 seconds to stop and start):

```
sudo /etc/init.d/orientdb start
```

Create a new database:

```
/etc/orientdb/releases/orientdb-community-2.0.1/bin/console.sh

create database remote:localhost/websensehub <username> <password> plocal
```

## Composer ##

```
curl -sS https://getcomposer.org/installer | php

sudo mv composer.phar /usr/local/bin/composer
```

## PHPOrient ##

```
cd /var/www/app/vendor/

git clone https://github.com/Ostico/PhpOrient.git

cd PhpOrient

composer --no-dev install

rm -rf tests
```

## NodeJS ##

```
wget http://node-arm.herokuapp.com/node_latest_armhf.deb

sudo dpkg -i node_latest_armhf.deb

npm config set registry http://registry.npmjs.org/
```

## Grunt ##

```
sudo npm install -g grunt-cli

cd /var/www/app

sudo npm install

```

## React ##

```

sudo npm install -g react-tools

sudo npm install -g grunt-react

sudo npm install grunt-react --save-dev

```

## Bower  ##

```
sudo npm install -g bower

cd /var/www/app

bower install
```

If "Failed to execute "git ls-remote --tags --heads git://github.com/Modernizr/Modernizr.git", exit code of #128":

```
git config --global url."https://".insteadOf git://
```

## OrientDB Studio ##

```
git clone https://github.com/orientechnologies/orientdb-studio.git

sudo npm install -g yo compass

cd orientdb-studio

sudo npm install

bower install
```

Once the server is running, open port 2480 in your web browser (http://domain:2480).

Alternatively, run grunt server and open port 9000 in your web browser (http://domain:9000).

```
grunt server
```

# Running the Server #

## Start OrientDB ##

```
sudo /etc/init.d/orientdb start
```

## Start Lighttpd Web Server ##

```
sudo /etc/init.d/lighttpd start
```

# Configuring the Server #

Lighttpd config file (/etc/lighttpd/lighttpd.conf) must include the following settings:
```
server.modules = (
  "mod_rewrite"
)

# Rewrites
url.rewrite-once = (
  "/app.*" => "/app/index.php",
  "/api/rest/v1.*" => "/api/rest/v1.php"
)
```
