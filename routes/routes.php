<?php

use App\Controllers\PlantController;
use Core\Router\Route;

return [
  Route::get('/', [PlantController::class, 'index']),
  Route::get('/plants/create', [PlantController::class, 'create']),
  Route::post('/plants', [PlantController::class, 'store']),

];
