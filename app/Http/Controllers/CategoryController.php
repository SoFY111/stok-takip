<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//MODELS
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::where('isActive', 1)->orderBy('id')->get();
        return view('categories.index', compact('categories'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $lowerCategoryName = Str::lower($request->name);

        $category = Category::where('isActive', 1)->where('name', $lowerCategoryName)->get()->count();
        if ($category > 0) {
            toastr()->error('Aynı isme sahip başka kategori bulunmaktadır. Başka kategori ismi giriniz.');
            return redirect()->back();
        }

        try {
            $sluggedName = Str::slug($request->name);
            while($category == 1){
                $category = Category::where('isActive', 1)->where('slug', $sluggedName)->get()->count();
                $sluggedName .= rand(0, 10);
            }

            Category::insert([
                'name' => $request->name,
                'slug' => $sluggedName
            ]);
            toastr('Kategori başarılı bir şekilde eklendi.', 'success');
            return redirect()->back();
        } catch (Exception $ex) {
            toastr('Kategori eklenmedi. Error Code: 103', 'error');
            return redirect()->back();
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

    public function delete($id){
        try {
            Category::where('id' ,$id)->update(['isActive' => 0]);
            toastr('Kategori başarılı bir şekilde silindi.');
            return redirect()->back();
        }catch (Exception $ex){
            toastr('Kategori silinemedi. Error code: 103');
            return redirect()->back();
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

    public function getCategoryName(Request $request){
        $category = Category::whereId($request->id) ?? abort(403, 'Böyle bir kategori yok');
        return response()->json($category->name);
    }

    public function updateCategoryName(Request $request){

        try {

            $lowerCategoryName = Str::lower($request->name);

            $category = Category::where('isActive', 1)->where('name', $lowerCategoryName)->get()->count();
            if ($category > 0) {
                toastr()->error('Aynı isme sahip başka kategori bulunmaktadır. Başka kategori ismi giriniz.');
                return redirect()->route('kategoriler.index');
            }

            Category::whereId($request->id)->update(['name' => $request->name]);
            toastr()->success('Kategori başarılı bir şekilde güncellendi.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error('Kategori güncellenemedi');
            return redirect()->back();
        }
    }
}
