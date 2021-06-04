@extends('layouts.master')
@section('title') Ürünler @endsection
@section('headerTitle') Ürünler @endsection
@section('content')
    {{--  container  --}}
    <div class="d-flex flex-column ">
        <div class="row mb-4 d-flex flex-row align-items-center justify-content-center">
            <a role="button" class="btn btn-primary mt-1 mb-xs-5">Ürün Ekle</a>
            <div class="p-1 bg-light rounded rounded-pill shadow-sm ml-3 flex-fill">
                <div class="input-group">
                    <form class="input-group">
                        <div class="input-group-prepend">
                            <button id="button-addon2" type="submit" class="btn btn-link text-dark"><i class="fa fa-search"></i></button>
                        </div>
                        <input type="search" placeholder="Ürün adı, kategorisi veya barkod numarası..." aria-describedby="button-addon2" class="form-control border-0 shadow-none bg-light">
                    </form>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column w-100">
                <div class="d-flex flex-row w-100 mb-2">
                    <span class="text-center" style="width: 5%;">#</span>
                    <span style="width: 35%;">Adı</span>
                    <span class="text-center" style="width: 15%;">Stok Miktarı</span>
                    <span class="text-center" style="width: 15%;">Satış Fiyatı</span>
                    <span class="text-center" style="width: 15%;">Barkod Numarası</span>
                    <span class="text-center" style="width: 15%;">İşlemler</span>
                </div>
                @for($i=0;$i<13;$i++)
                    <div class="d-flex flex-row align-items-center justify-content-center w-100 mt-2 bg-white p-2 rounded">
                        <span class="text-center" style="width: 5%;">1</span>
                        <span style="width: 35%;">2</span>
                        <span class="text-center" style="width: 15%;">3</span>
                        <span class="text-center" style="width: 15%;">4</span>
                        <span class="text-center" style="width: 15%;">5</span>
                        <span class="text-center" style="width: 15%;">
                        <a href="" class="btn btn-sm btn-secondary" title="Sonuçlar"><i class="fa fa-info-circle"></i></a>
                        <a href="" class="btn btn-sm btn-primary" title="Güncelle"><i class="fa fa-pen"></i></a>
                        <a href="" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
                    </span>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('back/css/table.css')}}">
@endsection
