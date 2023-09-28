@if(Auth::user()->email !== $feedback->email)
    @if ($feedback->like_user->contains(Auth::user()->id))
        <p style="margin-right: 1rem; font-size: 20px">
            <i class="ri-thumb-up-fill like-feedback" onclick="like_feedback({{$feedback->id}}, 1 )"></i>
            <span id="count-like">{{ $feedback->like }}</span>
        </p>
    @else
        <p style="margin-right: 1rem; font-size: 20px">
            <i class="ri-thumb-up-line like-feedback" onclick="like_feedback({{$feedback->id}}, 2)" style="color:blue"></i>
            <span id="count-like">{{ $feedback->like }}</span>
        </p>
    @endif

@endif
