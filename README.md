<div align="center">

<h1>Slim <img src="https://i.imgur.com/YzDYQ0V.png" width="60px" alt="API"> starter</h1>

[![Latest Version on Packagist](https://img.shields.io/github/release/samuelgfeller/slim-api-starter.svg)](https://packagist.org/packages/slim-api-starter)

[Slim 4](https://www.slimframework.com/) API starter template with a few examples and some essential [features](#features) to 
build a secure and scalable API following 2024 best practices and 
[SOLID](https://en.wikipedia.org/wiki/SOLID) principles.  

An extensive [documentation](https://github.com/samuelgfeller/slim-example-project/wiki) explains 
the project structure, components, design choices and features.   

</div>

## Features

* [Dependency Injection](https://github.com/samuelgfeller/slim-example-project/wiki/Dependency-Injection)
* [Database migrations](https://github.com/samuelgfeller/slim-example-project/wiki/Database-Migrations)
* [Validation](https://github.com/samuelgfeller/slim-example-project/wiki/Validation)
* [Error handling](https://github.com/samuelgfeller/slim-example-project/wiki/Error-Handling)
* [Logging](https://github.com/samuelgfeller/slim-example-project/wiki/Logging)
* [Integration testing](https://github.com/samuelgfeller/slim-example-project/wiki/Writing-Tests)
* [Query Builder](https://github.com/samuelgfeller/slim-example-project/wiki/Repository-and-Query-Builder)
* [GitHub Actions](https://github.com/samuelgfeller/slim-example-project/wiki/GitHub-Actions)
* [Coding standards fixer](https://github.com/samuelgfeller/slim-example-project/wiki/Coding-Standards-Fixer)
* [PHPStan static code analysis](https://github.com/samuelgfeller/slim-example-project/wiki/PHPStan-Static-Code-Analysis)


## Requirements
* PHP 8.2+
* [Composer](https://github.com/samuelgfeller/slim-example-project/wiki/Composer)
* MariaDB or MySQL database

## Installation
#### 1. Create project
Navigate to the directory you want to create the project in and run the following 
command, replacing [project-name] with the desired name for your project.
```bash
composer create-project samuelgfeller/slim-api-starter [project-name]
```
This will create a new directory with the specified name and install all 
necessary dependencies.

#### 2. Set up the database
Open the project and rename the file `config/env/env.example.php` to `env.php` 
and add the local database credentials.  

Then, create the database on the server and update the `config/env/env.dev.php` 
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

### 4. Insert demo data
You can install four demo users into the database to test the API response by
running the following command:

```bash
composer seed
```

#### 5. Update GitHub workflows

To run the project's tests automatically when pushing, update the 
`.github/workflows/develop.yml` file.   
Replace the matrix value "test-database" `slim_api_starter_test` with the name of 
your test database as you specified in `config/env/env.test.php`.
If you are not using Scrutinizer, remove the "Scrutinizer Scan" step from the workflow.  

### Done!
That's it! Your project should now be fully set up and ready to use.  
If you are using XAMPP and installed the project in the `htdocs` folder, you can access it via
http://localhost/project-name.  
Or you can serve it locally by running `php -S localhost:8080 -t public/` in the project's root 
directory.

## Support
If you value this project and want to support it,
visit the [Support❤️](https://github.com/samuelgfeller/slim-example-project/wiki/Support❤️) page. (thank you!)

## License
This project is licensed under the MIT Licence — see the 
[LICENCE](https://github.com/samuelgfeller/slim-example-project/blob/master/LICENCE.txt) file for details.
