<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/homeadmin',function(){
    return view('admin.layout');
})->name('homeAdmin');

Route::get('/home',function(){
    return view('user.desgin.landing');
})->name('homeUser');
Route::get('/register',function(){
    return view('register');
})->name('Register');