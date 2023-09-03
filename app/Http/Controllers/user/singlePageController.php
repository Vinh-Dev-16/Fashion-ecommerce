<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class singlePageController extends Controller
{

    public function detail(Request $request, $slug)
    {
        $products = Product::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $brands = Brand::all();
        $category_id = $products->categories()->pluck('categories.id');
        $category = Category::find($category_id);
        $cart = session()->get('cart', []);
        Session::put('pageoffer_url', request()->fullUrl());
        $rate = $products->reviews()->pluck('feedbacks.rate')->avg();
        return view('user.design.detail', compact('products', 'categories', 'brands', 'category','cart','rate'));
    }

    public function pageOffer(Request $request, $slug)
    {
        $products = Product::where('slug', $slug)->firstOrFail();
        $rate = $products->reviews()->pluck('feedbacks.rate')->avg();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        Session::put('pageoffer_url', request()->fullUrl());
        $a =  DB::table('products')->join('wishlist', 'products.id', '=' ,'product_id')->get();
        return view('user.design.pageoffer', compact('products', 'categories', 'brands','cart','rate'));
    }


    // Page Brand

    public function brand($id){
        $brand = Brand::findOrFail($id);
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $paginate = $brand->products()->paginate(12);
        $cart = session()->get('cart', []);
        return view('user.design.brand', compact('brand','brands','products','categories','cart','paginate'));
    }


}
