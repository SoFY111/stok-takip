@extends('layouts.master')
@section('title') {{$product->name}} @endsection
@section('content')
    <div class="w-100 bg-white rounded">
        <div class="mx-4 pt-3 d-flex flex-row align-items-center justify-content-between hover-s">
            <div class="h2">
                <i class="fas fa-cube bg-gray-300 p-2 rounded-pill" ></i>
                <span class="ml-2">{{$product->name}}</span>
            </div>
            <div class="h4">
                <a href="{{route('urunler.edit', $product->id)}}">
                    <i class="fas fa-pen p-2 rounded bg-primary text-white" role="button"></i>
                </a>
            </div>
        </div>
        <hr>
        <div class="header d-flex flex-row hover-s align-items-center px-3">
            <div class="d-flex flex-row hover-s align-items-center flex-fill text-center">
                <div class="p-1 flex-fill">
                    <small>Alış</small>
                    <span class="fs-20">{{$product->buyingPrice}}₺</span>
                </div>
                <div class="p-1 flex-fill">
                    <small>Satış</small>
                    <span class="fs-20" title="Satış Fiyatı">{{$product->sellingPrice}}₺</span>
                </div>
                <div class="p-1 flex-fill">
                    <small title="KDV Oranı"><i class="fas fa-gavel"></i></small>
                    <span class="fs-20">%{{$product->taxRate}}</span>
                </div>
                <div class="p-1 flex-fill" title="Stok Miktarı">
                    @if($product->followStock == 1)
                        @if($product->CalcuteStockCount <= $product->criticStockAlert)
                            <small><i class="fas fa-info-circle text-danger"></i></small>
                        @else
                            <small><i class="fas fa-layer-group"></i></small>
                        @endif
                    @else
                        <small><i class="fas fa-layer-group"></i></small>
                    @endif
                    <span class="fs-20 @if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'text-danger font-weight-bold' : ''}} @endif">{{sprintf("%.2f", $product->CalcuteStockCount)}}</span>
                    <span class="@if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'fw-sm ' : 'text-gray-500'}} @else text-gray-500 @endif">{{$product->unitDetails->name}}</span>
                </div>
                @if($product->buyingPrice AND $product->sellingPrice)
                    <div class="p-1 flex-fill @if($product->ProfitAndLoss > 0) text-success @elseif($product->ProfitAndLoss < 0) text-danger @elseif($product->ProfitAndLoss === 0) 'text-warning' @endif">
                        <small title="Kâr"><i class="fas fa-chart-line"></i></small>
                        <span class="fs-20">{{$product->ProfitAndLoss}}₺</span>
                    </div>
                @endif
            </div>
            <div class="w-25"></div>
            <div class="">
                <?php
                    echo DNS1D::getBarcodeSVG($product->code, 'EAN13', 1, 40); //EAN13 barCode
                ?>
            </div>
            <div class="w-5"></div>
        </div>
        <div class="body mt-4">
            <ul class="nav nav-tabs mb-3 pl-3" id="myTab0" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab0" data-mdb-toggle="tab" data-mdb-target="#home0" type="button" role="tab" aria-controls="home" aria-selected="true">Stok Geçmişi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab0" data-mdb-toggle="tab" data-mdb-target="#profile0" type="button" role="tab" aria-controls="profile" aria-selected="false">Stok Girişleri</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab0" data-mdb-toggle="tab" data-mdb-target="#contact0" type="button" role="tab" aria-controls="contact" aria-selected="false">Stok Çıkışları</a>
                </li>
            </ul>
            <div class="tab-content p-3" id="myTabContent0">
                <div class="tab-pane fade show active" id="home0" role="tabpanel" aria-labelledby="home-tab0">
                    <x-stock-mobility type="all" productId="{{$product->id}}"></x-stock-mobility>
                </div>
                <div class="tab-pane fade" id="profile0" role="tabpanel" aria-labelledby="profile-tab0">
                    <x-stock-mobility type="in" productId="{{$product->id}}"></x-stock-mobility>
                </div>
                <div class="tab-pane fade" id="contact0" role="tabpanel" aria-labelledby="contact-tab0">
                    <x-stock-mobility type="out" productId="{{$product->id}}"></x-stock-mobility>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('back/css/small-col.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
@endsection
