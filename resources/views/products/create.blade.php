@extends('layouts.master')
@section('title') Ürün Ekle @endsection
@section('headerTitle') Ürün Ekle @endsection
@section('content')
    <div class="ml-2">
        <form>
            @csrf
            <div class="form-group d-flex flex-row align-items-center">
                <div class="sm-col-custom-1 ml-sm-1">
                    <span class="h2 mb-0 d-flex align-items-center">
                        <i class="fas fa-cube"></i>
                    </span>
                </div>
                <div class="col-2">
                    <div class="d-flex flex-row align-items-center">
                        <label class="h6 ml-2 mb-0 ml-s-2">Ürün Adı</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="name" class="form-control"/>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">Barkod Numarası</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <input type="text" name="code" class="form-control"/>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">Kategorisi</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control">
                            <option value="">Opt1</option>
                            <option value="">Opt2</option>
                            <option value="">Opt3</option>
                            <option value="">Opt4</option>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">Marka</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control">
                            <option value="">Opt1</option>
                            <option value="">Opt2</option>
                            <option value="">Opt3</option>
                            <option value="">Opt4</option>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">Birim</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control">
                            <option value="">Opt1</option>
                            <option value="">Opt2</option>
                            <option value="">Opt3</option>
                            <option value="">Opt4</option>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">KDV Oranı</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50">
                        <select class="form-control" name="taxRate" id="taxRate" aria-describedby="taxRate">
                            <option value="18">%18</option>
                            <option value="10">%10</option>
                            <option value="8">%8</option>
                            <option value="1">%1</option>
                            <option value="0">%0</option>
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
                        <label class="h6 ml-2 mb-0 ml-s-2">Stok Takibi Yapılsın mı? </label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="ml-5 w-50 d-flex flex-row align-items-center">
                        <div class="d-flex flex-row align-items-center cursorPointer">
                            <input type="radio" id="followStockYes" name="followStock" value="yes" class="form-check followStockRadioButton cursorPointer"/>
                            <label class="mb-0 ml-2 cursorPointer" for="followStockYes">Evet</label>
                        </div>
                        <div class="d-flex flex-row align-items-center ml-2 cursorPointer">
                            <input type="radio" id="followStockNo" name="followStock" value="no" class="form-check followStockRadioButton cursorPointer" checked/>
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
                        <input type="number" class="form-control" id="criticStockAlertInput" disabled/>
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
                        <input type="number" name="buyingPrice" id="buyingPrice" class="form-control" />
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
                        <input type="number" name="salesPrice" id="salesPrice" class="form-control" />
                        <small id="salesPrice" class="form-text text-muted"><i> <i class="fas fa-money"></i> <span id="salesPriceSmallText"></span> </i></small>
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
                        <input type="text" class="form-control" />
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
                        <input type="file" name=""/>
                    </div>
                </div>
            </div>


        </form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('back/css/small-col.css')}}">
@endsection

@section('js')

    <script src="{{asset('back/js/jqueryFormatCurrency.js')}}"></script>

    <script>
        $(document).ready(function () {
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

                $('#buyingPriceSmallText').text(money+'₺');

                const guessSalesPrice = (Number(price) + (Number(price) * Number(selectedTaxRate) / 100)).toFixed(2);
                $('#salesPrice').val(guessSalesPrice);
                $('#salesPriceSmallText').text(guessSalesPrice+'₺');

            }).focusout(function (){
                let price = $(this).val();
                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }
                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                $('#buyingPrice').val(money);
            });
            
            $('#salesPrice').keyup(function (){
                let price = $(this).val();

                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }

                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                $('#salesPriceSmallText').text(money+'₺');
            }).focusout(function (){
                let price = $(this).val();

                if(price.lastIndexOf(',') != -1){
                    const index = price.lastIndexOf(',');
                    price = price.substring(0, index) + '.' + price.substring(index + 1);
                }

                const money = Number(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                $('#salesPrice').val(money);
            });

            $('#taxRate').change(function (){
                const buyingPrice = $('#buyingPrice').val();
                const selectedTaxRate = $(this).children("option:selected").val();
                if(buyingPrice){
                    const guessSalesPrice = (Number(buyingPrice) + (Number(buyingPrice) * Number(selectedTaxRate) / 100)).toFixed(2);
                    $('#salesPrice').val(guessSalesPrice);
                    $('#salesPriceSmallText').text(guessSalesPrice+'₺');
                }

            });
        })
    </script>
@endsection
