<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class detailController extends Controller
{
    public function index(Request $request ,$slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $cart = session()->get('cart', []);
        $products = Product::where('slug', $slug)->firstOrFail();
        if (Cookie::has('view')) {
            $view = json_decode($request->cookie('view'), true);
            if (!in_array($products->id, $view)) {
                $products->increment('view');
                $view[] = $products->id;
                Cookie::queue('view', json_encode($view), 1440);
            }
        } else {
            $products->increment('view');
            Cookie::queue('view', json_encode([$products->id]), 120);
        }
        Session::put('pageoffer_url', request()->fullUrl());
        $rate = $products->reviews()->pluck('feedbacks.rate')->avg();
        return view('user.design.detail', compact('products', 'rate', 'cart'));
    }
}
