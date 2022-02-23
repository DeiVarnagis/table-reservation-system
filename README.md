# Table reservation system.

# Requirements
● Laravel <br/>
● Restoranų kūrimas (pavadinimas, staliukų skaičius, max žmonių skaičius) <br/>
● Rez ervacijos puslapis, viena bendra forma viename puslapyje. <br/>
● Reikalingas: <br/>
● Restorano pasirinkimas <br/>
● Rezervuotojo vardas, pavardė, emailas, telefonas <br/>
● Žmonių sąrašas (vardas, pavardė, emailas) <br/>
● Rezervacijos datos pasirinkimas <br/>
● Rezervacijos laikas 1,2,3h... <br/>
● Validacija ar dar yra laisvų staliukų ir max žmonių ar neviršija. <br/>
● Tikrinant ar yra laisvų vietų lankytojams, pagalvoti apie realu scenarijų kuomet atėjus 10 lankytojų kompanijai, negalima jų pasodinti prie vieno staliuko. <br/>

Rezervacijų peržiūra <br/>
● Admin prisijungimas nėra būtinas, orientuojantuotis į patogią rezervacijos formą. Front end dalies daryti nereikia. <br/>
● Koda įkelkite į savo pasirinktą versijavimo sistemą (gitlab, github, bitbucket…) peržiūrai.” <br/>

Installation
------------

First, you will need to install [Composer](http://getcomposer.org/) following the instructions on their site.

Then, simply run the following command to download the project:

```sh
git clone https://github.com/DeiVarnagis/table-reservation-system-ekomlita.git
```

Alternatively, you may download the [(https://github.com/DeiVarnagis/table-reservation-system-ekomlita/archive/refs/heads/main.zip)](https://github.com/DeiVarnagis/table-reservation-system-ekomlita/archive/refs/heads/main.zip) and run `composer install` from your project's root directory.

Configuration
-------------
Modify the .env file to suit your needs

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
When you have the .env with your database connection set up you can run your migrations

```bash
php artisan migrate
```
Now just run one more command to seed your database

```bash
php artisan db:seed
```

Now your app is ready!! Just run last command to start your localhost server!

```bash
php artisan serve
```

