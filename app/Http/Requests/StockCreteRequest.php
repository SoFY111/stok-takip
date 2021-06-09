<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StockCreteRequest extends FormRequest
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
            'inOrOut' => 'required',
            'productId' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'inOrOut' => 'Stok Yöntemi',
            'supplier'=>'Tedarikçi',
            'adress' => 'Adres',
            'date' => 'Tarih',
            'transactionDate' => 'Tarih',
            'productId' => 'Ürün',
            'quantity' => 'Miktar',
        ];
    }

}
