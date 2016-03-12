# Users
User manager with roles (single and multiple)

## Install
```bash
composer require snatertj/users
```


## After install

#### ServiceProvider
Add the following line to "config/app.php"

at "providers":

```bash
Snatertj\Users\UsersServiceProvider::class,
Collective\Html\HtmlServiceProvider::class,
```

And at "aliases":

```bash
'Form'      => Collective\Html\FormFacade::class,
'Html'      => Collective\Html\HtmlFacade::class,
```

#### Creating the files
Run the following command:

```bash
php artisan vendor:publish
```

#### Migration

Run the command: 
```bash
php artisan migrate
```

#### Middleware

Add the following lines to the '$routeMiddleware' array in the file 'App/Http/Kernel.php'

```bash
'onlyAdmin' => \Snatertj\Users\Http\Middleware\IfAdmin::class,
```

If you go to the user index you first need a role that sign in the config file

#### Database Seed

If you want to at basic roles, do the following thinks.<br>

Add to your 'DatabaseSeeder.php' file in the 'database/seeds' folder
```bash
$this->call(RoleTableSeeder::class);
$this->call(RoleUserTableSeeder::class);
```
After that run the next command:
```bash
php artisan db:seed
```

####### Or
if you don't want to do that run the following commands:
```bash
first: php artisan db:seed --class=RoleTableSeeder
second: php artisan db:seed --class=RoleUserTableSeeder
```
