@foreach ($product->feedbacks()->orderBy('created_at', 'desc')->limit(6)->get() as $feedback)
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
        <div class="feedback_text">
            <p>{!! $feedback->content !!}</p>
        </div>
        @if (Auth::check())
            <div style="display:flex; gap:1em;">
                @if (Auth::user()->email === $feedback->email || Auth::user()->can('delete-feedback'))
                    <a href="javascript:void(0)" id="btn_delete" onclick="return confirmation(this, {{$feedback->id}})" style="font-size: 20px">
                        <i class="ri-delete-bin-line"></i>  Xóa
                    </a>
                @endif
            </div>
        @endif
    </li>
@endforeach
