<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên giá trị
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên thuộc tính
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 " style="">Công cụ
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php $i = 1; ?>
        @foreach ($values as $value)
            <td>
                <p class="text-xs mb-0" style="margin: 0 16px">{{$values->firstItem() + $loop->index}}</p>
            </td>
            <td>
                <div class="my-auto">
                    <h6 class="mb-0 text-sm">
                       @if($value->attributes->id == 2)
                            {{ \App\Helpers\ColorNameHelper::ChangeName($value->value)}}
                           @else
                            {{ $value->value}}
                       @endif
                    </h6>
                </div>
            </td>
            <td>
                <div class="my-auto">
                    <h6 class="mb-0 text-sm">
                        {{\App\Helpers\ColorNameHelper::changeNameAttribute($value->attributes->value)}}
                    </h6>
                </div>
            </td>
            <td class="align-middle text-center ms-auto text-end" style="width: 20%">
                @can('delete-value')
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                       onclick="return confirmation((this), {{$value->id}})"
                       href="javascript:void(0)"><i
                            class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa</a>
                @endcan
                @can('edit-value')
                    <a class="btn btn-link text-dark px-3 mb-0"
                       href="javascript:void(0)" onclick="get_modal_edit_value({{$value->id}})"><i
                            class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                @endcan
            </td>
    </tr>
    @endforeach
    </tbody>
</table>
{{ $values->render('vendor.pagination.bootstrap-4') }}
