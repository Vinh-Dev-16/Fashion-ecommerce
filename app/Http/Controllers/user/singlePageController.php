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
    
    public function detail(Request $request, $id)
    {
        $products = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $category_id = $products->categories()->pluck('categories.id');
        $category = Category::find($category_id);
        $cart = session()->get('cart', []);
        Session::put('pageoffer_url', request()->fullUrl());
        $rate = $products->reviews()->pluck('feedbacks.rate')->avg();
        return view('user.design.detail', compact('products', 'categories', 'brands', 'category','cart','rate'));
    }

    public function pageOffer(Request $request, $id)
    {
        $products = Product::find($id);
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

    public function category($id){
        $category = Category::findOrFail($id);
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $paginate = $category->products()->paginate(12);
        $cart = session()->get('cart', []);
        return view('user.design.category', compact('category','brands','products','categories','cart','paginate'));
    } 


    public function filtering($id,$value){

        switch($value){
            case(3):
                $brand = Brand::findOrFail($id);
                $result = $brand->products()->orderBy('price','DESC')->get();
                $results = collect($result, []);
                foreach ($results as $result) {
                    $result->images->first()->path;
                }
                return response()->json([
                    'status'=> 'success',
                    'result'=> $results,
                ]);
                break;
            case (1):
                $brand = Brand::findOrFail($id);
                $result = $brand->products()->get();
                $results = collect($result, []);
                foreach ($results as $result) {
                    $result->images->first()->path;
                }
                return response()->json([
                    'status'=> 'success',
                    'result'=> $results,
                ]);
                break;
            case (2):
                $brand = Brand::findOrFail($id);
                $result = $brand->products()->orderBy('name','DESC')->get();
                $results = collect($result, []);
                foreach ($results as $result) {
                    $result->images->first()->path;
                }
                return response()->json([
                    'status'=> 'success',
                    'result'=> $results,
                ]);
                break;
        }
    }

    public function filteringCategory($id,$value){

        switch($value){
            case(3):
                $category = Category::findOrFail($id);
                $result = $category->products()->orderBy('price','DESC')->get();
                $results = collect($result, []);
                foreach ($results as $result) {
                    $result->images->first()->path;
                }
                return response()->json([
                    'status'=> 'success',
                    'result'=> $results,
                ]);
                break;
            case (1):
                $category = Category::findOrFail($id);
                $result = $category->products()->get();
                $results = collect($result, []);
                foreach ($results as $result) {
                    $result->images->first()->path;
                }
                return response()->json([
                    'status'=> 'success',
                    'result'=> $results,
                ]);
                break;
            case (2):
                $category = Category::findOrFail($id);
                $result = $category->products()->orderBy('name','DESC')->get();
                $results = collect($result, []);
                foreach ($results as $result) {
                    $result->images->first()->path;
                }
                return response()->json([
                    'status'=> 'success',
                    'result'=> $results,
                ]);
                break;
        }
    }
}
