<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//MODELS
use App\Models\Product;
use App\Models\Stock;

class DashboardController extends Controller
{
    function dashboard(){
        $stocks = new \stdClass();
        $products = Product::where('isActive', 1)->orderByDesc('id')->limit(5)->get();
        $stocks->upComingStocks = Stock::where('isActive', 1)
            ->where('productIsActive', 1)
            ->where('date', '>', (now()))
            ->orderBy('date')
            ->limit(5)
            ->get();

        $stocks->pastStocks = Stock::where('isActive', 1)
            ->where('productIsActive', 1)
            ->where('date', '<', (now()))
            ->orderByDesc('date')
            ->limit(5)
            ->get();
        return view('dashboard', compact('stocks', 'products'));
    }
}
