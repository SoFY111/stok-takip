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
     * @return Illuminate\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $activeProductsIds= Product::where('isActive', 1)->pluck('id');
        $stocks = Stock::whereIn('productId', $activeProductsIds)->orderByDesc('date');

        if(request()->get('filterSearch') OR request()->get('filterSearch') == 0){
            $searchedProductId = Product::where('isActive', 1)->where('name', 'LIKE', '%'.request()->get('filterSearch').'%')->pluck('id');
            $stocks = Stock::whereIn('productId', $searchedProductId)->where('isActive', '1');
        }
        if(request()->get('filterSearch') OR request()->get('filterSearch') == 0){
            if(    strpos(request()->get('filterSearch'), 'giriş') === true
                OR strpos(request()->get('filterSearch'), 'girdi') === true
                OR strpos(request()->get('filterSearch'), 'stok girişi') === true
                OR strpos(request()->get('filterSearch'), 'stok girdi') === true
                OR strpos(request()->get('filterSearch'), 'g')){
                $stocks=$stocks->orWhere('inOrOut', 1)->where('isActive', 1);
            }elseif(strpos(request()->get('filterSearch'), 'çıkış') === true
                 OR strpos(request()->get('filterSearch'), 'stok çıkışı') === true
                 OR strpos(request()->get('filterSearch'), 'stok çıktısı') === true
                 OR strpos(request()->get('filterSearch'), 'ç')){
                $stocks=$stocks->orWhere('inOrOut', 0)->where('isActive', 1);
            }
        }
        if(request()->get('filterSearch')){
            $stocks= $stocks->orWhere('sumProductCount', request()->get('filterSearch'))->where('isActive', 1);
        }
        if(request()->get('filterSearch') OR request()->get('filterSearch') == 0){
            $stocks= $stocks->orWhere('supplier', 'LIKE' , '%'.request()->get('filterSearch').'%')->where('isActive', 1);

        }
        if(request()->get('filterSearch') OR request()->get('filterSearch') == 0){
            $date = date('Y-m-d', strtotime(str_replace('-', '/', request()->get('filterSearch'))));
            $dateOne = $date . ' 00:00:00';
            $dateTwo = $date . ' 23:59:59';
            $stocks= $stocks->orWhere('date', '>' , $dateOne)->where('date', '<', $dateTwo)->where('isActive', 1);
        }

        $stocks = $stocks->paginate(10);
        return view('stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
            return redirect()->route('stok.index');
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
