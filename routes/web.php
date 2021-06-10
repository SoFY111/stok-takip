<?php

use Illuminate\Support\Facades\Route;

//CONTROLLERS
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;


Route::group(['middleware' => 'isLogin'], function(){
    Route::get('/giris', function () {
        return view('login');
    })->name('login');
    Route::post('/giris', [AuthController::class, 'loginPost'])->name('login.post');

});

Route::group(['middleware' => 'isLogged'], function(){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('getbrandorunitname', [ActionsController::class, 'getBrandOrUnitName'])->name('getBrandOrUnitName');
    Route::get('updatebrandorunitname', [ActionsController::class, 'updateBrandOrUnitName'])->name('updateBrandOrUnitName');

    Route::get('markalar/destroy/{id}', [ActionsController::class, 'brandDestroy'])->name('marka.destroy');
    Route::post('birimler/destroy', [ActionsController::class, 'unitDestroy'])->name('birim.destroy');

    Route::get('kategoriler/getcategoryname', [CategoryController::class, 'getCategoryName'])->name('getCategoryName');
    Route::post('kategoriler/updatecategoryname', [CategoryController::class, 'updateCategoryName'])->name('kategori.update');
    Route::get('kategoriler/sil/{id}', [CategoryController::class, 'delete'])->name('kategoriler.delete');

    Route::get('urunler/sil/{id}', [ProductController::class, 'delete'])->name('urunler.delete');

    Route::get('stok/getproductunit/{id}', [StockController::class, 'getProductUnit'])->name('stok.getProductUnit');

    Route::post('kategoriler/ajaxstore', [CategoryController::class, 'ajaxStore'])->name('kategoriler.ajaxStore');
    Route::post('birimler/ajaxstore', [UnitController::class, 'ajaxStore'])->name('birimler.ajaxStore');
    Route::post('markalar/ajaxstore', [BrandController::class, 'ajaxStore'])->name('markalar.ajaxStore');

    Route::get('stok/getinstocktransactions/{id}/{type}', [StockController::class, 'getInStockTransactions'])->name('stok.getinstocktransactions');

    Route::resource('urunler', ProductController::class);
    Route::resource('markalar', BrandController::class);
    Route::resource('birimler', UnitController::class);
    Route::resource('kategoriler', CategoryController::class);
    Route::resource('stok', StockController::class);

    Route::get('/cikis', [AuthController::class, 'logout'])->name('logout');
});
