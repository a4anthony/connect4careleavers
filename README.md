# Connect4Careleavers


Major technologies used:

1. [Laravel](https://laravel.com/docs) as a backend php framework.
1. [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze) for user authentication.
2. [Vuejs](https://vuejs.org/) as a frontend javascript framework.
3. [TailwindCss](https://tailwindcss.com/docs) as a css framework.
4. [NodeJs](https://nodejs.org/en/) and [npm](https://www.npmjs.com/) to handle javascript libraries.
5. [Pusher](https://pusher.com/) for events tracking and listening.
5. [MySQL](https://www.mysql.com/) as a backend database.

All application dependencies can be found in the composer.json and package.json files.

## Project Setup

1. Install composer dependencies

```angular2html
composer install
```

or

```angular2html
composer update
```

2.Make a .env file and copy contents of .env.example to it and make necessary changes.

3. Set up your database connection within the .env file

```angular2html
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

4. Run

```angular2html
php artisan migrate
```

5. To seed database with dummy data, run

```angular2html
php artisan db:seed
```

6. Now link the storage folder to the public folder by running

```angular2html
php artisan storage:link 
```

7. Install abd build javascript dependencies by running

```angular2html
npm install && npm  run dev
```
8. Run the dev the server
```angular2html
php artisan serve
```


You're ready to go! Visit Ping CRM in your browser, and login with:

- **Username:** johndoe@example.com
- **Password:** password

or as admin user with:

- **Username:** admin@example.com
- **Password:** password


