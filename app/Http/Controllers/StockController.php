<?php

namespace App\Http\Controllers;

use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//MODELS
use App\Models\Stock;

//REQUESTS
use App\Http\Requests\StockCreteRequest;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('stock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('isActive', 1)->get();
        return view('stock.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StockCreteRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StockCreteRequest $request)
    {
        $productPrice = Product::select('sellingPrice')->where('id', $request->productId)->first();
        $request->merge([
            'transactionNumber' => Str::orderedUuid()->toString(),
            'sumProductCount' => $request->quantity,
            'sumTradingVolume' => (doubleval($request->quantity) * doubleval($productPrice->sellingPrice)),
            'inOrOut' => $request->inOrOut == 'out' ? 0 : 1,
        ]);

        try {
            Stock::create($request->post());
            toastr('Stok işlemi bir şekilde eklendi.', 'success');
            return redirect()->route('urunler.index');
        }catch (Exception $ex){
            toastr('Stok işlemi yapılamadı.', 'success');
            return redirect()->route('urunler.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductUnit(Request $request)
    {
        $productUnitName = Product::find($request->id)->unitDetails->name;
        return response()->json($productUnitName);
    }
}
