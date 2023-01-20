<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\catproController;
use App\Http\Controllers\admin\brandController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
  Route::prefix('/admin')->group(function(){
    Route::prefix('/product')->group(function(){
      Route::get('/index', [productController::class,'index'])->name('admin.product.index');
      Route::get('create', [productController::class,'create'])->name('admin.product.create');
       Route::post('store',[productController::class,'store'])->name('admin.product.store');
       Route::delete('destroy/{id}',[productController::class,'destroy'])->name('admin.product.destroy');
       Route::patch('update/{id}',[productController::class,'update'])->name('admin.product.update');
       Route::get('edit/{id}/{slug}',[productController::class,'edit'])->name('admin.product.edit');
       Route::get('search',[productController::class,'search'])->name('admin.product.search');
    });
    // Route Category


     Route::prefix('/category')->group(function(){
      Route::get('/index', [categoryController::class,'index'])->name('admin.category.index');
      Route::get('create', [categoryController::class,'create'])->name('admin.category.create');
       Route::post('store',[categoryController::class,'store'])->name('admin.category.store');
       Route::delete('destroy/{id}',[categoryController::class,'destroy'])->name('admin.category.destroy');
       Route::patch('update/{id}',[categoryController::class,'update'])->name('admin.category.update');
       Route::get('edit/{id}',[categoryController::class,'edit'])->name('admin.category.edit');
     });

    //  Route quan hệ Category vs product


     Route::prefix('/catpro')->group(function(){
        Route::get('/index',[catproController::class,'index'])->name('admin.catpro.index');
        Route::get('create',[catproController::class,'create'])->name('admin.catpro.create');
        Route::post('store',[catproController::class,'store'])->name('admin.catpro.store');
        Route::delete('destroy/{id}',[catproController::class,'destroy'])->name('admin.catpro.destroy');
        Route::patch('update/{id}',[catproController::class,'update'])->name('admin.catpro.update');
        Route::get('edit/{id}',[catproController::class,'edit'])->name('admin.catpro.edit');
     });

    //  Route về brand


     Route::prefix('/brand')->group(function(){
        Route::get('/index',[brandController::class,'index'])->name('admin.brand.index');
        Route::get('create',[brandController::class,'create'])->name('admin.brand.create');
        Route::post('store',[brandController::class,'store'])->name('admin.brand.store');
     });
  });
?>