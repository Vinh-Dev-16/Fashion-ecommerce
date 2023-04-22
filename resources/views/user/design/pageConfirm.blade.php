@extends('user.layout')
@section('title')
    Xác nhận đơn hàng
@endsection
@section('content')

    <div class="single_checkout">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Đơn hàng</li>
                    </ul>
                </div>
                @if (App\Models\OrderDetail::where('status', 0)->count() > 0)
                    <div class="products one cart">
                        <div class="item" style="width: 100%">
                            <form action="{{ url('confirm/item') }}" method="POST">
                                @csrf
                                <table id="cart_table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <button style="border:none; outline:none;font-size:16px;font-weight:600"
                                                    type="submit">Xác nhận </button>
                                            </th>
                                            <th>Sản phẩm</th>
                                            <th>Note</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Models\OrderDetail::where('status', 0)->get() as $orderItem)
                                            @if ($orderItem->status == 0)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name='ids[{{ $orderItem->id }}]'
                                                            value="{{ $orderItem->id }}">
                                                    </td>
                                                    <td class="flexitem">
                                                        @if ($orderItem->sale == 0)
                                                            <div class="thumbnail">
                                                                <a href="{{ url('detail/' . $orderItem->product_id) }}"><img
                                                                        src="{{ $orderItem->product->images->first()->path }}"
                                                                        alt="{{ $orderItem->name }}"></a>
                                                            </div>
                                                            <div class="content">
                                                                <strong>
                                                                    <a href="{{ url('detail/' . $orderItem->product_id) }}">{{ $orderItem->name }}
                                                                    </a>
                                                                </strong>
                                                                <p style="margin-bottom: 1px">Color:
                                                                    {{ $orderItem->color }}</p>
                                                                <p>Size: {{ $orderItem->size }}</p>
                                                            </div>
                                                        @else
                                                            <div class="thumbnail">
                                                                <a href="{{ url('pageoffer/' . $orderItem->product_id) }}"><img
                                                                        src="{{ $orderItem->product->images->first()->path }}"
                                                                        alt="{{ $orderItem->name }}"></a>
                                                            </div>
                                                            <div class="content">
                                                                <strong>
                                                                    <a
                                                                        href="{{ url('pageoffer/' . $orderItem->product_id) }}">{{ $orderItem->name }}
                                                                    </a>
                                                                </strong>
                                                                <p style="margin-bottom: 1px">Color:
                                                                    {{ $orderItem->color }}</p>
                                                                <p>Size: {{ $orderItem->size }}</p>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    @if ($orderItem->order->note)
                                                        <td>
                                                            {{$orderItem->order->note}}    
                                                        </td>
                                                    @else
                                                        <td>Không có</td>
                                                    @endif
                                                    <td>
                                                        @if ($orderItem->discount)
                                                            <span>{{ number_format($orderItem->price - ($orderItem->discount / 100) * $orderItem->price) }}
                                                                VND
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ number_format($orderItem->price) }}
                                                                VND
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $orderItem->quantity }}</td>
                                                    <td>
                                                        {{ number_format($orderItem->total_money) }} VND
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                @else
                    <h2 class="search_page">Buôn bán ế rồi</h2>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        const dpt_menu = document.querySelectorAll('.dpt_menu');
        const close_menu = document.querySelectorAll('#close_menu');

        for (let i of dpt_menu) {
            i.classList.add('active');
        }
        close_menu.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                for (let i of dpt_menu) {
                    i.classList.toggle('active');
                }
            });
        })
    </script>
@endsection
