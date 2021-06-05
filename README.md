## About Testgram
<p> Testgram is an 
<a href="https://opensource.com/resources/what-open-source"> Open Source </a> 
website like 
<a href="instagram.com"> Instagram </a>.
</p>
<p> Testgram is just a simple and little exercise that you can use it for training. </p>

## Using Testgram

### Updating composer
```
composer update
```

### Create database

```
CREATE DATABASE MyDB
```

### Create .env file

```
cp .env.example .env
vim .env
```

update:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=MyDB
DB_USERNAME=username
DB_PASSWORD=secret
```

### Migrations
```
./artisan migrate
```

### Generating app key
```
./artisan key:generate
```

### Create storage link
```
./artisan storage:link
```

### Serve application
```
./artisan serve
```

## Contributing

Thank you for considering contributing to the Testgram app!

## License
[here](LICENSE)
