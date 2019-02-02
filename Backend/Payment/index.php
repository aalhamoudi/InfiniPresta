<?php
require_once __DIR__.'/Vendor/autoload.php';

// Load Env
try { (new Dotenv\Dotenv(dirname(__DIR__)))->load(); }
catch (Dotenv\Exception\InvalidPathException $e) {}

// Create App
$app = new Laravel\Lumen\Application(dirname(__DIR__));
$app->withFacades();
$app->withEloquent();

// Register Container Bindings
$app->singleton(Illuminate\Contracts\Debug\ExceptionHandler::class, App\Exceptions\Handler::class);
$app->singleton(Illuminate\Contracts\Console\Kernel::class, App\Console\Kernel::class);

// Register Middleware
$app->middleware([App\Http\Middleware\ExampleMiddleware::class]);
$app->routeMiddleware(['auth' => App\Http\Middleware\Authenticate::class]);

// Register Service Providers
$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);

$app->register(Bkwld\LaravelPug\ServiceProvider::class);

// Load The Application Routes
$app->router->group(['namespace' => 'App\Http\Controllers'], function($router) {
    require __DIR__.'/Routes/Web.php';
});

//return $app;
$app->run();
