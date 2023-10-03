<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\FeedBack;
use App\Models\admin\Product;
use App\Models\ImageFeedBack;
use App\Models\Like;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class detailController extends Controller
{
    public function index(Request $request, $slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $cart = session()->get('cart', []);
        $product = Product::where('slug', $slug)->firstOrFail();
        if (Cookie::has('view')) {
            $view = json_decode($request->cookie('view'), true);
            if (!in_array($product->id, $view)) {
                $product->increment('view');
                $view[] = $product->id;
                Cookie::queue('view', json_encode($view), 1440);
            }
        } else {
            $product->increment('view');
            Cookie::queue('view', json_encode([$product->id]), 120);
        }
        $rate = $product->feedbacks()->pluck('feedbacks.rate')->avg();
        return view('user.design.detail.index', compact('product', 'rate', 'cart'));
    }


    public function love(Request $request): array
    {
        $product = Product::findOrFail($request->product_id);
        if ($request->love == 1) {
            Wishlist::create([
                'product_id' => $request->product_id,
                'user_id' => $request->user_id,
            ]);
            $count = Wishlist::where('user_id', $request->user_id)->count();
            return [
                'status ' => 1,
                'view' => view('user.design.detail.wishlist', compact('product'))->render(),
                'count' => $count,
            ];
        } else {
            Wishlist::where('product_id', $request->product_id)->where('user_id', $request->user_id)->delete();
            $count = Wishlist::where('user_id', $request->user_id)->count();
            return [
                'status ' => 0,
                'view' => view('user.design.detail.wishlist', compact('product'))->render(),
                'count' => $count,
            ];
        }
    }

    public function like(Request $request)
    {
        $feedback = FeedBack::findOrFail($request->id);
        if ($request->like == 1) {
            $feedback->increment('like');
            Like::create([
                'feed_back_id' => $request->id,
                'user_id' => $request->user_id,
            ]);
            $count = $feedback->like;
            $product = Product::where('id', $feedback->product_id)->first();
            $feedbacks = $product->feedbacks()->orderBy('id', 'desc')->paginate(6);
            return [
                'status' => 1,
                'count' => $count,
                'message' => 'Thích thành công',
                'view' => view('user.design.detail.feedback', compact('product'))->render(),
            ];
        } else {
            $feedback->decrement('like');
            Like::where('feed_back_id', $request->id)->where('user_id', $request->user_id)->delete();
            $count = $feedback->like;
            $product = Product::where('id', $feedback->product_id)->first();
            $feedbacks = $product->feedbacks()->orderBy('id', 'desc')->paginate(6);
            return [
                'status' => 0,
                'count' => $count,
                'message' => 'Bỏ thích thành công',
                'view' => view('user.design.detail.feedback', compact('product'))->render(),
            ];
        }

    }

    public function feedBack(Request $request): array
    {
        $product = Product::findOrFail($request->product_id);
        $rate = $product->feedbacks()->pluck('feedbacks.rate')->avg();
        $count = $product->feedbacks()->count();
        return [
            'status' => 1,
            'view' => view('user.design.detail.feed_back', compact('product', 'rate', 'count'))->render(),
        ];
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'rate' => 'required',
        ], [
            'title.required' => 'Không được để trống tiêu đề',
            'title.max' => 'Tiêu đề không được quá 255 ký tự',
            'content.required' => 'Không được để trống nội dung',
            'rate.required' => 'Không được để trống đánh giá',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ];
        }
        try {
            $input = $request->all();
            $newFeedback = FeedBack::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'title' => $input['title'],
                'content' => $input['content'],
                'product_id' => $input['product_id'],
                'rate' => $input['rate'],
            ]);
            if ($request->images) {
                $files = $request->images;
                foreach ($files as $file) {
                    ImageFeedBack::create([
                        'path' => $file,
                        'feedback_id' => $newFeedback->id,
                    ]);
                }
            }
            $count = FeedBack::where('product_id', $input['product_id'])->count();
            $rateStar = FeedBack::where('product_id', $input['product_id'])->pluck('rate')->avg();
            $rate = round($rateStar, 1);
            Product::where('id', $input['product_id'])->update([
                'rate' => $rate,
                'count' => $count,
            ]);
            $product = Product::findOrFail($request->product_id);
            return [
                'status' => 1,
                'message' => 'Gửi đánh giá thành công',
                'count' => $count,
                'rate' => $rate,
                'html' => view('user.design.detail.rating', compact('product', 'rate', 'count'))->render(),
                'view' => view('user.design.detail.feedback', compact('count', 'rate', 'product'))->render(),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 2,
                'message' => 'Đã xảy ra lỗi',
            ];
        }
    }

    public function loadImages(): array
    {
        try {
         return [
             'status' => 1,
         ];
        } catch (\Exception $e) {
            return [
                'status' => 0,
                'message' => 'Đã xảy ra lỗi',
            ];
        }
    }

    public function destroy()
    {
        $id = request()->id;
        $feedbackByID = FeedBack::findOrFail($id);
        $product = Product::findOrFail($feedbackByID->product_id);
        $likes = Like::where('feed_back_id', $id)->get();
        foreach ($likes as $like) {
            $like->delete();
        }
        $feedbackByID->delete();
        $feedback = $product->feedbacks()->orderBy('id', 'desc')->paginate(6);
        $count = FeedBack::where('product_id', $product->id)->count();
        $rateStar = FeedBack::where('product_id', $product->product_id)->pluck('rate')->avg();
        $rate = round($rateStar, 1);
        Product::where('id', $product->id)->update([
            'rate' => $rate,
            'count' => $count,
        ]);
        return [
            'status' => 1,
            'message' => 'Xóa đánh giá thành công',
            'count' => $count,
            'rate' => $rate,
            'html' => view('user.design.detail.rating', compact( 'product','rate', 'count'))->render(),
            'view' => view('user.design.detail.feedback', compact( 'rate', 'product'))->render(),
        ];
    }

}
