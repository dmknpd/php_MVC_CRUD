<?php

use App\Controllers\LoginController;
use App\Controllers\PlantController;
use App\Controllers\RegisterController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Core\Router\Route;

return [
  Route::get('/', [PlantController::class, 'index']),
  Route::get('/plants/create', [PlantController::class, 'create'], [AuthMiddleware::class]),
  Route::get('/plants/{id}', [PlantController::class, 'show']),
  Route::post('/plants', [PlantController::class, 'store']),

  Route::get('/register', [RegisterController::class, 'create'], [GuestMiddleware::class]),
  Route::post('/register', [RegisterController::class, 'store'], [GuestMiddleware::class]),

  Route::get('/login', [LoginController::class, 'create'], [GuestMiddleware::class]),
  Route::post('/login', [LoginController::class, 'store'], [GuestMiddleware::class]),

  Route::post('/logout', [LoginController::class, 'destroy']),
];
