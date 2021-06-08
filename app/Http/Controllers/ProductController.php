<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

//MODELS
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Unit;

//REQUESTS
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('isActive', 1)->orderByDesc('id')->paginate(13);
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
        $count = Product::where('isActive', 1)
                            ->where('name', $request->name)
                            ->where('slug', Str::slug($request->name))
                            ->get()
                            ->count();
        if($count > 0){
            toastr('Aynı isme sahip başka bir ürün var. Lütfen başka isim giriniz.', 'error');
            return redirect()->back();
        }

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
        $product = Product::find($id) ?? abort(403, 'Böyle bir ürün bulunamadı.');
        $categories = Category::where('isActive', 1)->get();
        $brands = Brand::where('isActive', 1)->get();
        $units = Unit::where('isActive', 1)->get();
        return view('products.edit', compact('product', 'categories', 'brands', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\ProductUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $count = Product::where('id', '!=', $id)
                            ->where('isActive', 1)
                            ->where('name', $request->name)
                            ->where('slug', Str::slug($request->name))
                            ->get()
                            ->count();
        if($count > 0){
            toastr('Aynı isme sahip başka bir ürün var. Lütfen başka isim giriniz.', 'error');
            return redirect()->back();
        }

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
                'imagePath' => $fileNameWithDirectory
            ]);
        } else{
            $productImage = Product::findOrFail($id)->image;
            $request->merge([
                'imagePath' => $productImage
            ]);
        }

        try {
            Product::where('id', $id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'code' => $request->code,
                'categoryId' => $request->categoryId,
                'brandId' => $request->brandId,
                'unitId' => $request->unitId,
                'taxRate' => $request->taxRate,
                'followStock' => $request->followStock,
                'criticStockAlert' => $request->criticStockAlert,
                'buyingPrice' => $request->buyingPrice,
                'sellingPrice' => $request->sellingPrice,
                'description' => $request->description,
                'isActive' => 1,
                'image' => $request->imagePath
            ]);
            toastr('Ürün başarılı bir şekilde güncellendi.', 'success');
            return redirect()->route('urunler.index');
        }
        catch (Exception $e){
            toastr('Ürün güncellenemedi'. $e->getMessage(), 'error');
            return redirect()->route('urunler.index');
        }
    }

    public function delete($id){
        try {
            Product::where('id', $id)->update(['isActive'=>0]);
            toastr('Ürün başarılı bir şekilde silindi', 'success');
            return redirect()->route('urunler.index');
        }catch (Exception $ex){
            toastr('Ürün silinemedi', 'error');
            return redirect()->route('urunler.index');
        }
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
