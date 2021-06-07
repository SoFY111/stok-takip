@extends('layouts.master')
@section('title') {{$product->name}} @endsection
@section('headerTitle') {{$product->name}} @endsection
@section('content')
    <div class="position-relative">
        <div class="alert alert-danger position-absolute r-0 t-0 z-99999" id="errorBox" style="display: none;">
            <span class="" id="priceWrongRegexText" style="display: none;"><i class="fas fa-exclamation-circle mr-1"></i> Alış veya satış fiyatını yanlış formatta girdiniz</span>
        </div>
    </div>
    <div class="ml-2 position-relative">
        <form method="POST" action="{{route('urunler.update', $product->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="position-absolute r-0 t-0">

            </div>
            @if($errors->any())
                <div class="alert alert-danger w-75">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                        <i class="fas fa-cube"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Ürün Adı (*)</label>
                    </div>
                </div>
                <div class="col-9 d-flex flex-row align-items-center justify-content-between">
                    <div class="ml-5 w-50">
                        <input type="text" name="name" class="form-control" value="{{old('name') ? old('name') : $product->name}}" />
                    </div>
                    <div class="d-flex flex-row align-items-center float-right">
                        <a href="{{route('urunler.index')}}" class="btn btn-secondary" type="submit">Vazgeç</a>
                        <button class="btn btn-primary ml-1" type="submit">Kaydet</button>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-barcode"></i>
                        </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Barkod Numarası(EAN-13)  (*) </label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="code" id="code" maxlength="12" class="form-control" value="{{old('code') ? old('code') : $product->code}}"/>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-sitemap"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Kategorisi  (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control js-example-basic-single" name="categoryId">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{old('categoryId') ? (old('categoryId') == $category->id ? 'selected' : '') : ($product->categoryId == $category->id ? 'selected' : '') }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-copyright"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Marka  (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control js-example-basic-single" name="brandId">
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" {{old('brandId') ? (old('brandId') == $brand->id ? 'selected' : '') : ($product->brandId == $brand->id ? 'selected' : '') }}>{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-tachometer-alt"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Birim  (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control js-example-basic-single" name="unitId">
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}" {{old('unitId') ? (old('unitId') == $unit->id ? 'selected' : '') : ($product->unitId == $unit->id ? 'selected' : '') }}>{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-percent"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">KDV Oranı  (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control" name="taxRate" id="taxRate" aria-describedby="taxRate">
                            <option value="18" {{old('taxRate') ? (old('taxRate') == 18 ? 'selected' : '') : ($product->taxRate == 18 ? 'selected' : '')}}>%18</option>
                            <option value="10" {{old('taxRate') ? (old('taxRate') == 10 ? 'selected' : '') : ($product->taxRate == 10 ? 'selected' : '')}}>%10</option>
                            <option value="8" {{old('taxRate') ? (old('taxRate') == 8 ? 'selected' : '') : ($product->taxRate == 8 ? 'selected' : '')}}>%8</option>
                            <option value="1" {{old('taxRate') ? (old('taxRate') == 1 ? 'selected' : '') : ($product->taxRate == 1 ? 'selected' : '')}}>%1</option>
                            <option value="0" {{old('taxRate') ? (old('taxRate') == 0 ? 'selected' : '') : ($product->taxRate == 0 ? 'selected' : '')}}>%0</option>
                        </select>
                        <small id="taxRate" class="form-text text-muted"><i> <i class="fas fa-info-circle"></i> Eğer KDV yoksa %0 seçilmelidir.</i></small>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                        <i class="fas fa-layer-group"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Stok Takibi Yapılsın mı?</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50 d-flex flex-row align-items-center">
                        <div class="d-flex flex-row align-items-center cursorPointer">
                            <input type="radio" id="followStockYes" name="followStock" value="yes" class="form-check followStockRadioButton cursorPointer" {{old('followStock') ? (old('followStock') == 'yes' ? 'checked' : '') : ($product->followStock == 1 ? 'checked' : '')}} />
                            <label class="mb-0 ml-2 cursorPointer" for="followStockYes">Evet</label>
                        </div>
                        <div class="d-flex flex-row align-items-center ml-2 cursorPointer">
                            <input type="radio" id="followStockNo" name="followStock" value="no" class="form-check followStockRadioButton cursorPointer" {{old('followStock') ? (old('followStock') == 'no' ? 'checked' : '') : ($product->followStock == 0 ? 'checked' : '')}} />
                            <label class="mb-0 ml-2 cursorPointer" for="followStockNo">Hayır</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-bell"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Kritik Stok Uyarısı</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="number" class="form-control" name="criticStockAlert" id="criticStockAlertInput" value="{{old('criticStockAlert') ? old('criticStockAlert') : ($product->criticStockAlert == -1 ? '' : $product->criticStockAlert)}}"/>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-tag"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Alış Fiyatı (₺)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="buyingPrice" id="buyingPrice" class="form-control" value="{{old('buyingPrice') ? old('buyingPrice') : $product->buyingPrice}}"/>
                        <small id="buyingPrice" class="form-text text-muted"><i> <i class="fas fa-money"></i> <span id="buyingPriceSmallText"></span> </i></small>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-tag"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Satış Fiyatı (₺)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="sellingPrice" id="sellingPrice" class="form-control" value="{{old('sellingPrice') ? old('sellingPrice') : $product->sellingPrice}}" />
                        <small id="sellingPrice" class="form-text text-muted"><i> <i class="fas fa-money"></i> <span id="sellingPriceSmallText"></span> </i></small>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-comment"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Açıklama</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" class="form-control" name="description" value="{{old('description') ? old('description') : $product->description}}"/>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-camera"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Resim</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        @if($product->image)
                            <img src='{{asset($product->image)}}' width="150px" height="150px" class="rounded mt-1">
                        @endif
                        <input type="file" name="image" value="{{old('image')}}"/>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="col-12">
                    <small>(*) => doldurulması zorunlu alanlar</small>
                </div>
            </div>


        </form>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('back/css/small-col.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('back/js/jqueryFormatCurrency.js')}}"></script>

    <script>
        $(document).ready(function () {

            const x = {{old('followStock') == 'no' ? 0 : 1}};
            if(x === 0){
                $('#criticStockAlertInput').prop('disabled', true)
            }
            else{
                $('#criticStockAlertInput').prop('disabled', false)

            }

            $('.js-example-basic-single').select2();
            $("#code").ForceNumericOnly();
            $("#sellingPrice").ForceNumericOnly();
            $("#buyingPrice").ForceNumericOnly();

            $('input[type=radio][name=followStock]').change(function() {
                const val = $(this).val()
                if (val === 'yes'){
                    $('#criticStockAlertInput').prop('disabled', false)
                }
                else $('#criticStockAlertInput').prop('disabled', true)
                console.log(val);
            });

            $('#buyingPrice').keyup(function (){
                let price = $(this).val();
                const selectedTaxRate = $('#taxRate').children("option:selected").val();

                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }

                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                const guessSellingPrice = (Number(price) + (Number(price) * Number(selectedTaxRate) / 100)).toFixed(2);


                if(isNaN(guessSellingPrice) ||isNaN(price)){
                    $('#buyingPriceSmallText').text('0₺');
                    $('#sellingPrice').val(0).keyup().focusout();
                    $('#sellingPriceSmallText').text('0₺');
                }else{
                    $('#buyingPriceSmallText').text(money+'₺');
                    $('#sellingPrice').val(guessSellingPrice).keyup().focusout();
                    $('#sellingPriceSmallText').text(guessSellingPrice+'₺');

                }

            }).focusout(function (){
                let price = $(this).val();
                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }
                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

                if(isNaN(price)){
                    $('#buyingPrice').val(0);

                    $('#errorBox').fadeIn().delay(2500).fadeOut();
                    $('#priceWrongRegexText').fadeIn().delay(2500).fadeOut();

                }else{
                    $('#buyingPrice').val(money);
                }
            });

            $('#sellingPrice').keyup(function (){
                let price = $(this).val();

                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }

                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");


                if(isNaN(price)){
                    $('#sellingPriceSmallText').text('0₺');

                }else{
                    $('#sellingPriceSmallText').text(money+'₺');
                }

            }).focusout(function (){
                let price = $(this).val();

                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }

                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

                if(isNaN(price)){
                    $('#sellingPrice').val(0);

                    $('#errorBox').fadeIn().delay(2500).fadeOut();
                    $('#priceWrongRegexText').fadeIn().delay(2500).fadeOut();

                }else{
                    $('#sellingPrice').val(money);
                }

            });

            $('#taxRate').change(function (){
                const buyingPrice = $('#buyingPrice').val();
                const selectedTaxRate = $(this).children("option:selected").val();
                if(buyingPrice){
                    const guesssellingPrice = (Number(buyingPrice) + (Number(buyingPrice) * Number(selectedTaxRate) / 100)).toFixed(2);
                    $('#sellingPrice').val(guesssellingPrice);
                    $('#sellingPriceSmallText').text(guesssellingPrice+'₺');
                }

            });
        })
    </script>
@endsection
