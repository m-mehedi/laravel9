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
### Facade Pattern
![Facade Pattern](https://s3.ap-south-1.amazonaws.com/myinterviewtrainer-domestic/public_assets/assets/000/000/109/original/Facades.png?1615293174)

## Events
Events are a way to subscribe to different events that occur in the application. 
    We can make events to represent a particular event like user logged in, user logged out, user-created post, etc. After which we can listen to these events by making Listener classes and do some tasks like, user logged in then make an entry to audit logger of application.

` php artisan make:event UserLoggedIn `
This will generate:
```
<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
```

For this event to work, we need to create a listener as well. We can create a listener like this:
`php artisan make:listener SetLogInFile --event=UserLoggedIn`

## Logging
Laravel Logging is a way to log information that is happening inside an application. 
    Laravel provides different channels for logging like file and slack. Log messages can be written on to multiple channels at once as well.
    We can configure the channel to be used for logging in to our environment file or in the config file at config/logging.php

## Localization
**Localization** is a way to serve content concerning the client's language preference. 
    We can create different localization files and use a laravel helper method like this: `__(‘auth.error’)` to retrieve translation in the current locale. These localization files are located in the resources/lang/[language] folder.

## Requests
Requests in Laravel are a way to interact with **incoming HTTP** requests along with *sessions, cookies, and even files* if submitted with the request.
The class responsible for doing this is `Illuminate\Http\Request`.
When any request is submitted to a laravel route, it goes through to the controller method, and with the help of dependency Injection, the request object is available within the method. We can do all kinds of things with the request like validating or authorizing the request, etc.

## Request validation
Request validation in laravel can be done with the controller method or we can create a request validation class that holds the rules of validation and the error messages associated with it.
``` 
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

    // The blog post is valid...
}
```
## Service Container
Service Container or IoC in laravel is responsible for managing class dependencies meaning not every file needs to be injected in class manually but is done by the Service Container automatically. Service Container is mainly used in injecting class in controllers like Request object is injected. We can also inject a Model based on id in route binding.
For example, a route like below:
```
Route::get('/profile/{id}', 'UserController@profile');
With the controller like below.
```
```
public function profile(Request $request, User $id)
{
    // 
}
```
In the **UserController** profile method, the reason we can get the User model as a parameter is because of *Service Container as the IoC resolves all the dependencies* in all the controllers while booting the server. This process is also called route-model binding

## Service Provider
A Service Provider is a way to bootstrap or register services, events, etc before booting the application. 
    Laravel’s own bootstrapping happens using Service Providers as well. Additionally, registers service container bindings, event listeners, middlewares, and even routes using its service providers. If we are creating our application, we can register our facades in provider classes

## Register and boot method in the Service Provider class
The register method in the Service Provider class is used to bind classes or services to the Service Container. 
    It should not be used to access any other functionality or classes from the application as the service you are accessing may not have loaded yet into the container.
    The boot method runs after all the dependencies have been included in the container and now we can access any functionality in the boot method. Like you can create routes, create a view composer, etc in the boot method.

## Define routes 
Laravel Routes are defined in the routes file in routes/web.php for web application routes. 
    Routes can be defined using Illuminate\Support\Facades\Route and calling its static methods such as to get, post, put, delete, etc.
```
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return 'Welcome to Home Sweet Home';
});
```
A typical closure route looks like the above, where we provide the URI and the closure function to execute when that route is accessed.
`Route::get('/hello', 'HomeController@index');`
Another way is like above, we can directly give the controller name and the method to call, this can again be resolved using Service Container

## Named routes
A named route is a route definition with the name assigned to it. We can then use that name to call the route anywhere else in the application.
`Route::get('/hello', 'HomeController@index')->name('index');`
This can be accessed in a controller using the following:
`return redirect()->route('index');`

## Route groups
Route Groups in laravel is used when we need to group route attributes like middlewares, prefixes, etc. we use route groups. It saves us a headache to put each attribute to each route. <br>
Syntax:
```
Route::middleware(['throttleMiddleware'])->group(function () {
    Route::get('/', function () {
        // Uses throttleMiddleware
    });

    Route::get('/user/profile', function () {
        // Uses throttleMiddleware
    });
});
```

## Middleware
Middleware gives developers the ability to inspect and filter incoming HTTP requests of our application. One such middleware that ships with laravel are the authentication middleware which checks if the user is authenticated and if the user is authenticated it will go further in the application otherwise it will throw the user back to the login screen.

We can always create a new middleware for our purposes. For creating a new middleware we can use the below artisan command:

`php artisan make:middleware CheckFileIsNotTooLarge`

The above command will create a new middleware file in the app/Http/Middleware folder.

## Route for resources
For creating a resource route we can use the below command:
`Route::resource('blogs', BlogController::class);`
This will create routes for six actions index, create, store, show, edit, update and delete.

## Dependency Injection
The Laravel Service Container or IoC resolves all of the dependencies in all controllers. So we can type-hint any dependency in controller methods or constructors. The dependency in methods will be resolved and injected in the method, this injection of resolved classes is called dependency Injection

## Collections
Collections in laravel are a wrapper over an array of data in Laravel. 
    All of the responses from Eloquent ORM when we query data from the database are collections (Array of data records). Collections give us handy methods over them to easily work with the data like looping over data or doing some operation on it.

## Contracts
Laravel Contracts are a set of interfaces with implementation methods to complete the core tasks of Laravel.
![Contracts](https://s3.ap-south-1.amazonaws.com/myinterviewtrainer-domestic/public_assets/assets/000/000/110/original/Contracts.png?1615295245)
Few examples of contracts in Laravel are Queue and Mailer. Queue contract has an implementation of Queuing jobs while Mailer contract has an implementation to send emails.

## Queues
While building any application we face a situation where some tasks take time to process and our page gets loading until that task is finished. One task is sending an email when a user registers, we can send the email to the user as a background task, so our main thread is responsive all the time. Queues are a way to run such tasks in the background.

## accessors and mutators
Accessors are a way to retrieve data from eloquent after doing some operation on the retrieved fields from the database. 
    For example, if we need to combine the first and last names of users but we have two fields in the database, but we want whenever we fetch data from eloquent queries these names need to be combined.

    We can do that by creating an accessor like below:
    ```
    public function getFullNameAttribute()	 	 
    {	 	 
        return $this->first_name . " " . $this->last_name;	 	 
    }
    ```
    What the above code will do is it will give another attribute(full_name) in the collection of the model, so if we need the combined name we can call it like this: `$user->full_name`. Mutators are a way to do some operations on a particular field before saving it to the database.

    For example, if we wanted the first name to be capitalized before saving it to the database, we can create something like the below:
    ```
    public function setFirstNameAttribute($value)
    {
        $this->attributes[‘first_name’] = strtoupper($value);
    }
    ```
    So, whenever we are setting this field to be anything:

    `$user->first_name = Input::get('first_name');`
    `$user->save();`
    It will change the first_name to be capitalized and it will save to the database