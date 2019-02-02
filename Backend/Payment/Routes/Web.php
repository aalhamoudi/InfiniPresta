<?php

// Application Routes
$router->get('/', function () use ($router) {
    return $router->app->version();
});
