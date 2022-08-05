<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/user/create', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/update/{user}', [UserController::class, 'update']);
Route::delete('/user/delete/{user}', [UserController::class, 'delete']);
Route::get('/user/{user}', [UserController::class, 'user']);
Route::get('/users', [UserController::class, 'users']);