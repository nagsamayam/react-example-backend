# Laravel ReactJS Starter (Backend)

#### Prerequisite

    *  Webserver apache/nginx (optional)
    *  PHP >= 8.0,
    *  Mysql >= 8.0,
    *  Composer >= 1.5.2
    *  git >= 2.7.4

### PHP extensions
    *  BCMath
    *  Ctype
    *  fileinfo
    *  JSON
    *  Mbstring
    *  OpenSSL
    *  PDO
    *  Tokenizer
    *  XML
    *  zip
    *  gd
    *  iconv

### Installation

-   Clone the repo `git clone https://github.com/nagsamayam/react-example-backend.git <projectname>`
-   `cd <projectname>`
-   `composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs`
-   `cp .env.example .env`
-   Create a database and configure settings in .env
-   `chmod 777 -R storage/ && chmod 777 -R bootstrap/cache/`
-   `php artisan key:generate` to generate key
-   `php artisan migrate` to create DB tables
-   `php artisan db:seed` to seed data into DB
-   `php artisan storage:link` to create symlink
-   `php artisan serve` to run the application

> Note: Currently, for this example, we recommend using `localhost` during local development to avoid "Same-Origin" issues.

Corresponding frontend: https://github.com/nagsamayam/react-example-frontend

### Default logins

-   [Super Admin login](http://localhost:8000/api/login)
-   Super admin user login: `superadmin@gmail.com` 
-   Root user password: `password`

> Note: For new user registration and to update password, strong password is required
> Note: You can find postman collection in the source code and the file name is `postman_collection.json`

### Deploy code (Once the project set up)

-   run `sudo php artisan blog:deploy`
-   Provide information for the options

# Code Overview

## Dependencies

- [Laravel](https://laravel.com/) - PHP framework
- [Laravale Sanctum](https://github.com/laravel/sanctum) - Authentication system for SPAs
- [Laravel Data](https://github.com/spatie/laravel-data) - Data objects for Laravel
- [User Permissions](https://github.com/spatie/laravel-permission) - Manages user roles and permissions
