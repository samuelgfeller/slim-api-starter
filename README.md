<div align="center">

<h1>Slim <img src="https://i.imgur.com/YzDYQ0V.png" width="60px" alt="API"> starter</h1>

[![Latest Version on Packagist](https://img.shields.io/github/release/samuelgfeller/slim-api-starter.svg)](https://packagist.org/packages/samuelgfeller/slim-api-starter)
[![Code Coverage](https://scrutinizer-ci.com/g/samuelgfeller/slim-api-starter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/samuelgfeller/slim-api-starter/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/samuelgfeller/slim-api-starter/badges/build.png?b=master)](https://scrutinizer-ci.com/g/samuelgfeller/slim-api-starter/build-status/master)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/samuelgfeller/slim-api-starter.svg)](https://scrutinizer-ci.com/g/samuelgfeller/slim-api-starter/?branch=master)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/samuelgfeller/slim-example-project/blob/master/LICENSE)


[Slim 4](https://www.slimframework.com/) API starter template with a few examples and some essential [features](#features) to 
help you build a secure and scalable API following 2024 best practices and 
[SOLID](https://en.wikipedia.org/wiki/SOLID) principles.  

An extensive [**documentation**](https://samuel-gfeller.ch/docs) explains 
the [architecture](https://samuel-gfeller.ch/docs/Architecture), components, 
design choices (i.e. [SRP](https://samuel-gfeller.ch/docs/Single-Responsibility-Principle-(SRP))) 
and features.  

</div>

## Features

* [Dependency Injection](https://samuel-gfeller.ch/docs/Dependency-Injection) - [PHP-DI](https://php-di.org/)
* [Database migrations](https://samuel-gfeller.ch/docs/Database-Migrations) - [Phinx](https://phinx.org/)
* [Validation](https://samuel-gfeller.ch/docs/Validation) - [cakephp/validation](https://book.cakephp.org/4/en/core-libraries/validation.html)
* [Logging](https://samuel-gfeller.ch/docs/Logging) - [Monolog](https://github.com/Seldaek/monolog)
* [Query Builder](https://samuel-gfeller.ch/docs/Repository-and-Query-Builder) - [cakephp/database](https://book.cakephp.org/5/en/orm/query-builder.html)
* [Integration testing](https://samuel-gfeller.ch/docs/Writing-Tests) - [PHPUnit](https://github.com/sebastianbergmann/phpunit/)
* [Error handling](https://samuel-gfeller.ch/docs/Error-Handling)
* [GitHub Actions](https://samuel-gfeller.ch/docs/GitHub-Actions) - [Scrutinizer](https://scrutinizer-ci.com/)
* [Coding standards fixer](https://samuel-gfeller.ch/docs/Coding-Standards-Fixer) - [PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)
* [Static code analysis](https://samuel-gfeller.ch/docs/PHPStan-Static-Code-Analysis) - [PHPStan](https://github.com/phpstan/phpstan)


## Requirements
* PHP 8.2+
* [Composer](https://samuel-gfeller.ch/docs/Composer)
* MariaDB or MySQL database

## Installation
#### 1. Create project
Navigate to the directory you want to create the project in and run the following 
command, replacing project-name with the desired name for your project.
```bash
composer create-project samuelgfeller/slim-api-starter project-name
```
This will create a new directory with the specified name and install all 
necessary dependencies.
 
#### 2. Set up the database
Open the project and rename the file `config/env/env.example.php` to `config/env/env.php` 
and add the local database credentials.  

Then, create the database for the project and update the `config/env/env.dev.php` 
file with the name of the database, like this:
```php
$settings['db']['database'] = 'my_dev_database_name';
```
After that, create a separate database for testing and update the `config/env/env.test.php` 
file with its name. The name must contain the word "test". There is a safety measure to 
prevent accidentally truncating the development database while testing:
```php
$settings['db']['database'] = 'my_dev_database_name_test';
```

#### 3. Run migrations
Open the terminal in the project's root directory and run the following command to create the 
demo table `user`:
```bash
composer migrate
```

#### 4. Insert demo data
Four demo users can be inserted into the database to test the API response by
running the following command:

```bash
composer seed
```

#### 5. Update GitHub workflows

To run the project's tests automatically when pushing, update the 
`.github/workflows/build.yml` file.   
Replace the matrix value "test-database" with the name of 
your test database as specified in `config/env/env.test.php`.

If you don't plan on using Scrutinizer, remove the `.scrutinizer` file at the root of the project,
otherwise you can follow this
[guide](https://samuel-gfeller.ch/docs/How-to-set-up-Scrutinizer)
on how to set it up.

#### Done!
That's it! Your project should now be fully set up and ready to use.  
If you are using XAMPP and installed the project in the `htdocs` folder, you can access it 
in the browser at `http://localhost/project-name`.  
Or you can serve it locally by running `php -S localhost:8080 -t public/` in the project's root 
directory.

## Support
If you value this project and want to support it,
visit the [Support❤️](https://samuel-gfeller.ch/docs/Support❤️) page. (thank you!)

## License
This project is licensed under the MIT License — see the 
[LICENSE](https://github.com/samuelgfeller/slim-example-project/blob/master/LICENSE) file for details.
