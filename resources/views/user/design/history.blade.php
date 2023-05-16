@extends('user.layout')
@section('title')
    Lịch sử mua hàng
@endsection
@section('content')
    @if (App\Models\Order::where('user_id', Auth::user()->id))
        <div class="single_checkout">
            <div class="container">
                <div class="wrapper">
                    <div class="breadcrumb">
                        <ul class="flexitem">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Lịch sử giao dịch</li>
                        </ul>
                    </div>
                    <div class="main_history">
                        <div class="switch_tabs">
                            <ul class="tabs">
                                <li>
                                    <i class="ri-check-fill"></i> Chờ xác nhận
                                </li>
                                <li>
                                    <i class="ri-truck-line"></i> Đang giao hàng
                                </li>
                                <li>
                                    <i class="ri-checkbox-multiple-line"></i> Đã giao hàng
                                </li>
                                <li>
                                    <i class="ri-close-line"></i>Đã hủy hàng
                                </li>
                            </ul>

                            <div class="container_tabs ">
                                <div class="content_tabs active">
                                    <div class="products one cart">
                                        <div class="item" style="width: 100%">
                                            <table id="cart_table">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Giá</th>
                                                        <th>Số lượng</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (App\Models\Order::where('user_id', Auth::user()->id)->latest()->get() as $order)
                                                        @foreach ($order->orderDetails as $orderItem)
                                                            @if ($orderItem->status == 0)
                                                                <tr>
                                                                    <td class="flexitem">
                                                                        @if ($orderItem->sale == 0)
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('detail/' . $orderItem->product_id) }}"><img
                                                                                        src="{{ $orderItem->product->images->first()->path }}"
                                                                                        alt="{{ $orderItem->name }}"></a>
                                                                            </div>
                                                                            <div class="content">
                                                                                <strong>
                                                                                    <a
                                                                                        href="{{ url('detail/' . $orderItem->product_id) }}">{{ $orderItem->name }}
                                                                                    </a>
                                                                                </strong>
                                                                                <p style="margin-bottom: 1px">Color:
                                                                                    {{ $orderItem->color }}</p>
                                                                                <p>Size: {{ $orderItem->size }}</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('pageoffer/' . $orderItem->product_id) }}"><img
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
                                                                    <td>
                                                                        <a href="{{ url('softdelete/' . $orderItem->id) }}">Hủy
                                                                            đơn</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="content_tabs">
                                    <div class="products one cart">
                                        <div class="item" style="width: 100%">
                                            <table id="cart_table" style="margin-top: 30px">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Giá</th>
                                                        <th>Số lượng</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (App\Models\Order::where('user_id', Auth::user()->id)->latest()->get() as $order)
                                                        @foreach ($order->orderDetails as $orderItem)
                                                            @if ($orderItem->status == 2)
                                                                <tr>
                                                                    <td class="flexitem">
                                                                        @if ($orderItem->sale == 0)
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('detail/' . $orderItem->product_id) }}"><img
                                                                                        src="{{ $orderItem->product->images->first()->path }}"
                                                                                        alt="{{ $orderItem->name }}"></a>
                                                                            </div>
                                                                            <div class="content">
                                                                                <strong>
                                                                                    <a
                                                                                        href="{{ url('detail/' . $orderItem->product_id) }}">{{ $orderItem->name }}
                                                                                    </a>
                                                                                </strong>
                                                                                <p style="margin-bottom: 1px">Color:
                                                                                    {{ $orderItem->color }}</p>
                                                                                <p>Size: {{ $orderItem->size }}</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('pageoffer/' . $orderItem->product_id) }}"><img
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
                                                                    <td>
                                                                        <div style="cursor: pointer" class="detail_ship">Xem
                                                                            chi
                                                                            tiết</div>
                                                                        <br>
                                                                        @if ($orderItem->ship == 1)
                                                                            <a
                                                                                href="{{ url('confirm/product/' . $orderItem->id) }}">Confirm</a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <div class="main_ship">
                                                                    <h3 class="heading_ship">Trạng thái giao hàng</h3>

                                                                    <div class="container_ship">
                                                                        <ul>
                                                                            @if ($orderItem->ship == 1)
                                                                                <li>
                                                                                    <h3 class="title">Đã giao hàng</h3>
                                                                                    <p>Đơn hàng của bạn đã được shipper giao
                                                                                        tới. Vui lòng mời bạn xuống nhận</p>
                                                                                    <span class="circle_ship"></span>
                                                                                    <span
                                                                                        class="date">{{ date('d-m-Y'), strtotime($orderItem->time) }}</span>
                                                                                </li>
                                                                            @endif
                                                                            <li>
                                                                                <h3 class="title">Đang giao hàng</h3>
                                                                                <p>Đơn hàng của bạn đang được giao</p>
                                                                                <span class="circle_ship"></span>
                                                                                <span class="date">
                                                                                    {{ date('d-m-Y'), strtotime($orderItem->time_confirm) }}</span>
                                                                            </li>
                                                                            <li>
                                                                                <h3 class="title">Đã đóng hàng</h3>
                                                                                <p>Đơn hàng của bạn đã được nhà cung cấp
                                                                                    đóng hàng vào ngày
                                                                                    {{ date('d-m-Y'), strtotime($orderItem->time) }}
                                                                                </p>
                                                                                <span class="circle_ship"></span>
                                                                                <span class="date">
                                                                                    {{ date('d-m-Y'), strtotime($orderItem->time_confirm) }}
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="overlay"></div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="content_tabs">
                                    <div class="products one cart">
                                        <div class="item" style="width: 100%">
                                            <table id="cart_table">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Giá</th>
                                                        <th>Số lượng</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Ngày nhận hàng</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (App\Models\Order::where('user_id', Auth::user()->id)->latest()->get() as $order)
                                                        @foreach ($order->orderDetails as $orderItem)
                                                            @if ($orderItem->status == 1)
                                                                <tr>
                                                                    <td class="flexitem">
                                                                        @if ($orderItem->sale == 0)
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('detail/' . $orderItem->product_id) }}"><img
                                                                                        src="{{ $orderItem->product->images->first()->path }}"
                                                                                        alt="{{ $orderItem->name }}"></a>
                                                                            </div>
                                                                            <div class="content">
                                                                                <strong>
                                                                                    <a
                                                                                        href="{{ url('detail/' . $orderItem->product_id) }}">{{ $orderItem->name }}
                                                                                    </a>
                                                                                </strong>
                                                                                <p style="margin-bottom: 1px">Color:
                                                                                    {{ $orderItem->color }}</p>
                                                                                <p>Size: {{ $orderItem->size }}</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('pageoffer/' . $orderItem->product_id) }}"><img
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
                                                                    <td> {{ date('d-m-Y'), strtotime($order->updated_at) }}
                                                                    </td>
                                                                    <td class="history_ship" style="cursor: pointer">Xem
                                                                        lịch sử</td>
                                                                </tr>
                                                                <div class="history">
                                                                    <h3 class="heading_ship">Trạng thái giao hàng</h3>

                                                                    <div class="container_ship">
                                                                        <ul>
                                                                            <li>
                                                                                <h3 class="title">Đã nhận được hàng</h3>
                                                                                <p>Bạn đã nhận được hàng</p>
                                                                                <span class="circle_ship"></span>
                                                                                <span
                                                                                    class="date">{{ date('d-m-Y'), strtotime($orderItem->updated_at) }}</span>
                                                                            </li>
                                                                            <li>
                                                                                <h3 class="title">Đã giao hàng</h3>
                                                                                <p>Đơn hàng của bạn đã được shipper giao
                                                                                    tới. Vui lòng mời bạn xuống nhận</p>
                                                                                <span class="circle_ship"></span>
                                                                                <span
                                                                                    class="date">{{ date('d-m-Y'), strtotime($orderItem->time) }}</span>
                                                                            </li>
                                                                            <li>
                                                                                <h3 class="title">Đang giao hàng</h3>
                                                                                <p>Đơn hàng của bạn đang được giao</p>
                                                                                <span class="circle_ship"></span>
                                                                                <span class="date">
                                                                                    {{ date('d-m-Y'), strtotime($orderItem->time_confirm) }}</span>
                                                                            </li>
                                                                            <li>
                                                                                <h3 class="title">Đã đóng hàng</h3>
                                                                                <p>Đơn hàng của bạn đã được nhà cung cấp
                                                                                    đóng hàng vào ngày
                                                                                    {{ date('d-m-Y'), strtotime($orderItem->time) }}
                                                                                </p>
                                                                                <span class="circle_ship"></span>
                                                                                <span class="date">
                                                                                    {{ date('d-m-Y'), strtotime($orderItem->time_confirm) }}
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="overlay"></div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="content_tabs">
                                    <div class="products one cart">
                                        <div class="item" style="width: 100%">
                                            <table id="cart_table">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Giá</th>
                                                        <th>Số lượng</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (App\Models\Order::where('user_id', Auth::user()->id)->latest()->get() as $order)
                                                        @foreach (App\Models\OrderDetail::onlyTrashed()->where('order_id' , $order->id)->get() as $orderItem)
                                                            @if ($orderItem->status == 0)
                                                                <tr>
                                                                    <td class="flexitem">
                                                                        @if ($orderItem->sale == 0)
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('detail/' . $orderItem->product_id) }}"><img
                                                                                        src="{{ $orderItem->product->images->first()->path }}"
                                                                                        alt="{{ $orderItem->name }}"></a>
                                                                            </div>
                                                                            <div class="content">
                                                                                <strong>
                                                                                    <a
                                                                                        href="{{ url('detail/' . $orderItem->product_id) }}">{{ $orderItem->name }}
                                                                                    </a>
                                                                                </strong>
                                                                                <p style="margin-bottom: 1px">Color:
                                                                                    {{ $orderItem->color }}</p>
                                                                                <p>Size: {{ $orderItem->size }}</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="thumbnail">
                                                                                <a
                                                                                    href="{{ url('pageoffer/' . $orderItem->product_id) }}"><img
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
                                                                    <td>
                                                                        <a href="{{ url('restore/' . $orderItem->id) }}">Đặt
                                                                            lại </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h2 class="search_page">Bạn chưa có đơn hàng nào</h2>
    @endif
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

        const tabs = document.querySelectorAll(".tabs li");
        const content = document.querySelectorAll(".content_tabs");

        tabs.forEach((tab, index) => {
            tab.addEventListener("click", () => {
                tabs.forEach((tab) => tab.classList.remove("active"));

                tab.classList.add("active");
                content.forEach(c => c.classList.remove("active"));
                content[index].classList.add('active');
            });
        });
        tabs[0].click();

        let detail_ship = document.querySelectorAll('.detail_ship');
        let main_ship = document.querySelectorAll('.main_ship');

        detail_ship.forEach((tab, index) => {
            tab.addEventListener("click", () => {
                main_ship.forEach(c => c.classList.remove("active"));
                main_ship[index].classList.toggle('active');
            });
        });

        let history_ship = document.querySelectorAll('.history_ship');
        let history = document.querySelectorAll('.history');

        history_ship.forEach((tab, index) => {
            tab.addEventListener("click", () => {
                main_ship.forEach(c => c.classList.remove("active"));
                history[index].classList.toggle('active');
            });
        });
    </script>
@endsection
