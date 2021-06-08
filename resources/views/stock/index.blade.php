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
                        <input type="search" placeholder="Ürün adı, kategorisi veya barkod numarası..." aria-describedby="button-addon2" class="form-control border-0 shadow-none bg-light">
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
                    <div class="hover hover-s d-flex flex-sm-row flex-row align-items-center justify-content-center w-100 mt-2 bg-white p-2 rounded flex-sm-row ">
                        <span class="text-center hoverItem-s d-none-m" style="width: 5%;">
                            @if($stock->inOrOut == 0)
                                <i class='fas fa-truck fa-rotate-180 fa-flip-horizontal bg-gray-300 p-2 rounded' style="font-size: 20px"></i>
                            @else
                                <i class='fas fa-truck bg-gray-300 p-2 rounded' style="font-size: 20px"></i>
                            @endif
                        </span>
                        <span class="hoverItem-s d-flex align-items-center justify-content-center-sm flex-row ml-2" style="width: 35%;">
                            <a href="{{route('urunler.show', $stock->productDetails->slug)}}">{{$stock->productDetails->name}}</a>
                        </span>
                        <span class="text-center hoverItem-s " style="width: 15%;">
                            {{$stock->inOrOut == 0 ? 'Stok Çıkışı' : 'Stok Girişi'}}
                        </span>
                        <span class="text-center hoverItem-s " style="width: 15%;">
                            <span class="font-weight-bold">{{sprintf("%.2f", $stock->sumProductCount)}}</span> <span class="text-gray-500">{{$stock->productDetails->unitDetails->name}}</span>
                        </span>
                        <span class="text-center hoverItem-s " style="width: 15%;">
                            {{$stock->supplier}}
                        </span>
                        <span class="text-center hoverItem-s " style="width: 15%;">
                            <span title="{{date('d/m/Y', strtotime($stock->date))}} {{explode(' ', $stock->date)[1]}}">{{$stock->date ? \Carbon\Carbon::parse($stock->date)->diffForHumans() : 'Belirtilmedi'}}</span>
                        </span>
                    </div>
                @endforeach
                {{$stocks->links()}}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('back/css/table.css')}}">
@endsection
