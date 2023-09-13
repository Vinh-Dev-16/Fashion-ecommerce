@if(count($products) > 0)
    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên sản
                phẩm
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Giá</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Giảm giá
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Đã bán</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Tồn kho
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder  opacity-7">
                Công cụ
            </th>
        </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
        @foreach ($products as $product)
            <tr>
                <td>
                    <p class="text-xs text-center  mb-0">{{$i++}}</p>
                </td>
                <td>
                    <a href="{{url('detail/' . $product->slug)}}" class="d-flex px-2">
                        <div>
                            <img src="{{$product->images[0]->path}}"
                                 class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                        </div>
                        <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ Illuminate\Support\Str::of($product->name)->words(8) }}</h6>
                        </div>
                    </a>
                </td>
                <td>
                    <p class="text-xs text-center  mb-0"
                       style="width:38%">{{ number_format($product->price) }} VND
                    </p>
                </td>
                @if ($product->discount)
                    <td>
                        <p class="text-xs text-center  mb-0">{{ $product->discount }}%</p>
                    </td>
                @else
                    <td>
                        <p class="text-xs text-center  mb-0">0%</p>
                    </td>
                @endif
                <td>
                    <p class="text-xs text-center  mb-0">
                        {{ $product->sold}}
                    </p>
                </td>
                <td>
                    <p class="text-xs text-center  mb-0">
                        {{ $product->stock}}
                    </p>
                </td>
                <td class="align-middle text-center ms-auto text-end">
                    @can('delete-product')
                        <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                           onclick="return confirmation(this)"
                           href="{{url('admin/product/destroy/'. $product->id)}}"><i
                                class="far fa-trash-alt me-2" aria-hidden="true"></i>Xóa</a>
                    @endcan
                    @can('edit-product')
                        <a class="btn btn-link text-dark px-3 mb-0"
                           href="{{url('admin/product/edit/'. $product->slug)}}"><i
                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->render('vendor.pagination.bootstrap-4') }}
@else
    <h2 style="text-align: center; font-size: 21px;">Không có kết quả</h2>
@endif
