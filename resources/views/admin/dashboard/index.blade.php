@extends('admin.layout')
@section('title')
    Trang Dashboard
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{ url('admin/dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Trang chủ</h6>
@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Sản phẩm bán chạy nhất</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    style="padding: 2rem">Tên sản phẩm
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    style="padding: 0.5rem">Số lượng đã bán
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    style="padding: 2rem">Tỷ lệ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php $i = 1; ?>
                                @foreach (App\Models\admin\Product::orderBy('sold', 'desc')->limit(10)->get() as $product)
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0 " style="margin-left: 20px !important;">
                                            {{ $i++ }}</p>
                                    </td>
                                    <td>
                                        @if($product->sale == 1)
                                            <a href="{{ url('pageoffer/' . $product->slug) }}" class="d-flex px-2">
                                                <div>
                                                    <img src="{{ $product->images[0]->path }}"
                                                         class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ Illuminate\Support\Str::of($product->name)->words(8) }}</h6>
                                                </div>
                                            </a>
                                            @else
                                            <a href="{{ url('detail/' . $product->slug) }}" class="d-flex px-2">
                                                <div>
                                                    <img src="{{ $product->images[0]->path }}"
                                                         class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ Illuminate\Support\Str::of($product->name)->words(8) }}</h6>
                                                </div>
                                            </a>
                                        @endif

                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">{{ $product->sold }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                                <span
                                                    class="me-2 text-xs font-weight-bold">{{ number_format(($product->sold / ($product->sold + $product->stock)) * 100) }}%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar"
                                                         aria-valuenow="{{ ($product->sold / ($product->sold + $product->stock)) * 100 }}"
                                                         aria-valuemin="0" aria-valuemax="100"
                                                         style="width:{{ ($product->sold / ($product->sold + $product->stock)) * 100 }}%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4" style="min-height:450px">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Sản phẩm sao cao nhất</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    style="padding: 2rem">Tên sản phẩm
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    style="padding: 0.5rem">Số sao
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php $i = 1; ?>
                                @foreach (App\Models\admin\Product::orderBy('rate', 'desc')->limit(10)->get() as $product)
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0 " style="margin-left: 20px !important;">
                                            {{ $i++ }}</p>
                                    </td>
                                    <td>
                                        @if($product->sale == 1)
                                            <a href="{{ url('pageoffer/' . $product->slug) }}" class="d-flex px-2">
                                                <div>
                                                    <img src="{{ $product->images[0]->path }}"
                                                         class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ Illuminate\Support\Str::of($product->name)->words(8) }}</h6>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ url('detail/' . $product->slug) }}" class="d-flex px-2">
                                                <div>
                                                    <img src="{{ $product->images[0]->path }}"
                                                         class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ Illuminate\Support\Str::of($product->name)->words(8) }}</h6>
                                                </div>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">{{ $product->rate }}</span>
                                    </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5" style="max-height: 676px">
            <div class="card card-carousel overflow-hidden h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100 ">
                        @foreach (\App\Models\admin\Product::orderBy('rate', 'desc')->limit(10)->get() as $key => $product)
                            <div class="carousel-item h-100 @if ($key === 0) active @endif"
                                 style="background-image: url('{{ $product->images[0]->path }}'); background-position: center; background-repeat: no-repeat;
                             background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ri-hand-heart-line text-dark opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black">
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="color: black">
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart   --}}
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Biểu đồ doanh thu</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2 " style="width: 100%; height:100%; min-height: 400px">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Biểu đồ doanh thu</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2" style="width: 100%; height:100%; min-height: 400px">
                    <canvas id="bar-chart-price" ></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Biểu đồ về lượt xem sản phẩm</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2" style="width: 100%; height: 100%; min-height: 550px">
                    <canvas id="bar-chart-view" ></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Biểu đồ về lượt đánh giá</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2" style="width: 100%; height: 100%; min-height: 550px">
                    <canvas id="bar-chart-rate" ></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')
    <script>
        var ctx1 = document.getElementById("myChart").getContext("2d");
        var _month = JSON.parse('{!! json_encode($months) !!}');
        var _sold = JSON.parse('{!! json_encode($sold) !!}');
        const data = {
            labels: _month,
            datasets: [{
                label: 'Số sản phẩm đã bán',
                data: _sold,
                fill: false,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgb(75, 192, 192)',
                ],
                borderWidth: 1,
                tension: 0.1,
                hoverBackgroundColor: 'rgb(75, 192, 192)',
            }]
        };
        new Chart(ctx1, {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById("bar-chart-view").getContext("2d");
        var _productName = JSON.parse('{!! json_encode($productName) !!}');
        var _productView = JSON.parse('{!! json_encode($productView) !!}');

        const data2 = {
            labels: _productName,
            datasets: [{
                label: 'Số lượt xem',
                data: _productView,
                fill: false,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgb(75, 192, 192)',
                ],
                borderWidth: 1,
                tension: 0.1,
                hoverBackgroundColor: 'rgb(75, 192, 192)',
            }]
        };
        new Chart(ctx2, {
            type: 'bar',
            data: data2,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx3 = document.getElementById("bar-chart-price").getContext("2d");
        var _price = JSON.parse('{!! json_encode($price) !!}');
        const data3 = {
            labels: _month,
            datasets: [{
                label: 'Doanh thu',
                data: _price,
                fill: false,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgb(75, 192, 192)',
                ],
                borderWidth: 1,
                tension: 0.1,
                hoverBackgroundColor: 'rgb(75, 192, 192)',
            }]
        };
        new Chart(ctx3, {
            type: 'bar',
            data: data3,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx4 = document.getElementById("bar-chart-rate").getContext("2d");
        var _comment = JSON.parse('{!! json_encode($comment) !!}');
        var _productNameByComment = JSON.parse('{!! json_encode($productNameByComment) !!}');
        const data4 = {
            labels: _productNameByComment,
            datasets: [{
                label: 'Số lượt đánh giá',
                data: _comment,
                fill: false,
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgb(153, 102, 255)',
                ],
                borderWidth: 1,
                tension: 0.1,
                hoverBackgroundColor:  'rgb(153, 102, 255)',
            }]
        };

        new Chart(ctx4, {
            type: 'bar',
            data: data4,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
