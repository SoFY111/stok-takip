@extends('layouts.master')
@section('title') Ürünler @endsection
@section('headerTitle') Ürünler @endsection
@section('content')
    {{--  container  --}}
    <div class="d-flex flex-column ">
        <div class="row mb-4 d-flex flex-row align-items-center justify-content-center">
            <a href="{{route('urunler.create')}}" role="button" class="btn btn-primary mt-1 mb-xs-5 marginBottom-s-1">Ürün Ekle</a>
            <div class="p-1 bg-light rounded rounded-pill shadow-sm ml-3 flex-fill">
                <div class="input-group">
                    <form class="input-group">
                        <div class="input-group-prepend">
                            <button id="button-addon2" type="submit" class="btn btn-link text-dark"><i class="fa fa-search"></i></button>
                        </div>
                        <form method="GET" action="">
                            <input type="search" name="filterSearch" placeholder="Ürün adı, açıklaması, kategorisi veya barkod numarası..." aria-describedby="button-addon2" class="form-control border-0 shadow-none bg-light">
                        </form>
                    </form>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column w-100">
                @if(!request()->get('filterSearch') && $products->count() == 0)
                    <div class="alert alert-warning">
                        <span>Herhangi bir ürününüz bulunmuyor. Eklemek için <a href="{{route('urunler.create')}}" class="font-weight-bold"> tıklayınız.</a></span>
                    </div>
                @elseif(request()->get('filterSearch') && $products->count() == 0)
                    <div class="alert alert-warning">
                        <span>Aradığınız kriterlere uygun ürün bulunmamaktadır. Eklemek için <a href="{{route('urunler.create')}}" class="font-weight-bold"> tıklayınız.</a></span>
                    </div>
                @endif
                <div class="d-flex flex-row w-100 mb-1 header-s">
                    <span class="text-center" style="width: 5%;">#</span>
                    <span style="width: 35%;">Adı</span>
                    <span class="text-center" style="width: 15%;">Stok Miktarı</span>
                    <span class="text-center" style="width: 15%;">Satış Fiyatı</span>
                    <span class="text-center" style="width: 15%;">Barkod Numarası</span>
                    <span class="text-center" style="width: 15%;">İşlemler</span>
                </div>
                @foreach($products as $product)
                    <div class="hover hover-s d-flex flex-sm-row flex-row align-items-center justify-content-center w-100 mt-2 bg-white p-2 rounded flex-sm-row ">
                        <span class="text-center hoverItem-s d-none-m" style="width: 5%;">
                            <img src="{{$product->image ? $product->image : asset('images/unknown-pp.png')}}" width="40" height="40" class="rounded image-s">
                        </span>
                        <span class="hoverItem-s d-flex align-items-center justify-content-center-sm flex-row flex-column-sm" style="width: 35%;">
                            <a href="{{route('urunler.show', $product->slug)}}" class="">{{$product->name}}</a>
                            <span class="rounded-pill ml-2 p-1 px-2 {{hexColorContrast($product->categoryDetails->color) ? 'text-white font-weight-bold' : 'text-gray-900 font-weight-bold'}} text-xs" style="background-color: {{$product->categoryDetails->color}}">{{$product->categoryDetails->name}}</span>
                        </span>
                        <span class="text-center hoverItem-s" style="width: 15%;" title="@if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'Kritik Stok Uyarısı' : ''}} @endif ">
                            @if($product->followStock == 1) @if($product->CalcuteStockCount <= $product->criticStockAlert) <small><i class="fas fa-info-circle text-danger"></i></small> @endif @endif
                            <span class="font-weight-bold @if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'text-danger' : ''}} @endif">{{sprintf("%.2f", $product->CalcuteStockCount)}}</span>
                            <small class="@if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'fw-sm ' : 'text-gray-500'}} @else text-gray-500 @endif ">{{$product->unitDetails->name}}</small>
                        </span>
                        <span class="text-center hoverItem-s" style="width: 15%;">{{$product->sellingPrice ? $product->sellingPrice. '₺' : 'Belirtilmedi'}}</span>
                        <span class="text-center hoverItem-s" style="width: 15%;">
                            <?php
                                echo DNS1D::getBarcodeSVG($product->code, 'EAN13', 1, 40); //EAN13 barCode
                            ?></span>
                        <span class="text-center hoverItem-s buttons-s" style="width: 15%;">
                            <a href="{{route('urunler.edit', $product->id)}}" class="btn btn-sm btn-primary" title="Güncelle"><i class="fa fa-pen"></i></a>
                            <a href="{{route('urunler.delete', $product->id)}}" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
                        </span>
                    </div>
                @endforeach
                {{$products->withQueryString()->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('back/css/table.css')}}">
@endsection
