<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

//MODELS

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('unit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $lowerUnitName = Str::lower($request->unitName);
        $unit = Unit::where('name', $lowerUnitName)->get()->count();
        if ($unit > 0) {
            toastr()->error('Aynı isme sahip başka birim bulunmaktadır. Başka birim ismi giriniz.');
            return redirect()->route('markalar.index');
        }
        $unit = new Unit();
        $unit->name = $request->unitName;
        $unit->save();

        toastr()->success('Birim başarılı bir şekilde eklendi.');
        return redirect()->route('markalar.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function ajaxStore(Request $request)
    {
        $lowerUnitName = Str::lower($request->unitName);
        $unit = Unit::where('name', $lowerUnitName)->where('isActive', 1)->get()->count();

        if ($unit > 0) return response()->json(['type' => 0, 'message'=>'Aynı isme sahip başka birim bulunmaktadır. Başka birim ismi giriniz.', 'lastId' => null, 'unitName' => null]);

        $unit = new Unit();
        $unit->name = $request->unitName;
        $unit->save();

        $lastId = Unit::where('isActive', 1)->orderByDesc('id')->limit(1)->pluck('id');
        return response()->json(['type' => 1, 'message'=>'Birim başarılı bir şekilde eklendi.', 'lastId' => $lastId, 'unitName' => $request->unitName]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
