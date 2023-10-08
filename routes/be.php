<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\permissionController;
use App\Http\Controllers\admin\roleController;
use App\Http\Controllers\admin\voucherController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin|editor|manager'] ], function () {

    Route::get('dashboard', [dashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::group(['prefix' => 'role' , 'middleware' => ['role:admin']], function () {
        Route::get('index',[roleController::class,'index'])->name('admin.role.index');
        Route::get('create',[roleController::class,'create'])->name('admin.role.create');
        Route::post('store',[roleController::class,'store'])->name('admin.role.store');
        Route::get('edit/{slug}',[roleController::class,'edit'])->name('admin.role.edit');
        Route::patch('update/{id}',[roleController::class,'update'])->name('admin.role.update');
        Route::get('destroy/{id}',[roleController::class,'destroy'])->name('admin.role.destroy');
    });

    Route::group(['prefix' => 'permission' , 'middleware' => ['role:admin']], function () {
        Route::get('index',[permissionController::class,'index'])->name('admin.permission.index');
        Route::get('create',[permissionController::class,'create'])->name('admin.permission.create');
        Route::post('store',[permissionController::class,'store'])->name('admin.permission.store');
        Route::get('edit/{slug}',[permissionController::class,'edit'])->name('admin.permission.edit');
        Route::patch('update/{id}',[permissionController::class,'update'])->name('admin.permission.update');
        Route::get('destroy/{id}',[permissionController::class,'destroy'])->name('admin.permission.destroy');

    });

    Route::group(['prefix' => 'user', 'middleware' => ['role:admin']] , function () {
        Route::get('index',[userController::class,'index'])->name('admin.user.index');
        Route::get('role/{id}', [userController::class,'role'])->name('admin.user.role');
        Route::post('doRole/{id}', [userController::class,'doRole'])->name('admin.user.doRole');
        Route::post('doPermission/{id}', [userController::class,'doPermission'])->name('admin.user.doPermission');
        Route::get('permission/{id}', [userController::class, 'permission'])->name('admin.user.permission');
        Route::get('destroy/{id}', [userController::class, 'destroy'])->name('admin.account.destroy');
        Route::get('viewrestore', [userController::class,'viewrestore'])->name('admin.account.viewrestore');
        Route::get('restore/{id}', [userController::class, 'restore'])->name('admin.account.restore');
        Route::get('delete/{id}', [userController::class, 'delete'])->name('admin.account.delete');
    });

    // Route Products

  Route::prefix('/product')->middleware('role:admin|editor|manager')->group(function () {
    Route::get('/index', [productController::class, 'index'])->name('admin.product.index');
    Route::get('create', [productController::class, 'create'])->name('admin.product.create');
    Route::post('store', [productController::class, 'store'])->name('admin.product.store');
    Route::delete('destroy/{id}', [productController::class, 'destroy'])->name('admin.product.destroy');
    Route::patch('update/{id}', [productController::class, 'update'])->name('admin.product.update');
    Route::get('edit/{slug}', [productController::class, 'edit'])->name('admin.product.edit');
    Route::get('list_data', [productController::class, 'listData'])->name('admin.product.list_data');
    Route::get('viewrestore', [productController::class, 'viewrestore'])->name('admin.product.viewrestore');
    Route::get('restore/{id}', [productController::class, 'restore'])->name('admin.product.restore');
    Route::delete('delete/{id}', [productController::class, 'delete'])->name('admin.product.delete');
  });
  // Route Category


  Route::prefix('category')->middleware('role:admin|editor|manager')->group(function () {
    Route::get('/index', [categoryController::class, 'index'])->name('admin.category.index');
    Route::get('create', [categoryController::class, 'create'])->name('admin.category.create');
    Route::post('store', [categoryController::class, 'store'])->name('admin.category.store');
    Route::post('destroy', [categoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::post('update', [categoryController::class, 'update'])->name('admin.category.update');
    Route::get('edit/{id}', [categoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('search', [categoryController::class, 'search'])->name('admin.category.search');
  });

  //  Route về brand
  Route::prefix('/brand')->middleware('role:admin|editor|manager')->group(function () {
    Route::get('/index', [brandController::class, 'index'])->name('admin.brand.index');
    Route::get('create', [brandController::class, 'create'])->name('admin.brand.create');
    Route::post('store', [brandController::class, 'store'])->name('admin.brand.store');
    Route::post('destroy', [brandController::class, 'destroy'])->name('admin.brand.destroy');
    Route::post('update', [brandController::class, 'update'])->name('admin.brand.update');
    Route::get('edit/{id}', [brandController::class, 'edit'])->name('admin.brand.edit');
    Route::get('search', [brandController::class, 'search'])->name('admin.brand.search');
  });

//  route về voucher

    Route::prefix('/voucher')->middleware('role:admin|editor|manager')->group(function () {
        Route::get('/index', [voucherController::class, 'index'])->name('admin.voucher.index');
        Route::get('create', [voucherController::class, 'create'])->name('admin.voucher.create');
        Route::post('store', [voucherController::class, 'store'])->name('admin.voucher.store');
        Route::post('destroy', [voucherController::class, 'destroy'])->name('admin.voucher.destroy');
        Route::post('update', [voucherController::class, 'update'])->name('admin.voucher.update');
        Route::get('edit/{id}', [voucherController::class, 'edit'])->name('admin.voucher.edit');
        Route::get('search', [voucherController::class, 'search'])->name('admin.voucher.search');
    });

  // Route về attribute

  Route::prefix('/attribute')->middleware('role:admin|editor|manager')->group(function () {
    Route::get('/index', [attributeController::class, 'index'])->name('admin.attribute.index');
    Route::get('create', [attributeController::class, 'create'])->name('admin.attribute.create');
    Route::post('store', [attributeController::class, 'store'])->name('admin.attribute.store');
    Route::delete('destroy/{id}', [attributeController::class, 'destroy'])->name('admin.attribute.destroy');
    Route::patch('update/{id}', [attributeController::class, 'update'])->name('admin.attribute.update');
    Route::get('edit/{id}', [attributeController::class, 'edit'])->name('admin.attribute.edit');
  });

  // Route attribute value

  Route::prefix('/value')->middleware('role:admin|editor|manager')->group(function () {
    Route::get('/index', [valueController::class, 'index'])->name('admin.value.index');
    Route::get('create', [valueController::class, 'create'])->name('admin.value.create');
    Route::post('store', [valueController::class, 'store'])->name('admin.value.store');
    Route::delete('destroy/{id}', [valueController::class,'destroy'])->name('admin.value.destroy');
    Route::patch('update/{id}', [valueController::class, 'update'])->name('admin.value.update');
    Route::get('edit/{id}', [valueController::class, 'edit'])->name('admin.value.edit');
  });


  // Route về Images Product

  Route::prefix('/images')->middleware('role:admin|editor|manager')->group(function () {
    Route::get('/index', [imagesController::class, 'index'])->name('admin.images.index');
    Route::get('create', [imagesController::class, 'create'])->name('admin.images.create');
    Route::patch('update/{id}', [imagesController::class, 'update'])->name('admin.images.update');
    Route::post('store', [imagesController::class, 'store'])->name('admin.images.store');
    Route::get('edit/{id}', [imagesController::class, 'edit'])->name('admin.images.edit');
    Route::delete('destroy/{id}', [imagesController::class, 'destroy'])->name('admin.images.destroy');
    Route::get('search', [imagesController::class, 'search'])->name('admin.images.search');
  });
});
