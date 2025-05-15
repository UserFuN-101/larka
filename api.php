<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController; 

// Category
Route::get('/api/categories', [CategoryController::class, 'index']);
Route::post('/api/categories', [CategoryController::class, 'store']);
Route::get('/api/categories/{id}', [CategoryController::class, 'show']);
Route::put('/api/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/api/categories/{id}', [CategoryController::class, 'destroy']);

// Product
Route::get('/api/products', [ProductController::class, 'index']);
Route::post('/api/products', [ProductController::class, 'store']);
Route::get('/api/products/{id}', [ProductController::class, 'show']);
Route::put('/api/products/{id}', [ProductController::class, 'update']);
Route::delete('/api/products/{id}', [ProductController::class, 'destroy']);

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});