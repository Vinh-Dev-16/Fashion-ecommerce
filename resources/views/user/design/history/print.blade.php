<section class="modal-data">
    <div class="invoice">
        <a href="#" class="t_close modalclose flexcenter">
            <i class="ri-close-line"></i>
        </a>
        <div class="top_line"></div>
        <div class="header">
            <div class="i_row">
                <div class="i_logo">
                    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logoCart.png') }}"
                                                                         alt="logo"
                                                                         style="width:30px; height:30px; margin-right:5px"><span
                                class="circle"></span><span
                                style="font-family: 'Dancing Script', cursive; color:green">.F</span><span>ashion</span></a>
                    </div>
                </div>
                <div class="i_title">
                    <h2>Hóa đơn</h2>
                    <p class="p_title text_right">
                    {{date('d-m-y', strtotime(Carbon\Carbon::now()))}}
                    </p>
                </div>
            </div>
            <div class="i_row">
                <div class="i_number">
                    <p class="p_title">Mã hóa đơn: {{$orderDetail->id}}</p>
                    <p class="p_title">Mã vạch
                        <span>{!! DNS1D::getBarcodeHTML( $orderDetail->id , 'PHARMA2T',3,33, 'black') !!}</span></p>
                </div>
                <div class="i_number">
                    <p class="p_title">Mã QR</p>
                        {!!  DNS2D::getBarcodeHTML('fashion' . $orderDetail->id, 'QRCODE') !!}
                </div>
                <div class="i_address text_right">
                    <p>Tới</p>
                    <p class="p_title">
                        {{$orderDetail->order->fullname}} <br />
                        <span>Menlo Park, California</span><br />
                        <span>United States</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="i_table">
                <div class="i_table_head">
                    <div class="i_row">
                        <div class="i_col w_15">
                            <p class="p_title">Thuộc tinh</p>
                        </div>
                        <div class="i_col w_55">
                            <p class="p_title">Tên</p>
                        </div>
                        <div class="i_col w_15">
                            <p class="p_title">Đơn hàng ngày</p>
                        </div>
                        <div class="i_col w_15">
                            <p class="p_title">Tổng</p>
                        </div>
                    </div>
                </div>
                <div class="i_table_body">
                    <div class="i_row">
                        <div class="i_col w_15">
                            <p>Số lượng: {{$orderDetail->quantity}}</p>
                            <p>Size: {{$orderDetail->size}}</p>
                            <p>Màu: {{$orderDetail->color}}</p>
                        </div>
                        <div class="i_col w_55">
                           <p>{{$orderDetail->name}}</p>
                        </div>
                        <div class="i_col w_15">
                            <p>{{date('d-m-y', strtotime($orderDetail->created_at))}}</p>
                        </div>
                        <div class="i_col w_15">
                            <p>{{number_format($orderDetail->total_money)}}</p>
                        </div>
                    </div>
                </div>
                <div class="i_table_foot">
                    <div class="i_row">
                        <div class="i_col w_15">
                            <p></p>
                        </div>
                        <div class="i_col w_55">
                            <p></p>
                        </div>
                        <div class="i_col w_15">
                            <p>Tổng</p>
                            <p>Tax 10%</p>
                        </div>
                        <div class="i_col w_15">
                            <p>$150.00</p>
                            <p>$15.00</p>
                        </div>
                    </div>
                    <div class="i_row grand_total_wrap">
                        <div class="i_col w_50">
                        </div>
                        <div class="i_col w_50 grand_total">
                            <p><span>Tổng tất cả:</span>
                                <span>$165.00</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="i_row">
                <div class="i_col w_50">
                    <a href="{{route('history.print_invoice')}}" class="p_title" target="_blank">Tai xuong file PDF</a>
                </div>
                <div class="i_col w_50 text_right">
                    <p class="p_title" id="print_invoice">In hoa don</p>
                </div>
            </div>
        </div>
        <div class="bottom_line"></div>

    </div>
</section>
<div class="overlay" style="opacity: 1; visibility: inherit"></div>

<script defer>
    $(document).ready(function () {
        $('#print_invoice').click(function () {
            window.print();
        })
    })
    $('.modalclose').click(function (e) {
        e.preventDefault();
        $('.modal-data').removeClass('active');
        $('.overlay').removeClass('active');
    })
</script>
