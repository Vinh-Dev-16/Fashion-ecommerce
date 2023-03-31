<?php

use App\Http\Controllers\user\reviewController;
use App\Http\Controllers\user\cartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\user\informationController;
use App\Http\Controllers\user\singlePageController;
use App\Http\Controllers\user\wishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/ 
    Route::prefix('/')->group(function(){
        Route::get('',[homeController::class,'home'])->name('home');
        Route::get('search',[homeController::class,'search'])->name('search');
        Route::get('searchpage',[homeController::class,'searchPage'])->name('searchpage');
  
        // Route Cart

        Route::post('cart/{id}',[cartController::class,'addToCart'])->name('cart');
        Route::get('removecart/{id}',[cartController::class,'removeCart'])->name('removecart');
  
        // Route single-page

        Route::get('/detail/{id}',[singlePageController::class,'detail'])->name('detail');
        Route::get('pageoffer/{id}',[singlePageController::class,'pageOffer'])->name('pageoffer');
        Route::get('/brand/{id}',[singlePageController::class,'brand'])->name('brand');

        Route::prefix('wishlist')->group(function(){
            Route::get('/{id}',[wishlistController::class,'index'])->name('wishlist');
            Route::post('store/{id}',[wishlistController::class,'store'])->name('wishlist.store');
            Route::delete('destroy/{id}',[wishlistController::class,'destroy'])->name('wishlist.destroy');
            Route::delete('delete/{id}',[wishlistController::class,'delete'])->name('wishlist.delete');
        });

        // Route infomation user

        Route::prefix('information')->group(function(){
            Route::get('/{id}',[informationController::class,'index'])->name('information');
         });

        // Route comment

        Route::middleware('auth')->prefix('/review')->group(function(){
            Route::post('/store/{id}',[reviewController::class,'store'])->name('review.store');
            Route::delete('/destroy/{id}',[reviewController::class,'destroy'])->name('review.destroy');
            Route::get('edit/{id}',[reviewController::class,'edit'])->name('review.edit');
            Route::patch('update/{id}',[reviewController::class,'update'])->name('review.update');
        });
    })

?>