<?php

use App\Http\Controllers\admin\api\productAPI;
use App\Http\Controllers\admin\api\userAPIController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// );

// Route::get('/products',[productAPI::class,'index'])->name('api.products');
// Route::get('/users',[userAPIController::class,'index'])->name('api.users');

// Route::post('register',[AuthController::class, 'register'])->name('register');
// Route::post('login',[AuthController::class, 'login'])->name('login');

// Route::middleware('auth:sanctum')->group(function(){
//   Route::get('user',[AuthController::class, 'user'])->name('user');
//   Route::get('logout',[AuthController::class, 'logout'])->name('logout');
// });