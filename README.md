# Developer Task

## Installation 

- Clone the project from github:

```
git clone git@github.com:Aymen-aen/article-manager.git
```

- Install composer dependencies

```
composer install
```

- Edit `.env` file and change the Database cconfiguration string `DATABASE_URL`

- Create the Database `my_project`:

```
php bin/console doctrine:database:create
```

- Create the Database schema:

```
php bin/console doctrine:schema:create
```

- Clear the cache:

```
php bin/console cache:clear
```

- Running Symfony Applications

```
php -S 127.0.0.1:800 -t public
```

## Usage

This web application allows for managing articles.
The homepage shows a list of 5 articles by default and displays a pagination option in order to navigate throw them.

## Unit Test

```
php bin/phpunit
```

