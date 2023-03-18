# CashRegister

Cash Register

## Project structure

```
CashRegister
 ├── migrations
 ├── public
 │   ├── fonts
 │   ├── scripts
 │   ├── styles
 │   └── index.php
 ├── src
 │   ├── controllers
 │   ├── core
 │   │   ├── database
 │   │   └── exceptions
 │   ├── models
 │   └── views
 │       └── exceptions
 ├── tests
 ├── vendor
 ├── .env
 ├── composer.json
 ├── composer.lock
 ├── LICENCE
 └── README.md
```

## Database connection & migrations

Change connection token in .env file
Rename .env.example to .env and apply personal configuration
```
DB_DSN="mysql:host=hostname;port3306;dbname=db"
DB_USER="root"
DB_PASSWORD="toor"
```

Apply migrations by running `migrations.php` with local `php` command
```sh
php migrations.php
```
