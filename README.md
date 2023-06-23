# .env

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=password

## Prerequisites
- In the project root, execute the command - sudo chmod -R 777 storage

- Docker should be installed.

## Getting Started

1. Build the Docker containers:
docker-compose build


2. Start the containers in the background:
docker-compose up -d


3. Access the application container:
docker exec -it app bash

4. php artisan key:generate

5. Install the dependencies:
composer install

6. Run database migrations:
php artisan migrate



7. Seed the database with dummy data:
php artisan db:seed


## Running Tests

8. To run the tests, use the following commands:
php artisan migrate --env=testing
php artisan db:seed --env=testing
php artisan test --env=testing




