<?php

use App\Controllers\LoginController;
use App\Controllers\PlantController;
use App\Controllers\RegisterController;
use App\Middleware\AuthMiddleware;
use App\Middleware\EditMiddleware;
use App\Middleware\GuestMiddleware;
use Core\Router\Route;

return [
  Route::get('/', [PlantController::class, 'index']),
  Route::get('/plants/create', [PlantController::class, 'create'], [AuthMiddleware::class]),
  Route::post('/plants', [PlantController::class, 'store'], [AuthMiddleware::class]),
  Route::get('/plants/{id}', [PlantController::class, 'show']),
  Route::get('/plants/{id}/edit', [PlantController::class, 'edit'], [AuthMiddleware::class, EditMiddleware::class]),
  Route::patch('/plants/{id}', [PlantController::class, 'update'], [EditMiddleware::class]),
  Route::delete('/plants/{id}', [PlantController::class, 'destroy'], [EditMiddleware::class]),

  Route::get('/register', [RegisterController::class, 'create'], [GuestMiddleware::class]),
  Route::post('/register', [RegisterController::class, 'store'], [GuestMiddleware::class]),

  Route::get('/login', [LoginController::class, 'create'], [GuestMiddleware::class]),
  Route::post('/login', [LoginController::class, 'store'], [GuestMiddleware::class]),

  Route::post('/logout', [LoginController::class, 'destroy']),
];
