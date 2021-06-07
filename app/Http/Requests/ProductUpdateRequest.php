<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'code' => 'required|digits:12',
            'categoryId' => 'required',
            'brandId' => 'required',
            'unitId' => 'required',
            'taxRate' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:10000'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Ürün Adı',
            'code' => 'Barkod Numarası',
            'categoryId' => 'Kategori',
            'brandId' => 'Marka',
            'unitId' => 'Birim',
            'taxRate' => 'KDV Oranı',
            'image' => 'Resim'
        ];
    }
}
