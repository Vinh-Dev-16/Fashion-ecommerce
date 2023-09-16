@if (Auth::check())
    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" id="product_id" value="{{$product->id}}">
    @if (App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->count() > 0)
        @foreach (App\Models\Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->get() as $love)
            <li>
                <a href="#" id="wishlist"
                   onclick="wishlist()">
                 <span class="icon_large" style="color: #ff6b6b"><i class="ri-heart-fill"></i></span>
                    <span id="love"
                          style="color: #ff6b6b">Đã yêu thích</span>
                </a>
            </li>
        @endforeach
        <input type="hidden" id="has-love" value="0">
    @else
        <li>
            <a href="#" id="wishlist"
               onclick="wishlist()">
                <span class="icon_large"><i class="ri-heart-line"></i></span>
                <span id="love">Yêu thích</span>
            </a>
        </li>
        <input type="hidden" id="has-love" value="1">
    @endif
@else
    <li>
        <div id="wishlist" onclick="createToast('Bạn phải đăng nhập')"
             style="cursor: pointer">
             <span class="icon_large"><i class="ri-heart-line"></i></span>
            <span id="love">Yêu thích</span>
        </div>
    </li>
@endif
<li>
    <a href="">
        <span class="icon_large"><i class="ri-share-line"></i></span>
        <span>Chia sẻ</span>
    </a>
</li>
