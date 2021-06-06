<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D as DNS1D;

//MODELS
use App\Models\Brand;
use App\Models\Category;
use App\Models\Unit;

//REQUEST
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('isActive', 1)->orderByDesc('id')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('isActive', 1)->get();
        $brands = Brand::where('isActive', 1)->get();
        $units = Unit::where('isActive', 1)->get();
        return view('products.create', compact('categories', 'brands', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        /*$product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->code = substr($request->code, 0, 12);
        $product->categoryId = $request->categoryId;
        $product->brandId = $request->brandId;
        $product->unitId = $request->unitId;
        $product->taxRate = $request->taxRate;
        $product->buyingPrice = $request->buyingPrice;
        $product->sellingPrice = $request->sellingPrice;
        $request->followStock === 'yes' ? $product->followStock = 1 : $product->followStock = 0;
        $request->followStock === 'yes' ? $product->criticStockAlert = $request->criticStockAlert : $product->criticStockAlert = (-1);
        $product->description = $request->description;
        $product->isActive = 1;*/


        $request->merge([
            'image' => null,
            'slug' => Str::slug($request->name),
            'isActive' => 1,
            'sellingPrice' => $request->sellingPrice
        ]);

        if ($request->followStock === 'yes') {
            $request->merge([
                'followStock' => 1,
                'criticStockAlert' => (string)$request->criticStockAlert
            ]);
        } else {
            $request->merge([
                'followStock' => 0,
                'criticStockAlert' => -1
            ]);
        }

        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->name) . '_' . date_timestamp_get(date_create()) . '.' . $request->image->extension();
            $fileNameWithDirectory = 'images/uploads/' . $fileName;
            $request->image->move(public_path('images/uploads'), $fileName);

            $request->merge([
                'image' => $fileNameWithDirectory
            ]);
        }

        try {
            Product::create($request->post());
            toastr('Ürün başarılı bir şekilde eklendi.', 'success');
            return redirect()->route('urunler.index');
        }
        catch (Exception $e){
            toastr('Ürün eklenemdi', 'error');
            return redirect()->route('urunler.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
