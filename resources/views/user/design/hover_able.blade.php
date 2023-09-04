@if (Auth::check())
    @if (App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->count() > 0)
        @foreach (App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->get() as $love)
            <li class="active ">
                <a href="javascript:void(0)" class="love" onclick="love({{$product->id}})">
                    <i class="ri-heart-line"></i>
                </a>
            </li>
        @endforeach
    @else
        <li class="active">
            <a href="javascript:void(0)" onclick="love({{$product->id}})">
                <i class="ri-heart-line"></i>
            </a>
            </li>
    @endif
@else
    <li class="active"><a href="javascript:void(0)" onclick="createToast('Bạn cần phải đăng nhập')"><i class="ri-heart-line"></i></a></li>
@endif
@if ($product->sale == 0)
    <li><a href="{{ url('detail/' . $product->slug) }}"><i
                class="ri-eye-line"></i></a></li>
@else
    <li><a href="{{ url('pageoffer/' . $product->slug) }}"><i
                class="ri-eye-line"></i></a></li>
@endif
<li><a href=""><i class="ri-shuffle-line"></i></a></li>
