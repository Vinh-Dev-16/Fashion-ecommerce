<section class="modal-data">
    <div class="invoice">
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
                        Tạo ngày:
                    {{date('d-m-y', strtotime(Carbon\Carbon::now()))}}
                    </p>
                </div>
            </div>
            <div class="i_row">
                <div class="i_number">
                    <p class="p_title" style="margin-bottom: 5px">Mã hóa đơn: {{$orderDetail->id}}</p>
                    <p class="p_title">
                        <span>{!! DNS1D::getBarcodeHTML( $orderDetail->id , 'PHARMA') !!}</span></p>
                </div>
                <div class="i_number">
                    <p class="p_title"></p>
                        {!!  DNS2D::getBarcodeHTML('fashion' . $orderDetail->id, 'QRCODE') !!}
                </div>
                <div class="i_address text_right">
                    <p>Tới</p>
                    <p class="p_title">
                        {{$orderDetail->order->fullname}} <br />
                        <span>{{$user->information->address}}, {{$user->information->commune}}</span>
                        <br>
                        <span>{{$user->information->district}}, {{$user->information->province}}</span><br />
                    </p>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="i_table">
                <div class="i_table_head">
                    <div class="i_row">
                        <div class="i_col w_15">
                            <p class="p_title">Thuộc tính</p>
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
                            <p>Màu: {{\App\Helpers\ColorNameHelper::ChangeName($orderDetail->color)}}</p>
                        </div>
                        <div class="i_col w_55">
                           <p>{{$orderDetail->name}}</p>
                        </div>
                        <div class="i_col w_15">
                            <p>{{date('d-m-y', strtotime($orderDetail->created_at))}}</p>
                        </div>
                        <div class="i_col w_15">
                            <?php
                                if ($orderDetail->discount > 0) {
                                    $total = ($orderDetail->price * (100 - $orderDetail->discount)) / 100 * $orderDetail->quantity;
                                } else {
                                    $total = $orderDetail->price * $orderDetail->quantity;
                                }
                            ?>
                            <p>{{number_format(floor($total))}} VND</p>
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
                            <p>Phí ship</p>
                        </div>
                        <div class="i_col w_15">
                            <p>{{number_format(floor($total))}}</p>
                            <p>{{number_format(floor($total * 0.1))}}</p>
                            <p>{{number_format('15000')}}</p>
                        </div>
                    </div>
                    <div class="i_row grand_total_wrap">
                        <div class="i_col w_50">
                        </div>
                        <div class="i_col w_50 grand_total">
                            <p><span>Tổng tất cả:</span>
                                <span>{{number_format(floor($orderDetail->total_money))}} VND</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="i_row">
                <div class="i_col w_50">
                    <a href="{{route('history.print_invoice')}}" class="p_title" target="_blank"><i class="ri-file-download-line"></i> Tai xuong file PDF</a>
                </div>
                <div class="i_col w_50 text_right" style="cursor: pointer">
                    <p class="p_title" id="print_invoice"><i class="ri-printer-line"></i> In hóa đơn</p>
                </div>
            </div>
        </div>
        <div class="bottom_line"></div>

    </div>
</section>
<div class="overlay"></div>

<script defer>
    $(document).ready(function () {
        $('#print_invoice').click(function () {
            window.print();
        })
        $('.overlay').addClass('active');
    })
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('overlay')) {
            $('.modal-data').removeClass('active');
            $('.overlay').removeClass('active');
        }
    })
</script>
