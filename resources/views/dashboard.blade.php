@extends('layouts.master')
@section('title') Panel @endsection
@section('content')
    <div class="col-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sistem Tarih ve Saati</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{(new \DateTime())->format('d/m/y H:m:s')}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hızlı İşlemler</h6>
            </div>
            <div class="card-body d-flex flex-row align-items-center justify-content-between hover-s">
                <div class="w-5"></div>
                <a href="{{route('urunler.create')}}" class="btn btn-primary btn-icon-split margin-x-sm"><span class="icon text-white"><i class="fab fa-product-hunt"></i></span><span class="text">Ürün Ekle</span></a>
                <a href="{{route('stok.create')}}" class="btn btn-primary btn-icon-split margin-x-sm"><span class="icon text-white"><i class="fas fa-boxes"></i></span><span class="text">Stok Giriş Çıkışı</span></a>
                <a href="{{route('markalar.index')}}" class="btn btn-primary btn-icon-split margin-x-sm"><span class="icon text-white"><i class="fas fa-copyright"></i></span><span class="text">Markalar</span></a>
                <a href="{{route('kategoriler.index')}}" class="btn btn-primary btn-icon-split margin-x-sm"><span class="icon text-white"><i class="fas fa-sitemap"></i></span><span class="text">Kategoriler</span></a>
                <div class="w-5"></div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
        <div class="row hover-s mw-100 mx-sm-0-custom mx-md-0-custom mx-0 mb-4">
            <div class="col-6 col-md-12-custom col-sm-12-custom px-sm-0-custom px-md-0-custom pl-0 pl-sm-0-custom pl-md-0-custom">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Son Eklenen Ürünler</h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center hover-s p-sm-0-custom pb-4">
                        <div class="d-flex flex-row align-items-center justify-content-between w-100 mb-1 header-s d-none-m d-none-mdlg">
                            <span class="text-center" style="width: 5%;">#</span>
                            <span style="width: 35%;">Adı</span>
                            <span class="text-center" style="width: 15%;">Stok Miktarı</span>
                            <span class="text-center" style="width: 15%;">Satış Fiyatı</span>
                            <span class="text-center" style="width: 15%;">Barkod Numarası</span>
                        </div>
                        <div class="p-0 w-100 px-sm-3-custom" id="">
                            @if($products->count() == 0)
                                <div class="alert alert-warning">
                                    <span>Herhangi bir stok hareketiniz bulunmuyor. Eklemek için <a href="{{route('stok.create')}}" class="font-weight-bold"> tıklayınız.</a></span>
                                </div>
                            @endif
                            @foreach($products as $product)
                                <div class="hover-products hover-s d-flex flex-sm-row flex-row align-items-center justify-content-between w-100 mt-2 bg-white p-2 rounded flex-sm-row flex-lg-row flex-md-column">
                                    <span class="text-center hoverItem-s d-none-m w-mdlg-100" style="width: 5%;">
                                        <img src="{{$product->image ? $product->image : asset('images/unknown-pp.png')}}" width="40" height="40" class="rounded image-s">
                                    </span>
                                    <span class="hoverItem-s d-flex align-items-center justify-content-center-sm flex-row flex-column-sm flex-md-column flex-lg-row w-mdlg-100" style="width: 35%;">
                                        <a href="{{route('urunler.show', $product->slug)}}" class="">{{$product->name}}</a>
                                        <span class="rounded-pill ml-2 p-1 px-2 {{hexColorContrast($product->categoryDetails->color) ? 'text-white font-weight-bold' : 'text-gray-900 font-weight-bold'}} text-xs" style="background-color: {{$product->categoryDetails->color}}">{{$product->categoryDetails->name}}</span>
                                    </span>
                                    <span class="text-center hoverItem-s w-mdlg-100" style="width: 15%;" title="@if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'Kritik Stok Uyarısı' : ''}} @endif ">
                                        @if($product->followStock == 1) @if($product->CalcuteStockCount <= $product->criticStockAlert) <small><i class="fas fa-info-circle text-danger"></i></small> @endif @endif
                                        <span class="font-weight-bold @if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'text-danger' : ''}} @endif">{{sprintf("%.2f", $product->CalcuteStockCount)}}</span>
                                        <small class="@if($product->followStock == 1) {{$product->CalcuteStockCount <= $product->criticStockAlert ? 'fw-sm ' : 'text-gray-500'}} @else text-gray-500 @endif ">{{$product->unitDetails->name}}</small>
                                    </span>
                                    <span class="text-center hoverItem-s w-mdlg-100" style="width: 15%;">{{$product->sellingPrice ? $product->sellingPrice. '₺' : 'Belirtilmedi'}}</span>
                                    <span class="text-center hoverItem-s w-mdlg-100" style="width: 15%;">
                                        <?php
                                            echo DNS1D::getBarcodeSVG($product->code, 'EAN13', 1, 40); //EAN13 barCode
                                            ?>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-12-custom col-sm-12-custom px-sm-0-custom px-md-0-custom pr-0 pr-sm-0-custom pr-md-0-custom">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Stok Hareketleri</h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center hover-s p-sm-0-custom px-0">
                        <ul class="nav nav-tabs mb-3 pl-3 w-100 pt-sm-1-custom pl-sm-1-custom pr-sm-1-custom text-center-sm-custom" id="myTab0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab0" data-mdb-toggle="tab" data-mdb-target="#home0" type="button" role="tab" aria-controls="home" aria-selected="true">Gelecek Sevkiyatlar</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab0" data-mdb-toggle="tab" data-mdb-target="#profile0" type="button" role="tab" aria-controls="profile" aria-selected="false">Geçmiş Sevkiyatlar</a>
                            </li>
                        </ul>
                        <div class="tab-content p-3 w-100" id="myTabContent0">
                            <div class="tab-pane fade show active" id="home0" role="tabpanel" aria-labelledby="home-tab0">
                                @if($stocks->upComingStocks->count() == 0)
                                    <div class="alert alert-warning">
                                        <span>Herhangi bir stok hareketiniz bulunmuyor. Eklemek için <a href="{{route('stok.create')}}" class="font-weight-bold"> tıklayınız.</a></span>
                                    </div>
                                @endif
                                <div class="d-flex flex-row justify-content-between w-100 mb-1 header-s">
                                    <span class="text-center" style="width: 5%;">#</span>
                                    <span class="ml-2" style="width: 35%;">Ürün</span>
                                    <span class="text-center" style="width: 15%;">Hareket Yönü</span>
                                    <span class="text-center" style="width: 15%;">Miktar</span>
                                    <span class="text-center" style="width: 15%;">Tarih</span>
                                </div>
                                @foreach($stocks->upComingStocks as $stock)
                                    <x-stock-li-item
                                        inOrOut="{{$stock->inOrOut}}"
                                        stockProductDetailsSlug="{{$stock->productDetails->slug}}"
                                        stockProductDetailsName="{{$stock->productDetails->name}}"
                                        stockSumProductCount="{{$stock->sumProductCount}}"
                                        stockProductUnitDetailsName="{{$stock->productDetails->unitDetails->name}}"
                                        stockSupplier=""
                                        stockDate="{{$stock->date}}"
                                        type="product"></x-stock-li-item>
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="profile0" role="tabpanel" aria-labelledby="profile-tab0">
                                @if($stocks->pastStocks->count() == 0)
                                    <div class="alert alert-warning">
                                        <span>Herhangi bir stok hareketiniz bulunmuyor. Eklemek için <a href="{{route('stok.create')}}" class="font-weight-bold"> tıklayınız.</a></span>
                                    </div>
                                @endif
                                <div class="d-flex flex-row justify-content-between w-100 mb-1 header-s">
                                    <span class="text-center" style="width: 5%;">#</span>
                                    <span class="ml-2" style="width: 35%;">Ürün</span>
                                    <span class="text-center" style="width: 15%;">Hareket Yönü</span>
                                    <span class="text-center" style="width: 15%;">Miktar</span>
                                    <span class="text-center" style="width: 15%;">Tarih</span>
                                </div>
                                @foreach($stocks->pastStocks as $stock)
                                    <x-stock-li-item
                                        inOrOut="{{$stock->inOrOut}}"
                                        stockProductDetailsSlug="{{$stock->productDetails->slug}}"
                                        stockProductDetailsName="{{$stock->productDetails->name}}"
                                        stockSumProductCount="{{$stock->sumProductCount}}"
                                        stockProductUnitDetailsName="{{$stock->productDetails->unitDetails->name}}"
                                        stockSupplier=""
                                        stockDate="{{$stock->date}}"
                                        type="product"></x-stock-li-item>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('back/css/table.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
@endsection
