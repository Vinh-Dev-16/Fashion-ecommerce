<?php

namespace App\Http\Controllers;

use App\Models\admin\Brand;
use App\Models\admin\Category;
use App\Models\admin\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $products = Product::orderBy('id','desc')->paginate(12);
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        view()->share('products',$products);
        view()->share('categories',$categories);
        view()->share('brands',$brands);
        view()->share('cart',$cart);
    }


}
