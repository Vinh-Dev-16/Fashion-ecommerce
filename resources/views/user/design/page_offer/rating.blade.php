@if (80 * ($product->feedbacks()->pluck('feedbacks.rate')->avg() / 5) == 0)
    <div class="stars" style="background-image:none;width:150px">Chưa có
        đánh giá
    </div>
@else
    <div class="stars"
         style="width:{{ 80 *($product->feedbacks()->pluck('feedbacks.rate')->avg() /5) }}px ">
    </div>
@endif
<a href=""
   class="mini_text render_count">{{ $product->feedbacks->count() }}
    đánh giá</a>
