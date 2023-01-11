<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\productController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
  Route::prefix('/admin')->group(function(){
    Route::prefix('/product')->group(function(){
      Route::get('/index', [productController::class,'index'])->name('admin.product.index');
            // Route::get('create', 'ProductController@create')->name('product.create');
            // Route::post('create', 'ProductController@store')->name('product.store');
    });
  });
?>