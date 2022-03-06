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
**The run() method in the above code snippet will create 10 new users using the User factory.**

## Factories in Laravel
Factories are a way to put values in fields of a particular model automatically. Like, for testing when we add multiple fake records in the database, we can use factories to generate a class for each model and put data in fields accordingly.
Laravel comes with: 
> database/factories/UserFactory.php

We can crate new factory by:
`php artisan make:factory UserFactory --class=User`

Factory Example:
```
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
   /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = User::class;

   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
       return [
           'name' => $this->faker->name,
           'email' => $this->faker->unique()->safeEmail,
           'email_verified_at' => now(),
           'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
           'remember_token' => Str::random(10),
       ];
   }
}
```

## Models
With Laravel, each database table can have a model representation using a model file which can be used to interact with that table using Laravel Eloquent ORM.


# Advanced Questions
## Relationships
Relationships in Laravel are a way to define relations between different models in the applications.

## Eloquent
 Eloquent is the ORM used to interact with the database using Model classes. It gives handy methods on class objects to make a query on the database.  It can directly be used to retrieve data from any table and run any raw query. But in conjunction with Models, we can make use of its various methods and also make use of relationships and attributes defined on the model.

 ## Throttling
Throttling is a process to rate-limit requests from a particular IP. This can be used to prevent DDOS attacks as well.
```
 Route::middleware('auth:api', 'throttle:60,1')->group(function () {
    Route::get('/user', function () {
        //
    });
});
```

## Facades
Facades are a way to register your class and its methods in Laravel Container so they are available in your whole application after getting resolved by Reflection.
    The main benefit of using facades is we don’t have to remember long class names and also don’t need to require those classes in any other class for using them. It also gives more testability to the application.
Facade Pattern
![Facade Pattern](https://s3.ap-south-1.amazonaws.com/myinterviewtrainer-domestic/public_assets/assets/000/000/109/original/Facades.png?1615293174)
