@extends('layouts.master')
@section('title') Stok Giriş Çıkışı @endsection
@section('headerTitle') Ürün Ekle @endsection
@section('content')
    <div class="position-relative">
        <div class="alert alert-danger position-absolute r-0 t-0 z-99999" id="errorBox" style="display: none;">
            <span class="" id="priceWrongRegexText" style="display: none;"><i class="fas fa-exclamation-circle mr-1"></i> Miktar formatını yanlış girdiniz.</span>
        </div>
    </div>
    <div class="ml-2 position-relative">
        <form method="POST" action="{{route('stok.store')}}" enctype="multipart/form-data">
            @csrf
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
                        <i class="fas fa-layer-group"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Stok Girişi mi Stok Çıkışı mı? (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50 d-flex flex-row align-items-center">
                        <div class="d-flex flex-row align-items-center cursorPointer">
                            <input type="radio" id="inOrOutIn" name="inOrOut" value="in" class="form-check followStockRadioButton cursorPointer"  {{old('followStock') == 'in' ? 'checked' : ''}}/>
                            <label class="mb-0 ml-2 cursorPointer" for="inOrOutIn">Giriş</label>
                        </div>
                        <div class="d-flex flex-row align-items-center ml-2 cursorPointer">
                            <input type="radio" id="inOrOutOut" name="inOrOut" value="out" class="form-check followStockRadioButton cursorPointer" {{old('followStock') == 'out' ? 'checked' : '' }} />
                            <label class="mb-0 ml-2 cursorPointer" for="inOrOutOut">Çıkış</label>
                        </div>
                    </div>
                </div>
            </div>

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
                <div class="col-9 d-flex flex-row align-items-center justify-content-between">
                    <div class="ml-5 w-50">
                        <input type="text" class="form-control" name="description" value="{{old('description')}}"/>
                    </div>
                    <div class="d-flex flex-row align-items-center float-right">
                        <a href="{{url()->previous()}}" class="btn btn-secondary" type="submit">Vazgeç</a>
                        <button class="btn btn-primary ml-1" type="submit">Kaydet</button>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-building"></i>
                        </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Tedarikçi </label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="supplier" id="supplier" class="form-control" value="{{old('supplier')}}"/>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-map-marker"></i>
                        </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Adres </label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <textarea name="adress" id="adress" class="form-control">{{old('adress')}}</textarea>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                            <i class="fas fa-bell"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Tarih (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="datetime-local" class="form-control" name="date" id="date"  value="{{old('date') ? old('date') : explode('+', date('c', strtotime((new \DateTime())->format('Y-m-d H:i'))))[0]}}"/>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">Ürün (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control js-example-basic-single productId select2-selection" id="productId" name="productId">
                            @foreach($products as $product)
                                <option value="{{$product->id}}" {{old('productId') == $product->id ? 'selected' : ''}} picturePath="{{asset($product->image)}}">{{$product->code}} - {{$product->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                        <i class="fas fa-sort-numeric-down"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Miktar (*)</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{old('quantity')}}"/>
                        <small id="quantity" class="form-text text-muted"><i> <i class="fas fa-money"></i> <span id="quantityeSmallText"></span> </i></small>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">Birim</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="unit" id="unit" class="form-control" value="{{old('unit')}}" readonly />
                        <small id="unit" class="form-text text-muted"><i> <i class="fas fa-money"></i> <span id="unitSmallText"></span> </i></small>
                    </div>
                </div>
            </div>

            <hr>

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
    <link rel="stylesheet" href="{{asset('back/css/manualSelect2.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('back/js/jqueryFormatCurrency.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#quantity").ForceNumericOnly();
            getProductUnitName($('.js-example-basic-single').prop("selectedIndex", 0).val());

            const x = {{old('followStock') == 'no' ? 0 : 1}};
            if(x === 0){
                $('#criticStockAlertInput').prop('disabled', true)
            }
            else{
                $('#criticStockAlertInput').prop('disabled', false)

            }
            $(".js-example-basic-single").select2({
                templateResult: function (idioma) {
                    const picturePath = $(idioma.element).attr('picturePath');
                    if (picturePath == '{{URL::to('/')}}/') {
                        var $span = $("<span><img src='{{asset('images/unknown-pp.png')}}' class='rounded' width='50px' height='50px'/> " + idioma.text + "</span>");
                    }else var $span = $("<span><img src='" + picturePath + "' class='rounded' width='50px' height='50px'/> " + idioma.text + "</span>");

                    return $span;
                },
                templateSelection: function (idioma) {
                    const picturePath = $(idioma.element).attr('picturePath');
                    if (picturePath == '{{URL::to('/')}}/') {
                        var $span = $("<span><img src='{{asset('images/unknown-pp.png')}}' class='rounded img-flag' width='50px' height='50px' /> " + idioma.text + "</span>");
                    }else var $span = $("<span><img src='" + picturePath + "' class='rounded' width='50px' height='50px'/> " + idioma.text + "</span>");

                    return $span;
                }
            });

            $('.js-example-basic-single').change(function (){
                const selectedProductId = $(this).val();
                getProductUnitName(selectedProductId);

            });

            $('#quantity').keyup(function (){
                let price = $(this).val();

                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }
                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                if(isNaN(price)){
                    $('#quantityeSmallText').text('0');
                }else{
                    $('#quantityeSmallText').text(money);

                }

            }).focusout(function (){
                let price = $(this).val();
                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }
                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

                if(isNaN(price)){
                    $('#quantity').val(0);

                    $('#errorBox').fadeIn().delay(2500).fadeOut();
                    $('#priceWrongRegexText').fadeIn().delay(2500).fadeOut();

                }else{
                    $('#quantity').val(money);
                }
            });
        })

        function getProductUnitName(id){
            // const selectedProductId = $(this).val();

            $.ajax({
                url:'getproductunit/'+id,
                type:'GET',
                data:{},
                success:function (data){
                    $('#unit').val(data);
                }
            });
        }
    </script>
@endsection
