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

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('/user', [AuthController::class, 'create']); //insere novo 
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    Route::get('/auth/me', [AuthController::class, 'me']); //pegar o user logado

    Route::post('/category', [CategoryController::class, 'create']);
    Route::get('/categories', [CategoryController::class, 'readAll']);
    Route::get('/category/{id}', [CategoryController::class, 'read']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'delete']);

    Route::post('/product', [ProductController::class, 'create']);
    Route::get('/products', [ProductController::class, 'readAll']);
    Route::get('/product/{id}', [ProductController::class, 'read']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'delete']);
    
});




