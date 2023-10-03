@foreach ($product->feedbacks->sortByDesc('id') as $feedback)
    <li class="item">
        <div class="feedback_form">
            <p class="person">Bình luận bởi
                {{ $feedback->name }}
            </p>
            <p class="mini_text">Vào ngày
                {{ date('d-m-Y'), strtotime($feedback->created_at) }}
            </p>
        </div>
        <div class="feedback_rating rating">
            <div class="stars"
                 style="width: {{ 80 * ($feedback->rate / 5) }}px">
            </div>
        </div>
        <div class="feedback_title">
            <p style="font-weight: 600; font-size: 35px">{{ $feedback->title }}</p>
        </div>
        @if($feedback->images->count() > 0)
            <div class="image-feedback">
                @foreach ($feedback->images as $image)
                    <img src="{{  $image->path }}" alt="">
                @endforeach
            </div>
        @endif
        <div class="feedback_text" style="font-size: 20px">
            <p>{!! $feedback->content !!}</p>
        </div>
        @if (Auth::check())
            <div style="display:flex; gap:1em;">
                <div class="show-like">
                    @if($feedback->likes->count() > 0 && $feedback->likes->contains('user_id', Auth::user()->id))
                        <p style="margin-right: 1rem; font-size: 20px">
                            <i class="ri-thumb-up-fill like-feedback-{{$feedback->id}}"
                               onclick="like_feedback({{$feedback->id}}, 2)"
                               style="color:blue; cursor: pointer"></i>
                            <span id="count-like-{{$feedback->id}}">{{ $feedback->like }}</span>
                        </p>
                    @else
                        <p style="margin-right: 1rem; font-size: 20px">
                            <i class="ri-thumb-up-fill like-feedback-{{$feedback->id}}"
                               onclick="like_feedback({{$feedback->id}}, 1 )"
                               style="cursor: pointer"></i>
                            <span id="count-like-{{$feedback->id}}">{{  $feedback->like }}</span>
                        </p>
                    @endif
                </div>
                @if (Auth::user()->email === $feedback->email || Auth::user()->can('delete-feedback'))
                    <p>
                        <a href="javascript:void(0)" id="btn_delete"
                           onclick="return confirmation(this, {{$feedback->id}})"
                           style="font-size: 20px">
                            <i class="ri-delete-bin-line"></i> Xóa
                        </a>
                    </p>
                @endif
            </div>
        @else
            <div style="display:flex; gap:1em;">
                <div class="show-like">
                    <p style="margin-right: 1rem; font-size: 20px">
                        <i class="ri-thumb-up-fill like-feedback" onclick="createToast('Bạn cần phải đăng nhập')"
                           style="cursor: pointer"></i>
                        <span id="count-like">{{  $feedback->like }}</span>
                    </p>
                </div>
            </div>
        @endif
    </li>
@endforeach
