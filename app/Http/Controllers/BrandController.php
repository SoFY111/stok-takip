<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//MODELS
use App\Models\Unit;
use App\Models\Brand;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $brands = Brand::all();
        $units = Unit::all();
        return view('brand.index', compact('units', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $lowerBrandName = Str::lower($request->brandName);

        $brand = Brand::where('name', $lowerBrandName)->get()->count();
        if ($brand > 0) {
            toastr()->error('Aynı isme sahip başka marka bulunmaktadır. Başka marka ismi giriniz.');
            return redirect()->route('markalar.index');
        }
        $brand = new Brand();
        $brand->name = $request->brandName;
        $brand->slug = Str::slug($request->brandName);
        $brand->save();

        toastr()->success('Marka başarılı bir şekilde eklendi.');
        return redirect()->route('markalar.index');
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
        return 'ss';
    }
}
