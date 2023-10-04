<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên thuộc tính
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 " style="">Công cụ
        </th>
    </tr>
    </thead>
        <tbody>
        <tr>
            <?php $i = 1; ?>
            @foreach ($attributes as $attribute)
                <td>
                    <p class="text-xs mb-0" style="margin: 0 16px">{{$i++}}</p>
                </td>
                <td>
                    <div class="my-auto">
                        <h6 class="mb-0 text-sm">
                            {{ $attribute->value}}</h6>
                    </div>
                </td>
                <td class="align-middle text-center ms-auto text-end" style="width: 20%">
                    @can('delete-attribute')
                        <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                           onclick="return confirmation(this)"
                           href="{{url('admin/attribute/destroy/'. $attribute->id)}}"><i
                                class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa</a>
                    @endcan
                    @can('edit-attribute')
                        <a class="btn btn-link text-dark px-3 mb-0"
                           href="{{url('admin/attribute/edit/'. $attribute->slug)}}"><i
                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                    @endcan
                </td>
        </tr>
        @endforeach
        </tbody>
</table>
{{ $attributes->render('vendor.pagination.bootstrap-4') }}
