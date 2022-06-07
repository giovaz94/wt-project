

 <h1> Web Tech. Project : Campus Book  </h1>
 <br>

This is the repository of "Campus Book", an online book store implemented as part of 
Web Technology class's exam.

We've used the [Yii 2](http://www.yiiframework.com/) framework as backend technology and HTML/CSS/JS for the 
fronted.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

- The minimum requirement by this project template that your Web server supports PHP 5.6.0.
- [Composer](http://getcomposer.org/) is required for running the application, you may install it by following the instructions
  at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix)

INSTALLATION
------------
1) Clone the repository using the following command:

~~~
git clone https://github.com/giovaz94/wt-project.git
~~~

2) Download the required assets with composer, launching the following command in the application folder:

~~~
composer install
~~~

3) Create a new file in the `config` folder called `db.php` and apply the following configuration:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=<dbhost>;dbname=<dbname>',
    'username' => '<mydbuser>',
    'password' => '<mydbpassword>',
    'charset' => 'utf8',
];
```

 - \<dbhost\>: is the host of your database.
 - \<dbname\>: is the name of your database.
 - \<mydbuser\>: username of one user of the database.
 - \<mydbpassword\> : the user's password.

4) Create the database launching the following commands in the project folder:


```php
php yii migrate --migrationPath=@yii/rbac/migrations
php yii migrate
```

For PDOExcpetion issues on Windows, check the php.ini file in the program folder. Uncomment then the following lines:

````config
extension=pdo_mysql
...
...
pdo_mysql.default_socket=
````
And add a default value in the last line shown above:
````config
pdo_mysql.default_socket=8000
````

5) Populate the database:

Run MySQL Server

Create new database, dbname=<dbname> used before

Unzip the dump inside dump folder in the project's root

Load the MySQL's files and run them

Copy the uploads folder on the Web folder in the project's root

RUNNING THE APPLICATION
------------

In the application folder launch the following command: 

```php
php yii serve
```

This will create a local web server for running the application.
This should be the output:

```shell
Server started on http://localhost:8080/
Document root is "/Users/giovanniantonioni/Desktop/Università/Tecnologie Web/progetto-tw/web"
Quit the server with CTRL-C or COMMAND-C.
[Wed May 25 18:06:07 2022] PHP 8.1.3 Development Server (http://localhost:8080) started
```

The site should be reachable from the following url : http://localhost:8080/

INSIDE THE APPLICATION
------------

If successfully configurated the database by unzipping the dump.zip folder and loading its files,
the system already has some users and products, to login as users here are the credentials:

User1: utente_compratore_1
Password1:  password_utente_compratore_1
E-mail1:  utente_compratore_1@gmail.com

User2: utente_compratore_2
Password2:  password_utente_compratore_2
E-mail2:  utente_compratore_2@gmail.com 
 
User: utente_venditore_1   Password:  password_utente_venditore_1   E-mail:  utente_venditore_1@gmail.com

User: utente_venditore_2   Password:  password_utente_venditore_2   E-mail:  utente_venditore_2@gmail.com
