<?php

use App\Controller\HomeController;
use App\Controller\MemeController;

$routes = [
    '/' => [HomeController::class, 'home'],
    '/memes' => [MemeController::class, 'memes'],
    '/meme/view' => [MemeController::class, 'show'],
];

return $routes;

