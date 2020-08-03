# cpanel-hosting-node.js

### About
Cpanel is a project whose goal is to manage node.js servers hosted on a vps or windows computer.

The initial idea of the project was to be used for personal use, but it is adapted for commercial use and can have several users, therefore, it can be used to resell servers, etc.

#### This panel has the following functions:
- Create application
- Manage Applications (start stop or delete application)
- Basic system of notes or reminders where it will be available to all registered users

------------

##### Requirements
- Windows OS
- PHP 7.3 or >
- MySQL database

------------

##### How to configure
1. Download and unzip the project into your apache
2. Edit the file src\App\Configs.php and change to your database infos
```php
define('db_host','localhost');
define('db_user','root');
define('db_pass','');
define('db_name','panelapp');
```
3. In same file, you can edit another configs
```php
define('titulo_site', "Cpanel"); // Title of cpanel

define('base_href','http://localhost/cpanel/'); //IMPORTANT!! Put here the url of your website.  ex: https://mywebsite.com/

define("host_ip", "localhost"); //change localhost to ip or dns where your host node will be hosted
define("host_root", "d:\\nodeServers\\"); //Change to directory where we will go create the folder and files of the apps/project
```
4.  Import the database file panelapp.sql located at the root of the project and run.

------------

#### Access data
- Username: Admin
- Password: Admin

You can create another users into your phpmyadmin, however the password must be in  password_bcrypt. You can generate your hash using the link below:
- https://bcrypt-generator.com/

------------

#### makecontroller.php
You can use the makecontroller.php to create/delete another pages

------------

#### Another Infos
-

------------

#### Updates:
-
