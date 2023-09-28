@if($feedback->likes->count() > 0)
    @foreach($feedback->likes->take(1) as $like)
        @if($like->user_id == Auth::user()->id)
            <p style="margin-right: 1rem; font-size: 20px">
                <i class="ri-thumb-up-fill like-feedback" onclick="like_feedback({{$feedback->id}}, 2)"
                   style="color:blue; cursor: pointer"></i>
                <span id="count-like">{{ $feedback->like }}</span>
            </p>
        @else
            <p style="margin-right: 1rem; font-size: 20px">
                <i class="ri-thumb-up-fill like-feedback" onclick="like_feedback({{$feedback->id}}, 1 )"
                   style="cursor: pointer"></i>
                <span id="count-like">{{  $feedback->like }}</span>
            </p>
        @endif
    @endforeach
@else
    <p style="margin-right: 1rem; font-size: 20px">
        <i class="ri-thumb-up-fill like-feedback" onclick="like_feedback({{$feedback->id}}, 1 )"
           style="cursor: pointer"></i>
        <span id="count-like">{{  $feedback->like }}</span>
@endif


