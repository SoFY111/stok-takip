<?php

use Illuminate\Support\Facades\Route;

//CONTROLLERS
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;


Route::group(['middleware' => 'isLogin'], function(){
    Route::get('/giris', function () {
        return view('login');
    })->name('login');
    Route::post('/giris', [AuthController::class, 'loginPost'])->name('login.post');

});

Route::group(['middleware' => 'isLogged'], function(){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('urunler', ProductController::class);

    Route::resource('markalar', BrandController::class);

    Route::resource('birimler', UnitController::class);

    Route::get('/cikis', [AuthController::class, 'logout'])->name('logout');
});
