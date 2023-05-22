<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;

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

// Route::get('/{any}', function ($any) {

//     return view('404');
  
// })->where('any', '.*');


Route::get('/register', function(){
    return view('register');
})->name('register');

Route::get('/login', function(){
    return view('login');
})->name('login');


Route::get('auth/redirect/{provider}',[AuthController::class, 'redirect'])->name('auth/redirect');
Route::get('callback/{provider}',[AuthController::class, 'callback'])->name('callback');

Route::post('/register',[AuthController::class, 'register'])->name('do_register');
Route::post('/login',[AuthController::class, 'login'])->name('do_login');
Route::post('/logout',[AuthController::class, 'logout'])->name('do_logout');