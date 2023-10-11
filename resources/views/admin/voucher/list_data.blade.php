<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Tên mã giảm giá</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Tiền giảm giá</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Trạng thái</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Số lượng</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Giá trị đơn hàng tối thiểu</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Ngày bắt đầu</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Ngày kết thúc</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 " style="">Công cụ
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php $i = 1; ?>
        @foreach ($vouchers as $voucher)
            <td>
                <p class="text-xs mb-0" style="margin: 0 16px">{{$vouchers->firstItem() + $loop->index}}</p>
            </td>
            <td>
                <div class="my-auto d-flex px-3">
                    <h6 class="mb-0 text-sm">
                        {{ $voucher->value}}</h6>
                </div>
            </td>
            <td>
                <p class="text-xs mb-0">
                    {{ $voucher->percent > 0 ? number_format($voucher->percent) . '%' . ' Tối đa ' . number_format($voucher->max) . 'đ'  : number_format($voucher->price) . 'đ' }}
                    <span>

                    </span>
                </p>
            </td>
            <td>
                <p class="text-xs mb-0" style="padding-left: 10px">
                    @if ($voucher->status == 1)
                        <span class="badge badge-sm bg-gradient-success">Đang hoạt động</span>
                    @else
                        <span class="badge badge-sm bg-gradient-danger">Hết hạn</span>
                    @endif
                </p>
            </td>
            <td>
                <p class="text-xs mb-0" style="padding-left: 35px">
                    {{$voucher->quantity}}
                </p>
            </td>
            <td>
                <p class="text-xs mb-0" style="padding-left: 40px">
                    {{$voucher->min_price ? number_format($voucher->min_price) . 'đ' : 'Không giới hạn'}}
                </p>
            </td>
            <td>
                <p class="text-xs mb-0" style="padding-left: 10px">
                    @if(empty($voucher->start_date))
                        Không giới hạn
                    @else
                        {{date('d-m-Y', strtotime($voucher->start_date))}}
                    @endif
                </p>
            </td>
            <td>
                <p class="text-xs mb-0" style="padding-left: 10px">
                    @if(empty($voucher->end_date))
                        Không giới hạn
                    @else
                        {{date('d-m-Y', strtotime($voucher->end_date))}}
                    @endif
                </p>
            </td>
            <td class="align-middle text-center ms-auto text-end" style="width: 20%">
                @can('delete-voucher')
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                       onclick="return confirmation(this, {{$voucher->id}})"><i
                            class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa</a>
                @endcan
                @can('edit-voucher')
                    <a class="btn btn-link text-dark px-3 mb-0" onclick="get_modal_edit_voucher({{$voucher->id}})"
                       href="javascript:void(0)"><i
                            class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                @endcan
            </td>
    </tr>
    @endforeach
</table>
{{ $vouchers->render('vendor.pagination.bootstrap-4') }}
