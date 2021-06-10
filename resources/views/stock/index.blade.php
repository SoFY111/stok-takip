@extends('layouts.master')
@section('title') Stok Takip @endsection
@section('headerTitle') Stok Takip @endsection
@section('content')
    {{--  container  --}}
    <div class="d-flex flex-column ">
        <div class="row mb-4 d-flex flex-row align-items-center justify-content-center">
            <div class="p-1 bg-light rounded rounded-pill shadow-sm ml-3 flex-fill">
                <div class="input-group">
                    <form class="input-group">
                        <div class="input-group-prepend">
                            <button id="button-addon2" type="submit" class="btn btn-link text-dark"><i class="fa fa-search"></i></button>
                        </div>
                        <form method="GET" action="">
                            <input type="search" name="filterSearch" placeholder="Ürün adı, hareket yönü, miktar, tedarikçi veya tarih..." aria-describedby="button-addon2" class="form-control border-0 shadow-none bg-light">
                        </form>
                    </form>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column w-100">
                @if($stocks->count() == 0)
                    <div class="alert alert-warning">
                        <span>Herhangi bir stok hareketiniz bulunmuyor. Eklemek için <a href="{{route('stok.create')}}" class="font-weight-bold"> tıklayınız.</a></span>
                    </div>
                @endif
                <div class="d-flex flex-row w-100 mb-1 header-s">
                    <span class="text-center" style="width: 5%;">#</span>
                    <span class="ml-2" style="width: 35%;">Ürün</span>
                    <span class="text-center" style="width: 15%;">Hareket Yönü</span>
                    <span class="text-center" style="width: 15%;">Miktar</span>
                    <span class="text-center" style="width: 15%;">Tedarikçi/Müşteri</span>
                    <span class="text-center" style="width: 15%;">Tarih</span>
                </div>
                @foreach($stocks as $stock)
                    <x-stock-li-item
                            inOrOut="{{$stock->inOrOut}}"
                            stockDate="{{$stock->date}}"
                            stockProductDetailsName="{{$stock->productDetails->name}}"
                            stockProductDetailsSlug="{{$stock->productDetails->slug}}"
                            stockProductUnitDetailsName="{{$stock->productDetails->unitDetails->name}}"
                            stockSumProductCount="{{$stock->sumProductCount}}"
                            stockSupplier="{{$stock->supplier}}"></x-stock-li-item>
                @endforeach
                <div class="mt-1 pt-1">
                    {{$stocks->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('back/css/table.css')}}">
@endsection
