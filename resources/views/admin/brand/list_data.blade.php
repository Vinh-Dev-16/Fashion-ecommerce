<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên Brand
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Số sản phẩm</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 " style="">Công cụ
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php $i = 1; ?>
        @foreach ($brands as $brand)
            <td>
                <p class="text-xs mb-0" style="margin: 0 16px">{{$i++}}</p>
            </td>
            <td>
                <a href="{{route('brand.index', $brand->slug)}}" class="d-flex px-2">
                    <div>
                        <img src="{{ $brand->logo }}"
                             class="avatar avatar-sm rounded-circle me-5" alt="spotify">
                    </div>
                    <div class="my-auto">
                        <h6 class="mb-0 text-sm">
                            {{ $brand->name}}</h6>
                    </div>
                </a>
            </td>
            <td>
                @if ($brand->products->count() == 0)
                    <p class="text-xs text-center  mb-0"
                       style="width:38%">Không có</p>
                @else
                    <p class="text-xs text-center  mb-0"
                       style="width:38%">{{ $brand->products->count() }}</p>
                @endif
            </td>
            <td class="align-middle text-center ms-auto text-end" style="width: 20%">
                @can('delete-brand')
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                       onclick="return confirmation(this)"
                       href="{{url('admin/brand/destroy/'. $brand->id)}}"><i
                            class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa</a>
                @endcan
                @can('edit-brand')
                    <a class="btn btn-link text-dark px-3 mb-0"
                       href="{{url('admin/brand/edit/'. $brand->slug)}}"><i
                            class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                @endcan
            </td>
    </tr>
    @endforeach
</table>
{{ $brands->render('vendor.pagination.bootstrap-4') }}
