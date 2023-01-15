<?php


use App\Models\admin\Product;
use Illuminate\Support\Facades\Route;
use App\Models\admin\Brand;
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
require_once __DIR__.'/be.php';

Route::get('/', function () {
    return view('welcome');
});
Route::get('/a',function(){
  $user =  Product::find(2);
  $cat = Brand::find(1);
  echo $cat->product_id;
  echo $user->id;
  echo $cat->products->name;
});

Route::get('/homeadmin',function(){
    return view('admin.layout');
})->name('homeAdmin');

Route::get('/home',function(){
    return view('user.desgin.landing');
})->name('homeUser');

Route::get('/register',function(){
    return view('register',[]);
})->name('Register');

Route::get('/login',function(){
    return view('login');
})->name('Login');