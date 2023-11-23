<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ảnh
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Sản phẩm</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 " style="">Công cụ
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        @foreach ($images as $image)
            <td>
                <p class="text-xs mb-0" style="margin: 0 16px">
                {{ $images->firstItem() + $loop->index  }}
                </p>
            </td>
            <td >
                <img class="avatar avatar-sm rounded-circle me-2" src=" {{ $image->path }}"
                                                       alt="images của {{$image->products->name}}"></td>
            <td>
                <p class="text-xs text-center  mb-0">
                {{ Illuminate\Support\Str::of($image->products->name)->words(10) }}
                </p></td>
            <td class="align-middle text-center ms-auto text-end" style="width: 20%">
                @can('delete-image')
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                       onclick="return confirmation(this, {{ $image->id }})">
                        <i class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa</a>
                @endcan
                @can('edit-image')
                    <a class="btn btn-link text-dark px-3 mb-0" onclick="get_modal_edit_category({{$image->id}})">
                        <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                @endcan
            </td>
    </tr>
    @endforeach
    </tbody>
</table>
<br>
{{ $images->render('vendor.pagination.bootstrap-4') }}
