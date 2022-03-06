# Laravel Basics
## Composer
Composer is the package manager for the framework.
## Templating engine
The templating engine used in Laravel is **Blade**.
## supported Database: 
> PostgreSQL, SQL Server, SQLite, MySQL.
## Artisan
Artisan is the command-line tool for Laravel to help the developer build the application.
## Popular Artisan Commands
> - `php artisan make:controller`
> - `php artisan make:mode`
> - `php artisan make:migration`
> - `php artisan make:seeder`
> - `php artisan make:factory`
> - `php artisan make:policy`
> - `php artisan make:command`

## Maintanance mode
- [ ] php artisan down
- [x] php artisan up

## Routes: 
1. **web.php** - *For registering web routes.*
2. **api.php** - *For registering API routes.*
3. **console.php** - *For registering closure-based console commands.*
4. **channel.php** - *For registering all your event broadcasting channels that your application supports.*

## Migrations
Migrations are used to create database schemas in Laravel.[^1].

Run migrations to generate tables by commands.[^2].  

You can also use words, to fit your writing style more closely[^note].

[^1]: Here  we store which table to create, update or delete.
[^2]: > `PHP artisan migrate`
  This migrates all the tables for database.
[^note]:
    The up() method runs when we run `php artisan migrate` and down() method runs when we run `php artisan migrate:rollback`.
    If we rollback, it only rolls back the previously run migration.
    If we want to rollback all migrations, we can run 'php artisan migrate:reset`.
    If we want to rollback and run migrations, we can run `PHP artisan migrate:refresh`, and we can use `PHP artisan migrate:fresh` to drop the tables first and then run migrations from the start.

## Seeder
Seeders in Laravel are used to put data in the database tables automatically.
After running migrations to create the tables, We can create a new Seeder using the below artisan command:
 > php artisan make:seeder [className]

Generated File
```
<?php

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(User::class, 10)->create();
    }
}
```
** The run() method in the above code snippet will create 10 new users using the User factory. **
