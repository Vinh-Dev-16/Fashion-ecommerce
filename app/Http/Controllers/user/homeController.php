<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;

class homeController extends Controller
{
    public function home(){
        $products = Product::all();
        $categories = Category::all()->take(8);
        $brands = Brand::all();
        return view('user.design.home', compact('products', 'categories', 'brands'));
    }
}
