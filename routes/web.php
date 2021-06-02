<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;


Route::group(['middleware' => 'isLogin'], function(){
    Route::get('/giris', function () {
        return view('login');
    })->name('login');
    Route::post('/giris', [AuthController::class, 'loginPost'])->name('login.post');

});

Route::group(['middleware' => 'isLogged'], function(){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/cikis', [AuthController::class, 'logout'])->name('logout');
});
