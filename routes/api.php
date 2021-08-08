<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/ping', function() {
    return ['pong' => true];
});

Route::get('/unauthenticated', function() {
    return ['error' => 'Usuário não está logado!'];
})->name('login');

Route::middleware('auth:api')->post('/user', [AuthController::class, 'create']); //insere novo 
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/auth/logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->get('/auth/me', [AuthController::class, 'me']); //pegar o user logado

Route::middleware('auth:api')->post('/category', [CategoryController::class, 'create']);
Route::middleware('auth:api')->get('/categories', [CategoryController::class, 'readAll']);
Route::middleware('auth:api')->get('/category/{id}', [CategoryController::class, 'read']);
Route::middleware('auth:api')->put('/category/{id}', [CategoryController::class, 'update']);
Route::middleware('auth:api')->delete('/category/{id}', [CategoryController::class, 'delete']);

Route::middleware('auth:api')->post('/product', [ProductController::class, 'create']);
Route::middleware('auth:api')->get('/products', [ProductController::class, 'readAll']);
Route::middleware('auth:api')->get('/product/{id}', [ProductController::class, 'read']);
Route::middleware('auth:api')->put('/product/{id}', [ProductController::class, 'update']);
Route::middleware('auth:api')->delete('/product/{id}', [ProductController::class, 'delete']);



