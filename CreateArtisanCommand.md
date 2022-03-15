# php artisan make:command SendLink
# php artisan make:notification SendDocLinkNotification
# php artisan users:send_doc_link
# php artisan make:event UserCreated
# php artisan make:listener UserCreatedListener -e UserCreated

Install Laravel Breeze
    `composer require laravel/breeze --dev`
    `php artisan breeze:install`
    `npm install`
    `npm run dev`
    `php artisan migrate`

Create Events with Observers
    `php artisan make:observer UserObserver --model=User`