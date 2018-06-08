# OctoBot-Website


## Install

### 1) Get all source files

```bash
git clone https://github.com/Drakkar-Software/OctoBot-Website.git
cd OctoBot-Website
composer install
```

### 2) Create database

In the commands below, replace **aSecurePassword** with a secure password.

Here are the steps to create the database, either with MySQL or with PostreSQL.


#### Either with MySQL

Enter this commands in a terminal prompt :
```sql
sudo mysql
CREATE USER 'octoweb'@'localhost' IDENTIFIED BY 'aSecurePassword';
CREATE DATABASE octoweb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON octoweb.* TO 'octoweb'@'localhost';
```

Update config/packages/doctrine.yaml :
```yaml
doctrine:
    dbal:
        # configure these for your MySQL database server
        driver: 'pdo_mysql'
        server_version: '5.7'
        charset: utf8mb4
        default_table_options:
            charset: utf8mb4
            collate: utf8mb4_unicode_ci

        # configure these for your PostgreSQL database server
        # driver: 'pdo_pgsql'
        # charset: utf8
```

Uncomment and update the password in this line of **.env** file :
DATABASE_URL=mysql://octoweb:**aSecurePassword**@127.0.0.1:3306/octoweb


Enter this commands in a terminal prompt :
```bash
# cd OctoBot-Website
bin/console doctrine:migrations:latest
```
If an error occured "could not find driver", enter this command in a terminal prompt (and re-enter the command above) :
```bash
sudo apt install php-mysql
```


#### Or with PostgreSQL

Enter this commands in a terminal prompt :
```bash
sudo -i -u postgres
createuser --interactive
octoweb
# -> yes
psql
ALTER USER octoweb WITH password 'aSecurePassword';
ALTER USER octoweb SET search_path = public;
\q
exit
```

Update config/packages/doctrine.yaml :
```yaml
doctrine:
    dbal:
        # configure these for your MySQL database server
        # driver: 'pdo_mysql'
        # server_version: '5.7'
        # charset: utf8mb4
        # default_table_options:
        #     charset: utf8mb4
        #     collate: utf8mb4_unicode_ci

        # configure these for your PostgreSQL database server
        driver: 'pdo_pgsql'
        charset: utf8
```

Uncomment and update the password in this line of **.env** file :
DATABASE_URL=pgsql://octoweb:**aSecurePassword**@127.0.0.1:5432/octoweb


Enter this commands in a terminal prompt :
```bash
# cd OctoBot-Website
php bin/console doctrine:database:create
```
If an error occured "could not find driver", enter this command in a terminal prompt (and re-enter the command above) :
```bash
sudo apt install php-pgsql
```


### 3) Fill database and start built-in server

Enter this commands in a terminal prompt :
```bash
# cd OctoBot-Website
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


## Demo

[http://drakkar-octobot.herokuapp.com/](http://drakkar-octobot.herokuapp.com/)
