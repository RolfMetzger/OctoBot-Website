# OctoBot-Website


## Install

### 1) Get all source files

```
git clone https://github.com/Drakkar-Software/OctoBot-Website.git
cd OctoBot-Website
composer install
```

### 2) Create database

In the commands below, replace **aSecurePassword** with a secure password.

Here are the steps to create the database, either with MySQL or with PostreSQL :

#### Either with MySQL

```
sudo mysql
CREATE USER 'octoweb'@'localhost' IDENTIFIED BY 'aSecurePassword';
CREATE DATABASE octoweb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON octoweb.* TO 'octoweb'@'localhost';
```

Update the password in the **.env** file :
DATABASE_URL=mysql://octoweb:**aSecurePassword**@127.0.0.1:3306/octoweb

#### Or with PostgreSQL

TODO


### 3) Fill database and start built-in server

```
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
php bin/console server:start
```

### 4) With your web browser, open where server is listening on

For example : http://127.0.0.1:8000

![Alt text](doc/octobot_website_login.png?raw=true "OctoBot website login page")

Here is initial credentials of the super-admin user.
 - Username : firstadmin
 - Password : 123First*
