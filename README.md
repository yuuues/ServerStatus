
ServerStatus
============

This fork is made from [Mojeda GitHub](https://github.com/mojeda/ServerStatus) after making some changes

ServerStatus is based off [BlueVM's](http://uptime.bluevm.com/) Uptime Checker script, [original download and information](http://www.lowendtalk.com/discussion/comment/169690#Comment_169690).

Installation
============

1. Create a database with a user.
2. Import the servers.sql file in in the /sql/ folder, to populate the database.
3. Configure /includes/config.php with the database and user information.
4. Copy uptime.php to any server you want to monitor. This needs to be publicly accessible.
5. Insert an entry into the database.
  * name - The name of your server.
  * url - The URL path to the uptime.php file (minus uptime.php and http://) e.g. dns.domain.tld/path/
  * location - Where is your server physically located?
  * host - The name of the host of which your server is hosted by.
  * type - What type of server is this? DNS, SQL, Apache/nginx, etc.

Requirements
============
**Remote Servers**:
* PHP5, currently php_exec needs to be enabled in order to get the uptime.
* Web Server (lighttpd, apache2, nginx, etc.)
* You do **NOT** need a database running on the remote servers.

**Master Server**:
* PHP5 + PHP5_CURL
* Web Server (lighttpd, apache2, nginx, etc.)
* mySQL server unless you choose to use a remote mySQL server.
# ServerStatus
