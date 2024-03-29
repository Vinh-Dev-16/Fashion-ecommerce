<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class singlePageController extends Controller
{

    public function detail(Request $request, $slug)
    {
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
        return view('user.design.detail', compact('products', 'rate'));
    }




}
