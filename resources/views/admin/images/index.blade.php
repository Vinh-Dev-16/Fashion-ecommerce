@extends('admin.layout')
@section('title')
    Trang image
@endsection
@section('content')

    {{-- Content --}}
    <div class="col-md-12" style="display:flex;align-items: center;justify-content:center">
        <div class="product col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size:25px;text-align:center;margin:10px 0">TRANG THÔNG TIN IMAGES</h2>
                    <h3 class="card-title"><a href="{{ route('admin.images.create') }}">Tạo mới image</a></h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" id="search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th> Image product</th>
                                <th>Tên product</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody class="infor_images">
                            <tr>
                                @foreach ($images as $image)
                                    <td>{{ $image->id }}</td>
                                    <td style="width:150px;height:120px;"><img class="logo_image" src=" {{ $image->path }}"
                                            alt="images của {{$image->products->name}}"></td>
                                    <td>{{ Illuminate\Support\Str::of($image->products->name)->words(4) }}</td>
                                    <td class="table_crud" style="display:flex;justify-content:flex-start;">
                                        <a href="{{ url('admin/images/edit/' . $image->id) }}" title="Sửa image"
                                            style="border: none;outline:none">
                                            <i class="fa-solid fa-pen" style="color:black; font-size:25px;"></i></a>
                                        <form method="post" action="{{ url('admin/images/destroy/' . $image->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa image"
                                                onclick=" return confirm ('Bạn có muốn xóa không?')"
                                                style="border: none;outline:none;padding:0 13px;background:transparent"><i
                                                    class="fa-solid fa-trash"
                                                    style="color: black; font-size:25px;"></i></button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody id="search_result"></tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: flex;justify-content: center;
      align-items: center;">
        {{ $images->links() }}
    </div>
@endsection

@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Images</li>
    </ol>
@endsection

@section('javascript')
    <script>
        function searchImages() {
            $(document).ready(function() {
                $("#search").keyup(function() {
                    console.log(1);
                    $input = $(this).val();
                    if ($input) {
                        $('.infor_images').hide();
                        $('#search_result').show();
                    } else {
                        $('.infor_images').show();
                        $('#search_result').hide();
                    }
                    $.ajax({
                        url: "{{ URL::to('admin/images/search') }}",
                        method: "GET",
                        data: {
                            'search': $input
                        },
                        success: function(data) {
                            $("#search_result").html(data);
                        }
                    });
                })
            })
        }
        searchImages();
    </script>
@endsection
