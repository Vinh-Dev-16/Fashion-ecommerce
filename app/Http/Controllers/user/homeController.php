<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\Wishlist;
class homeController extends Controller
{
    public function home()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.home', compact('products', 'categories', 'brands','cart'));
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

    public function searchPage(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        $key = $request->search;
        $searches = Product::where([
            ['name' ,'!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->Where('name', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(12);
       
        return view('user.design.search',compact('searches','key','products','categories','brands','cart'));
    }
}

   
