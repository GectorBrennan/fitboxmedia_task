# Api for Fitboxmedia


### Installing

```
cd docker

cp env-example .env

docker-compose build nginx mysql phpmyadmin

docker-compose up -d nginx mysql phpmyadmin

docker-compose exec php-fpm bash

composer install

php artisan migrate

```
Go to  [http://localhost/docs/](http://localhost/docs/)


For docker I used [http://laradock.io/](http://laradock.io/)

For API documentation I used [http://apidocjs.com/](http://apidocjs.com/)

