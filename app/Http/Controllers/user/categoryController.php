<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use App\Models\admin\Category;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $paginate = $category->products()->paginate(12);
        $cart = session()->get('cart', []);
        return view('user.design.category.index', compact('category', 'brands', 'products', 'categories', 'cart', 'paginate'));
    }

    public function listData(Request $request)
    {
        $category = Category::where('slug', $request->slug)->first();
        $products = $category ? $category->products() : Product::query(); // Kiểm tra xem $category có null không

        if (!empty($request->brand)) {
            $products->whereIn('brand_id', $request->brand);
        }

        if (!empty($request->color)) {
            $products->whereHas('attributevalues', function ($query) use ($request) {
                $query->where('attribute_value_id', $request->color);
            });
        }

        if (!empty($request->select_filter)) {
            switch ($request->select_filter) {
                case '1':
                    $products->orderBy('price', 'asc');
                    break;
                case '2':
                    $products->orderBy('price', 'desc');
                    break;
                case '3':
                    $products->orderBy('name', 'asc');
                    break;
                case '4':
                    $products->orderBy('name', 'desc');
                    break;
            }
        }

        $products = $products->get();
        $cart = session()->get('cart', []);
        return view('user.design.category.list_data', compact('products', 'cart', 'category'))->render();
    }
}
