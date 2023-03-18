<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\homeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
    Route::prefix('/')->group(function(){
        Route::get('',[homeController::class,'home'])->name('home');
        Route::get('search',[homeController::class,'search'])->name('search');
        Route::get('/detail/{id}',[homeController::class,'detail'])->name('detail');
        Route::get('pageoffer/{id}',[homeController::class,'pageOffer'])->name('pageoffer');
        Route::get('/brand/{id}',[homeController::class,'brand'])->name('brand');

        Route::prefix('/review')->group(function(){
            Route::get('/index/{id}',[homeController::class,'index'])->name('review.index');
            
        });
    })

?>