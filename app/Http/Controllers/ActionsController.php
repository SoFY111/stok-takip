<?php
//bazı tek fonksiyonlar için
namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

//MODELS

class ActionsController extends Controller
{
    public function brandDestroy($id)
    {
        if ($id == 1){
            toastr('"Markasız" markası silinemez.', 'warning');
            return redirect()->back();
        }
        try {
            Brand::where('isActive', 1)->where('id', $id)->update(['isActive'=> 0]) ?? abort(403, 'Böyle bir marka bulunamadı.');
            toastr()->success('Marka başarılı bir şekilde silindi.');
            return redirect()->back();
        } catch (Exception $ex) {
            toastr('Marka silinemedi. Code:102', 'error');
            return redirect()->back();
        }
    }

    public function unitDestroy($id)
    {
        $unitCount = Unit::where('isActive', 1)->count();
        if ($unitCount == 1){
            toastr('En az 1 adet birim bulunmak zorundadır.', 'warning');
            return redirect()->back();
        }
        try {
            Unit::where('isActive', 1)->where('id', $id)->update(['isActive'=> 0]) ?? abort(403, 'Böyle bir birim bulunamadı.');
            toastr()->success('Birim başarılı bir şekilde silindi.');
            return redirect()->back();
        } catch (Exception $ex) {
            toastr()->error('Birim silinemedi. Code:102');
            return redirect()->back();
        }
    }

    public function getBrandOrUnitName(Request $request)
    {
        if ($request->action == "1") {
            $brand = Brand::findOrFail($request->id) ?? abort(403, 'Böyle bir marka yok');
            return response()->json($brand->name);

        }
        $unit = Unit::findOrFail($request->id) ?? abort(403, 'Böyle bir birim yok');
        return response()->json($unit->name);
    }

    public function updateBrandOrUnitName(Request $request)
    {
        if ($request->action == "1") {
            try {
                Brand::findOrFail($request->id)->update(['name'=>$request->name]);
                toastr()->success('Marka başarılı bir şekilde güncellendi.');
                return redirect()->back();
            } catch (Exception $e) {
                toastr()->error('Marka güncellenemedi');
                return redirect()->back();
            }
        }
        try {
            Unit::findOrFail($request->id)->update(['name' => $request->name]);
            toastr()->success('Birim başarılı bir şekilde güncellendi.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error('Birim güncellenemedi');
            return redirect()->back();
        }
    }
}
