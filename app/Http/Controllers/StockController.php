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
        $stocks = Stock::whereIn('productId', $activeProductsIds)->orderByDesc('date')->where('isActive', 1)->where('productIsActive', 1);
        if(request()->get('filterSearch') OR request()->get('filterSearch') == 0){
            $searchedProductId = Product::where('isActive', 1)->where('name', 'LIKE', '%'.request()->get('filterSearch').'%')->pluck('id');
            $stocks = $stocks->whereIn('productId', $searchedProductId)->where('isActive', '1')->where('productIsActive', 1);

        }
        if(request()->get('filterSearch')){
            if(   str_contains('giriş', request()->get('filterSearch'))
               OR str_contains('stok girişi', request()->get('filterSearch'))
               OR str_contains('stok girdisi', request()->get('filterSearch'))
               OR str_contains('girdi', request()->get('filterSearch'))){
                $stocks=$stocks->orWhere('inOrOut', 1)->where('isActive', 1)->where('productIsActive', 1);

            }elseif(str_contains('çıkış', request()->get('filterSearch'))
                 OR str_contains('stok çıkışı', request()->get('filterSearch'))
                 OR str_contains('stok çıktısı', request()->get('filterSearch'))
                 OR str_contains('çıktı', request()->get('filterSearch'))){
                $stocks=$stocks->orWhere('inOrOut', 0)->where('isActive', 1)->where('productIsActive', 1);
            }
        }
        if(request()->get('filterSearch')){
            $stocks= $stocks->orWhere('sumProductCount', request()->get('filterSearch'))->where('isActive', 1)->where('productIsActive', 1);
        }
        if(request()->get('filterSearch') OR request()->get('filterSearch') == 0){
            $stocks= $stocks->orWhere('supplier', 'LIKE' , '%'.request()->get('filterSearch').'%')->where('isActive', 1)->where('productIsActive', 1);
        }
        if(request()->get('filterSearch') OR request()->get('filterSearch') == 0){
            $date = date('Y-d-m', strtotime(str_replace('-', '/', request()->get('filterSearch'))));
            $dateOne = $date . ' 00:00:00';
            $dateTwo = $date . ' 23:59:59';
            $stocks= $stocks->orWhere('date', '>' , $dateOne)->where('date', '<', $dateTwo)->where('isActive', 1)->where('productIsActive', 1);
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
        $productPrice = Product::select(['sellingPrice', 'buyingPrice'])->where('id', $request->productId)->first();
        $request->merge([
            'transactionNumber' => Str::orderedUuid()->toString(),
            'sumProductCount' => $request->quantity,
            'sumTradingVolume' => (doubleval($request->quantity) * doubleval($request->inOrOut === 'out' ? $productPrice->sellingPrice : $productPrice->buyingPrice)),
            'inOrOut' => $request->inOrOut === 'out' ? 0 : 1,
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

    public function getInStockTransactions($id, $type){
        if(explode('=', \request()->getQueryString())[0] == 'page'){
            $page = \request()->getQueryString();
            $pageNumber = explode('=', $page)[1];
        }
        else $pageNumber = 0;
        if($type === 'in') $stocks = Stock::where('isActive', 1)->where('productId', $id)->where('inOrOut', 1)->orderByDesc('date')->paginate(9, ['*'], 'page', $pageNumber);
        elseif($type === 'out') $stocks = Stock::where('isActive', 1)->where('productId', $id)->where('inOrOut', 0)->orderByDesc('date')->paginate(9, ['*'], 'page', $pageNumber);
        else $stocks = Stock::where('isActive', 1)->where('productId', $id)->orderByDesc('date')->paginate(9, ['*'], 'page', $pageNumber);
        return response()->json(\View::make('components.stock-mobility', ['stocks' => $stocks, 'type' => $type, 'productId' => $id])->render());
    }
}
