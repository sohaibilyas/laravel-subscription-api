## Instructions

```console
git clone https://github.com/sohaibilyas/laravel-subscription-api

composer install

cp .env.example .env

php artisan key:generate

Configure mysql database in .env
Set MAIL_MAILER=log in .env

php artisan migrate:fresh --seed

php artisan serve
````

### Websites with pagination support
```console
http://127.0.0.1:8000/api/websites?page=1&per_page=5
```

### Website using its id
```console
http://127.0.0.1:8000/api/websites/1
```

### Subscribe to a website
```console
POST http://127.0.0.1:8000/api/websites/1/subscribers

Parameters: email
```

### Publish new article
```console
POST http://127.0.0.1:8000/api/websites/1/articles

Parameters: title, content

After the request check laravel.log for emails sent via queue
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
