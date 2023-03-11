<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
require __DIR__.'/../routes/fe.php';
require __DIR__.'/../routes/be.php';

Route::get('/welcome', function () {
    return view('welcome');
});




Route::get('/register', function(){
    return view('register');
})->name('register');

Route::get('/login', function(){
    return view('login');
})->name('login');

Route::post('/register',[AuthController::class, 'register'])->name('do_register');
Route::post('/login',[AuthController::class, 'login'])->name('do_login');
Route::post('/logout',[AuthController::class, 'logout'])->name('do_logout');