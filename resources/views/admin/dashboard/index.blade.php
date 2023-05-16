@extends('admin.layout')
@section('title')
    Trang Dashboard
@endsection
@section('content')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top 10 sản phẩm bán chạy nhất</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\admin\Product::orderBy('sold', 'desc')->limit(10)->get() as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ Illuminate\Support\Str::of($product->name)->words(6) }}</td>
                                <td><span>{{ $product->sold }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top rating product</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên sản phẩm</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\admin\Product::orderBy('rate', 'desc')->limit(10)->get() as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ Illuminate\Support\Str::of($product->name)->words(6) }}</td>
                                <td><span>{{ $product->rate }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
@section('breadcumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
    </ol>
@endsection
