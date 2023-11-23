<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên danh mục
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Danh mục cha</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 " style="">Công cụ
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php $i = 1; ?>
        @foreach ($categories as $category)
            <td>
                <p class="text-xs mb-0" style="margin: 0 16px">{{$categories->firstItem() + $loop->index}}</p>
            </td>
            <td>
                <p class="text-xs text-center  mb-0"
                   style="width:38%">{{ $category->name}}
                </p>
            </td>
            <td>
                @if ($category->parent_id == 0)
                    <p class="text-xs text-center  mb-0"
                       style="width:38%">Không có</p>
                @elseif ($parent = \App\Models\admin\Category::find($category->parent_id))
                    <p class="text-xs text-center  mb-0"
                       style="width:38%">{{ $parent->name }}</p>
                @endif
            </td>
            <td class="align-middle text-center ms-auto text-end" style="width: 20%">
                @can('delete-category')
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                       onclick="return confirmation(this, {{ $category->id }})">
                        <i class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa</a>
                @endcan
                @can('edit-category')
                    <a class="btn btn-link text-dark px-3 mb-0" onclick="get_modal_edit_category({{$category->id}})">
                        <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                @endcan
            </td>
    </tr>
    @endforeach
    </tbody>
</table>
{{ $categories->render('vendor.pagination.bootstrap-4') }}
