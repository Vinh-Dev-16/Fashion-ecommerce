<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\brandController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\admin\attributeController;
use App\Http\Controllers\admin\ValueController;
use App\Http\Controllers\admin\imagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth', 'is_admin')->prefix('/admin')->group(function () {
  Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
  })->name('admin.dashboard.index');

  Route::middleware('account_manager')->prefix('/account')->group(function () {
    Route::get('/index', [userController::class, 'index'])->name('admin.account.index');
    Route::patch('update/{id}', [userController::class, 'update'])->name('admin.account.update');
    Route::get('edit/{id}', [userController::class, 'edit'])->name('admin.account.edit');
    Route::delete('delete/{id}', [userController::class, 'delete'])->name('admin.account.delete');
    Route::get('viewrestore', [userController::class,'viewrestore'])->name('admin.account.viewrestore');
    Route::get('restore/{id}', [userController::class, 'restore'])->name('admin.account.restore');
    Route::delete('delete/{id}', [userController::class, 'delete'])->name('admin.account.delete');
  });

  // Router Products

  Route::prefix('/product')->group(function () {
    Route::get('/index', [productController::class, 'index'])->name('admin.product.index');
    Route::get('create', [productController::class, 'create'])->name('admin.product.create');
    Route::post('store', [productController::class, 'store'])->name('admin.product.store');
    Route::delete('destroy/{id}', [productController::class, 'destroy'])->name('admin.product.destroy');
    Route::patch('update/{id}', [productController::class, 'update'])->name('admin.product.update');
    Route::get('edit/{id}', [productController::class, 'edit'])->name('admin.product.edit');
    Route::get('search', [productController::class, 'search'])->name('admin.product.search');
    Route::get('viewrestore', [productController::class, 'viewrestore'])->name('admin.product.viewrestore');
    Route::get('restore/{id}', [productController::class, 'restore'])->name('admin.product.restore');
    Route::delete('delete/{id}', [productController::class, 'delete'])->name('admin.product.delete');
  });
  // Route Category


  Route::prefix('/category')->group(function () {
    Route::get('/index', [categoryController::class, 'index'])->name('admin.category.index');
    Route::get('create', [categoryController::class, 'create'])->name('admin.category.create');
    Route::post('store', [categoryController::class, 'store'])->name('admin.category.store');
    Route::delete('destroy/{id}', [categoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::patch('update/{id}', [categoryController::class, 'update'])->name('admin.category.update');
    Route::get('edit/{id}', [categoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('search', [categoryController::class, 'search'])->name('admin.category.search');
  });

  //  Route về brand
  Route::prefix('/brand')->group(function () {
    Route::get('/index', [brandController::class, 'index'])->name('admin.brand.index');
    Route::get('create', [brandController::class, 'create'])->name('admin.brand.create');
    Route::post('store', [brandController::class, 'store'])->name('admin.brand.store');
    Route::delete('destroy/{id}', [brandController::class, 'destroy'])->name('admin.brand.destroy');
    Route::patch('update/{id}', [brandController::class, 'update'])->name('admin.brand.update');
    Route::get('edit/{id}', [brandController::class, 'edit'])->name('admin.brand.edit');
    Route::get('search', [brandController::class, 'search'])->name('admin.brand.search');
  });
  // Route về attribute

  Route::prefix('/attribute')->group(function () {
    Route::get('/index', [attributeController::class, 'index'])->name('admin.attribute.index');
    Route::get('create', [attributeController::class, 'create'])->name('admin.attribute.create');
    Route::post('store', [attributeController::class, 'store'])->name('admin.attribute.store');
    Route::delete('destroy/{id}', [attributeController::class, 'destroy'])->name('admin.attribute.destroy');
    Route::patch('update/{id}', [attributeController::class, 'update'])->name('admin.attribute.update');
    Route::get('edit/{id}', [attributeController::class, 'edit'])->name('admin.attribute.edit');
  });

  // Route attribute value

  Route::prefix('/value')->group(function () {
    Route::get('/index', [valueController::class, 'index'])->name('admin.value.index');
    Route::get('create', [valueController::class, 'create'])->name('admin.value.create');
    Route::post('store', [valueController::class, 'store'])->name('admin.value.store');
    Route::delete('destroy/{id}', [valueController::class,'destroy'])->name('admin.value.destroy');
    Route::patch('update/{id}', [valueController::class, 'update'])->name('admin.value.update');
    Route::get('edit/{id}', [valueController::class, 'edit'])->name('admin.value.edit');
  });


  // Route về Images Product

  Route::prefix('/images')->group(function () {
    Route::get('/index', [imagesController::class, 'index'])->name('admin.images.index');
    Route::get('create', [imagesController::class, 'create'])->name('admin.images.create');
    Route::patch('update/{id}', [imagesController::class, 'update'])->name('admin.images.update');
    Route::post('store', [imagesController::class, 'store'])->name('admin.images.store');
    Route::get('edit/{id}', [imagesController::class, 'edit'])->name('admin.images.edit');
    Route::delete('destroy/{id}', [imagesController::class, 'destroy'])->name('admin.images.destroy');
    Route::get('search', [imagesController::class, 'search'])->name('admin.images.search');
  });
});
