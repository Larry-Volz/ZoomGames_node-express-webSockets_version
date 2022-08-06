# About Inheriting Zoom Api

# Using things

`ThinkPHP 5.0` backend framework.

`composer` PHP dependency manager.

MySQL and JavaScript.

# Setup enviroment

## Backend Framework
Backend Framework `ThinkPHP 5.0` install by `composer`.

Go to the directory of `composer.json`, in this case is `\zoomphp\`, run command

```shell
composer install
```

it should run well, but in my terminal, some errors occur, So I decided to version control the content of the composer installation. to avoid errors occurring.

## Create `/zoomphp/.env` file

The `.env` file stores some of the environment configuration.

`[DATABASE]` and `[ZOOMDIS]` sessions must be up to date.

**<font color=#D34747>This file should not be version controlled, upload database username/password and zoom key/secret to GitHub will reduce project security.</font>**

**Content:**

```
APP_DEBUG = true

[APP]
DEFAULT_TIMEZONE = America/New_York

[LANG]
default_lang = en-us

[DATABASE]
TYPE = mysql
HOSTPORT = 3306
CHARSET = utf8mb4
DEBUG = true
HOSTNAME = localhost
USERNAME = root
PASSWORD = 123123
DATABASE = thezoomgames

[ZOOMDIS]
KEY=
SECRET=
```

## Database

Import `/zoomphp/db.sql` to MySQL database.

**<font color=#D34747>There is a statement to create a database in file line 23. may change the database name in the file before import.</font>**

**<font color=#D34747>This file should not be version controlled, upload to GitHub will reduce project security.</font>**
