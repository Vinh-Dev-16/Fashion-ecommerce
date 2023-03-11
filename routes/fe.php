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
        Route::get('/',[homeController::class,'home'])->name('home');
    })

?>