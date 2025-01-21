<?php

use App\Controllers\LoginController;
use App\Controllers\PlantController;
use App\Controllers\RegisterController;
use Core\Router\Route;

return [
  Route::get('/', [PlantController::class, 'index']),
  Route::get('/plants/create', [PlantController::class, 'create']),
  Route::post('/plants', [PlantController::class, 'store']),

  Route::get('/register', [RegisterController::class, 'create']),
  Route::post('/register', [RegisterController::class, 'store']),

  Route::get('/login', [LoginController::class, 'create']),
  Route::post('/login', [LoginController::class, 'store']),

];
