@extends('layouts.master')
@section('title') Markalar ve Birim Tanımlama @endsection
@section('headerTitle') Markalar ve Birimler @endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Marka
                </div>
                <div class="card-body">
                    @if(count($brands) == 0)
                        <div class="alert alert-warning">
                            Herhangi bir markanız bulunmuyor. Marka eklemek için <span class="font-weight-bold"
                                                                                       role="button" data-toggle="modal"
                                                                                       data-target="#brandModal" >tıklayın</span>.
                        </div>
                    @else
                        <table id="brandTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th style="display: flex; align-items: center; justify-content: space-between;">
                                    Markalar
                                    <span data-toggle="modal" data-target="#brandModal" style="cursor: pointer">
                                        <i class="fas fa-plus-square text-success font-weight-bold"
                                           style="font-size: 20px;"></i>
                                </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td style="display: flex; align-items: center; justify-content: space-between; ">
                                        <span>{{$brand->name}}</span>
                                        <span>
                                        <a class="editBranModalButton" brandId="{{$brand->id}}" action="1">
                                            <i class="fas fa-pen-square text-dark"
                                               role="button" data-toggle="modal"
                                               data-target="#editModal"
                                               style="font-size: 18px;"></i>
                                        </a>
                                        @if($brand->id !== 1)
                                                <a href="{{route('marka.destroy', $brand->id)}}">
                                            <i class="fas fa-times-circle text-danger"
                                               style="font-size: 18px;"></i>
                                        </a>
                                            @endif
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Birim
                </div>
                <div class="card-body">
                    @if(count($units) == 0)
                        <div class="alert alert-warning">
                            Herhangi biriminiz bulunmuyor. Birim eklemek için <span class="font-weight-bold"
                                                                                    role="button" data-toggle="modal"
                                                                                    data-target="#unitModal">tıklayın</span>.
                        </div>
                    @else
                        <table id="unitTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th style="display: flex; align-items: center; justify-content: space-between;">
                                    Birimler
                                    <span data-toggle="modal" data-target="#unitModal"
                                          style="font-size: 20px; cursor: pointer;">
                                    <i class="fas fa-plus-square text-success font-weight-bold"></i>
                                </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($units as $unit)
                                <tr>
                                    <td style="display: flex; align-items: center; justify-content: space-between; ">
                                        {{$unit->name}}
                                        @if($units->count() != 1)
                                        <span>
                                            <a class="editBranModalButton" brandId="{{$unit->id}}" action="0">
                                                <i class="fas fa-pen-square text-dark"
                                                   role="button" data-toggle="modal"
                                                   data-target="#editModal"
                                                   style="font-size: 18px;"></i>
                                            </a>
                                            <a class="deleteUnitModalButton" unitId="{{$unit->id}}" unitName="{{$unit->name}}" productCount="{{$unit->productCount()}}">
                                                <i class="fas fa-times-circle text-danger"
                                                   role="button" data-toggle="modal" data-target="#deleteUnitModal"
                                                   style="font-size: 18px;"></i>
                                            </a>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for brand -->
    <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Marka Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('markalar.store')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="brandModalInput" name="brandName" class="form-control" autofocus/>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" id="brandModalSubmitButton" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for unit -->
    <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Birim Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('birimler.store')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="unitModalInput" name="unitName" class="form-control" focus/>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" id="unitModalFormButton" class="btn btn-primary" disabled>Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for brand edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="get" action="{{route('updateBrandOrUnitName')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="editModalHiddenInput" value="0" />
                            <input type="hidden" name="action" id="actionType" value="0" />
                            <input type="text" id="editModalInput" name="name" class="form-control" focus/>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" id="unitModalFormButton" class="btn btn-primary" disabled>Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Model For Unit Delete -->
    <div class="modal fade" id="deleteUnitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Birim Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="deleteUnitModalText" class="font-weight-bold">Bu</span> birime ait <span id="deleteUnitModalProductCountText" class="font-weight-bold"></span> tane ürün bulunmaktadır. Eğer bu birimi silerseniz
                    ürünlerin hepsi silinecek.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <form method="post" action="{{route('birim.destroy')}}">
                        <input type="hidden" name="unitId" id="unitIdInput">
                        <button type="submit" class="btn btn-primary">Sil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#unitModal').on('shown.bs.modal', function () {
                $('#unitModalInput').focus()
            })

            $('#brandModal').on('shown.bs.modal', function () {
                $('#brandModalInput').focus()
            })

            $('.editBranModalButton').on('click', function () {
                const id = $(this)[0].getAttribute('brandId');
                const action = $(this)[0].getAttribute('action');
                $('#editModalHiddenInput').val(id);
                $('#actionType').val(action);
                $.ajax({
                    type:'GET',
                    url:'getbrandorunitname',
                    data:{id:id, action:action},
                    success:function(data){
                        console.log(data);
                        $('#editModalInput').val(data);
                    }
                });
            })

            $('.deleteUnitModalButton').on('click', function () {
                const unitId = $(this)[0].getAttribute('unitId');
                const unitName = $(this)[0].getAttribute('unitName');
                const productCount = $(this)[0].getAttribute('productCount');
                $('#unitIdInput').text(unitId);
                $('#deleteUnitModalText').text(unitName);
                $('#deleteUnitModalProductCountText').text(productCount);
            })



            $('#editModal').on('shown.bs.modal', function () {
                $('#editModalInput').focus()
            })

            $('#brandModalSubmitButton').prop('disabled', true);
            $('#unitModalFormButton').prop('disabled', true);

            $('input[type="text"]').keyup(function () {
                if ($(this).val().length > 0) {
                    $('#brandModalSubmitButton').prop('disabled', false);
                    $('#unitModalFormButton').prop('disabled', false);
                } else {
                    $('#brandModalSubmitButton').prop('disabled', true);
                    $('#unitModalFormButton').prop('disabled', true);
                }
            });

            $('#brandTable').DataTable({
                "aLengthMenu": [5, 10],
                "iDisplayLength": 10
            });
            $('#unitTable').DataTable({
                "aLengthMenu": [5, 10],
                "iDisplayLength": 10
            });

        });

    </script>
@endsection
