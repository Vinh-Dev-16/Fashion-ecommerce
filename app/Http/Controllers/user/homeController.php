<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\admin\Image;

class homeController extends Controller
{
    public function home()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('user.design.home', compact('products', 'categories', 'brands'));
    }

    public function search(Request $request)
    {
        $searches = Product::where('name', 'like', '%' . $request->data . '%')->get();
        $results = collect($searches, []);
        foreach ($results as $result) {
            $result->images->first()->path;
        }
        return response()->json([
            'results' => $results,
            'status' => 'success',
        ]);
    }

    public function detail(Request $request, $id){
        $products = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('user.design.detail', compact('products','categories','brands'));
    }

    public function pageOffer(Request $request , $id ){
        $products = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('user.design.pageoffer', compact('products','categories','brands'));
    }
}
