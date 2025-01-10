<?php

use App\Controllers\PlantController;
use Core\Router\Route;

return [
  Route::get('/', [PlantController::class, 'index']),
  Route::get('/plants', function () {
    echo '<h1>Plants page</h1>';
  }),
];
