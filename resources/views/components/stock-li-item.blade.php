<div class=" {{$type === 'product' ? 'hover-products' : 'hover' }} hover-s d-flex flex-sm-row flex-row align-items-center {{$stockSupplier === '' ? 'justify-content-between' : 'justify-content-center'}} w-100 mt-2 bg-white p-2 rounded flex-sm-row ">
<span class="text-center hoverItem-s d-none-m" style="width: 5%;">
    @if($inOrOut == 0)
        <i class='fas fa-truck fa-rotate-180 fa-flip-horizontal bg-gray-300 p-2 rounded' style="font-size: 20px"></i>
    @else
        <i class='fas fa-truck bg-gray-300 p-2 rounded' style="font-size: 20px"></i>
    @endif
</span>
<span class="hoverItem-s d-flex align-items-center justify-content-center-sm flex-row ml-2" style="width: 35%;">
    <a @if($stockProductDetailsSlug != null) href="{{route('urunler.show', $stockProductDetailsSlug)}}" @endif>{{$stockProductDetailsName}}</a>
</span>
<span class="text-center hoverItem-s " style="width: 15%;">
    {{$inOrOut == 0 ? 'Stok Çıkışı' : 'Stok Girişi'}}
</span>
<span class="text-center hoverItem-s " style="width: 15%;">
    <span class="font-weight-bold">{{sprintf("%.2f", $stockSumProductCount)}}</span> <span class="text-gray-500">{{$stockProductUnitDetailsName}}</span>
</span>
@if($stockSupplier !== "")
    <span class="text-center hoverItem-s " style="width: 15%;">
        {{$stockSupplier}}
    </span>
@endif
<span class="text-center hoverItem-s " style="width: 15%;">
    <span title="{{date('d/m/Y', strtotime($stockDate))}} {{explode(' ', $stockDate)[1]}}">{{$stockDate ? \Carbon\Carbon::parse($stockDate)->diffForHumans() : 'Belirtilmedi'}}</span>
</span>
</div>

