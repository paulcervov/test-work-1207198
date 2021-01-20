# TestWork 1207198

An example of a classic CRUD application, building with Laravel and Bootstrap.

## Run with Docker

1. Run
    ```
       docker run --rm \
       -v $(pwd):/opt \
       -w /opt \
       laravelsail/php80-composer:latest \
       composer install
    ```

1. Run `cp .env.example .env`
1. Run

    ```
       docker run --rm \
       -v $(pwd):/opt \
       -w /opt \
       laravelsail/php80-composer:latest \
       php artisan key:generate
    ```

1. Run `./vendor/bin/sail up -d`
1. Run `./vendor/bin/sail artisan migrate:fresh --seed`
1. Go to http://localhost
1. Login using the following credentials:
    * `admin@example.com / password`
    * `editor@example.com / password`
    * `author@example.com / password`
1. Explore the CRUD interfaces, then look at the source code 🧑‍💻
