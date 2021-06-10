<div>
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
            @if($type == 'all')
                <div class="allStock" id="allStock">
                    @foreach($stocks as $stock)
                        <x-stock-li-item
                            inOrOut="{{$stock->inOrOut}}"
                            stockProductDetailsSlug=""
                            stockProductDetailsName="{{$stock->productDetails->name}}"
                            stockSumProductCount="{{$stock->sumProductCount}}"
                            stockProductUnitDetailsName="{{$stock->productDetails->unitDetails->name}}"
                            stockSupplier="{{$stock->supplier}}"
                            stockDate="{{$stock->date}}"
                            type="product"></x-stock-li-item>
                    @endforeach
                </div>
                <div class="allStockPaginate">
                    {{$stocks->links('pagination::bootstrap-4')}}
                </div>
            @elseif($type === 'in')
                <div class="inStock">
                    @foreach($stocks as $stock)
                        <x-stock-li-item
                            inOrOut="{{$stock->inOrOut}}"
                            stockProductDetailsSlug=""
                            stockProductDetailsName="{{$stock->productDetails->name}}"
                            stockSumProductCount="{{$stock->sumProductCount}}"
                            stockProductUnitDetailsName="{{$stock->productDetails->unitDetails->name}}"
                            stockSupplier="{{$stock->supplier}}"
                            stockDate="{{$stock->date}}"
                            type="product"></x-stock-li-item>
                    @endforeach
                </div>
                <div class="inStockPaginate">
                    {{$stocks->links('pagination::bootstrap-4')}}
                </div>
            @else
                <div class="outStock">
                    @foreach($stocks as $stock)
                        <x-stock-li-item
                            inOrOut="{{$stock->inOrOut}}"
                            stockProductDetailsSlug=""
                            stockProductDetailsName="{{$stock->productDetails->name}}"
                            stockSumProductCount="{{$stock->sumProductCount}}"
                            stockProductUnitDetailsName="{{$stock->productDetails->unitDetails->name}}"
                            stockSupplier="{{$stock->supplier}}"
                            stockDate="{{$stock->date}}"
                            type="product"></x-stock-li-item>
                    @endforeach
                </div>
                <div class="outStockPaginate">
                    {{$stocks->links('pagination::bootstrap-4')}}
                </div>
            @endif
        </div>
    </div>
</div>

@section('componentCss')
    <link rel="stylesheet" href="{{asset('back/css/table.css')}}">
@endsection

@section('componentJs')
    <script type="text/javascript">
        $(document).ready(function (){
            $('.allStockPaginate').on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href'),
                    page = url.split('page=')[1],
                    data = $('#search').serializeArray();
                data.push({page: page}); // Add page variable to post data

                $.ajax({
                    type:'get',
                    url: '{{route('stok.getinstocktransactions', [$productId, 'all'])}}',
                    data: {page: page},
                    dataType: 'json',
                    success:function(res){
                        $('.allStock').html($(res).find('.allStock'));
                        $('.allStockPaginate').html($(res).find('.allStockPaginate'));
                    }
                });
            });

            $('.inStockPaginate').on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href'),
                    page = url.split('page=')[1],
                    data = $('#search').serializeArray();
                data.push({page: page}); // Add page variable to post data

                $.ajax({
                    type:'get',
                    url: '{{route('stok.getinstocktransactions', [$productId, 'in'])}}',
                    data: {page: page},
                    dataType: 'json',
                    success:function(res){
                        $('.inStock').html($(res).find('.inStock'));
                        $('.inStockPaginate').html($(res).find('.inStockPaginate'));
                    }
                });
            });
            $('.outStockPaginate').on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href'),
                    page = url.split('page=')[1],
                    data = $('#search').serializeArray();
                data.push({page: page}); // Add page variable to post data

                $.ajax({
                    type:'get',
                    url: '{{route('stok.getinstocktransactions', [$productId, 'in'])}}',
                    data: {page: page},
                    dataType: 'JSON',
                    success:function(res){
                        $('.outStock').html($(res).find('.outStockPaginate'));
                        $('.outStockPaginate').html($(res).find('.outStockPaginate'));
                    }
                });
            });
        });
    </script>
@endsection
