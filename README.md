
ServerStatus
============
 - Check configured Service Status

Installation
============
1. Create a database with a user.
2. Import the servers.sql file in in the /sql/ folder, to populate the database.
3. Configure /config/ky-config.php with the database and user information.
4. Execute "composer update" 
5. Copy uptime.php to any server you want to monitor. This needs to be publicly accessible.
6. Enter to /admin and use the credentials: nyah@nyah.com ; 1234

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

ChangeLog
===========
2.0.0 **Must be reinstalled**
* Admin Panel to manage the database info without access the database manually.
* The frontend has change it database connection to PDO system
* Used PHPAuth to manage the users and Bootstrap to the Backend
* Mooved a lot of things.

1.2.0
* AutoRefrest to 10 seconds

1.1.0
* Changes on basic performance

1.0.0
* Forked

Future Developments
============
* Deploy on servers connecting with FTP or SSH to remote host

Used Components
===============
* jQuery (v1.11.0) - http://jquery.com/
* Bootstrap (v3.1.1) - http://getbootstrap.com/
* Bootstrap Form Helper (v2.3.0) - http://bootstrapformhelpers.com/
* Bootstrap Validator (v0.4.4) - http://bootstrapvalidator.com/
* PHPAuth (v1.1.1) - https://github.com/PHPAuth/PHPAuth

Credits
============
This fork is made from [Mojeda GitHub](https://github.com/mojeda/ServerStatus) after making some changes
ServerStatus is based off [BlueVM's](http://uptime.bluevm.com/) Uptime Checker script, [original download and information](http://www.lowendtalk.com/discussion/comment/169690#Comment_169690).
