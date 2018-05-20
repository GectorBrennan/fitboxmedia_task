# Api for Fitboxmedia


### Installing

```
composer install

cd docker

cp env-example .env

docker-compose build nginx mysql phpmyadmin

docker-compose up -d nginx mysql phpmyadmin

docker-compose exec php-fpm bash


php artisan migrate

```

Add to you hosts file  [127.0.0.1 api.local]()

Go to  [http://api.local/docs/](http://localhost/docs/)

For docker I used [http://laradock.io/](http://laradock.io/)

For API documentation I used [http://apidocjs.com/](http://apidocjs.com/)

## Databases props(for [phpmyadmin](http://localhost:8080) http://localhost:8080)

* [name]() - task
* [password]() - root
* [user]() - root
* [host]() - mysql
