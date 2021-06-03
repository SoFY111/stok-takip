@extends('layouts.master')
@section('title') Kategoriler @endsection
@section('headerTitle') Kategoriler @endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('kategoriler.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($categories->count() == 0)
                            <div class="alert alert-primary">Herhangi bir kategoriniz yok.</div>
                        @else
                            <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Kategori Adı</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><span style="display:none;">0</span> Kategori Yok</td>
                                </tr>
                                @foreach($categories as $category)
                                    @if($category->name != "Kategori Yok")
                                        <tr>
                                            <td style="display: flex; justify-content: space-between;align-items: center;">
                                                <span>{{$category->name}}</span>
                                                <span>
                                                        <a class="editBranModalButton" categoryId="{{$category->id}}">
                                                            <i class="fas fa-pen-square text-dark"
                                                               role="button" data-toggle="modal"
                                                               data-target="#editModal"
                                                               style="font-size: 18px;"></i>
                                                        </a>
                                                        <a href="{{route('kategoriler.delete', $category->id)}}">
                                                            <i class="fas fa-times-circle text-danger"
                                                               style="font-size: 18px;"></i>
                                                        </a>
                                                    </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
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
                    <form method="post" action="{{route('kategoriler.update')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="editModalHiddenInput" value="0"/>
                            <input type="text" id="editModalInput" name="name" class="form-control"/>
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
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#categoryTable').DataTable({
                "order": [[0, "asc"]],
                "aLengthMenu": [5, 10, 25],
                "iDisplayLength": 10
            });

            $('.editBranModalButton').on('click', function () {
                const id = $(this)[0].getAttribute('categoryId');
                $('#editModalHiddenInput').val(id);
                $.ajax({
                    type: 'GET',
                    url: '{{route('getCategoryName')}}',
                    data: {id: id},
                    success: function (data) {
                        $('#editModalInput').val(data);
                    }
                });
            })
        });
    </script>
@endsection
