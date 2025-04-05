<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Sistem Informasi Klinik</h1>
    <br>
</p>



DIRECTORY STRUCTURE
-------------------

      api/                contains the entry script and API resources
      assets/             contains assets definition
      config/             contains application configurations
      console/            contains console commands (controllers)
      controllers/        contains Web controller classes
      environments/       contains environment-based overrides
      helpers/            contains useful helper classes
      mail/               contains view files for e-mails
      migrations/         contains all migration files
      models/             contains model classes
      modules/            contains modules
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      themes/             contains application view layout template
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project that your Web server supports PHP 7.4.0.


INSTALLATION
------------

Install neccesary package :
~~~
composer install
~~~


Run migration for RBAC :
~~~
php yii migrate --migrationPath=@yii/rbac/migrations
~~~

Run migration for Admin :
~~~
php yii migrate --migrationPath=@mdm/admin/migrations
~~~

Run migration for the rest of application :
~~~
php yii migrate
~~~

You can then access the application through the following URL :
~~~
http://localhost/nama_folder/web/
~~~

Run command to create admin :
~~~
php yii config/tambah-admin {username} {password}
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/components.php` with real data, for example:

```php
return [
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
