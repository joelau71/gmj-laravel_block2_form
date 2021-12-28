# gmj-laravel_block2_form

Laravel Block for backend and frontend - need tailwindcss support

**composer require gmj/laravel_block2_form**

in terminal run:<br/>
php artisan vendor:publish --provider="GMJ\LaravelBlock2Form\LaravelBlock2FormServiceProvider" --force

php artisan migrate

php artisan db:seed --class=LaravelBlock2FormSeeder

package for test<br/>
composer.json#autoload-dev#psr-4: "GMJ\\LaravelBlock2Form\\": "package/laravel_block2_form/src/",<br/>
config: GMJ\LaravelBlock2Form\LaravelBlock2FormServiceProvider::class,
