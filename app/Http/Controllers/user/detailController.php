<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\FeedBack;
use App\Models\admin\Product;
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
        Session::put('pageoffer_url', request()->fullUrl());
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
                'view' => view('user.design.page_offer.wishlist', compact('product'))->render(),
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
        ], [
            'title.required' => 'Không được để trống tiêu đề',
            'title.max' => 'Tiêu đề không được quá 255 ký tự',
            'content.required' => 'Không được để trống nội dung',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 0,
                'error' => $validator->errors()->toArray(),
            ];
        }
        try {
            $input = $request->all();
            FeedBack::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'title' => $input['title'],
                'content' => $input['content'],
                'product_id' => $input['product_id'],
                'rate' => $input['rate'],
            ]);
            $count = FeedBack::where('product_id', $input['product_id'])->count();
            $rate = FeedBack::where('product_id', $input['product_id'])->pluck('rate')->avg();
            Product::where('id', $input['product_id'])->update([
                'rate' => $rate,
                'count' => $count,
            ]);

            return [
                'status' => 1,
                'message' => 'Gửi đánh giá thành công',
                'count' => $count,
                'rate' => $rate,
                'view' => view('user.design.detail.feed_back', compact('count', 'rate'))->render(),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 2,
                'message' => 'Đã xảy ra lỗi',
            ];
        }

    }
}
