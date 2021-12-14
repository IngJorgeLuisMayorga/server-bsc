<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WhislistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});



Route::get('/users', [UserController::class, 'getAll']);
Route::get('/users/{id}', [UserController::class, 'getById']);
Route::post('/users', [UserController::class, 'add']);
Route::patch('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'remove']);


Route::get('/products', [ProductController::class, 'getAll']);
Route::get('/products/{id}', [ProductController::class, 'getById']);
Route::post('/products', [ProductController::class, 'add']);
Route::patch('/products/{id}', [ProductController::class, 'update']);
Route::post('/products/upload/picture', [ProductController::class, 'uploadPicture']);
Route::delete('/products/{id}', [ProductController::class, 'remove']);


Route::get('/categories', [CategoriesController::class, 'getAll']);
Route::get('/categories/{id}', [CategoriesController::class, 'getById']);
Route::post('/categories', [CategoriesController::class, 'add']);
Route::patch('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'remove']);


Route::get('/orders', [OrderController::class, 'getAll']);
Route::get('/orders/{id}', [OrderController::class, 'getById']);
Route::get('/orders/by/user/{id}', [OrderController::class, 'getByUserId']);
Route::post('/orders', [OrderController::class, 'add']);
Route::patch('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'remove']);


Route::get('/wishlist', [WhislistController::class, 'getAll']);
Route::get('/wishlist/{id}', [WhislistController::class, 'getById']);
Route::get('/wishlist/by/user/{id}', [WhislistController::class, 'getByUserId']);
Route::post('/wishlist', [WhislistController::class, 'add']);
Route::patch('/wishlist/{id}', [WhislistController::class, 'update']);
Route::delete('/wishlist/{id}', [WhislistController::class, 'remove']);

