@extends('layouts.master')
@section('title') Marka Tanımlama @endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Marka
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                                        <a href="{{route('markalar.destroy', $brand->id)}}">
                                            <i class="fas fa-times-circle text-danger"
                                               style="font-size: 18px;"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Birim
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                                    <span>
                                        <a href="{{route('birimler.destroy', $unit->id)}}">
                                            <i class="fas fa-times-circle text-danger"
                                                style="font-size: 18px;"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                    <button type="submit" class="btn btn-primary">Kaydet</button>
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
@endsection

@section('js')
    <script>
        $('#unitModal').on('shown.bs.modal', function () {
            $('#unitModalInput').focus()
        })

        $('#brandModal').on('shown.bs.modal', function () {
            $('#brandModalInput').focus()
        })

        $(document).ready(function () {
            $(':input[type="submit"]').prop('disabled', true);
            $('input[type="text"]').keyup(function () {
                if ($(this).val().length > 0) {
                    $(':input[type="submit"]').prop('disabled', false);
                } else $(':input[type="submit"]').prop('disabled', true);
            });
        });

        $('#unitModalFormButton').on
    </script>
@endsection
