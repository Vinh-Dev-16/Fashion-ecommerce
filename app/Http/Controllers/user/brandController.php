<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use App\Models\admin\Category;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class brandController extends Controller
{
    public function index($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $paginate = $brand->products()->paginate(12);
        $cart = session()->get('cart', []);
        return view('user.design.brand.index', compact('brand','brands','products','categories','cart','paginate'));
    }

    public function listData(Request $request): string
    {
        $brand = Brand::where('slug', $request->slug)->first();
        $products = $brand ? Product::where('brand_id', $brand->id) : Product::query();

        if (!empty($request->categories)) {
            $products->whereHas('categories', function ($query) use ($request) {
                $query->where('id_category', $request->categories);
            });
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
        return view('user.design.brand.list_data', compact('products', 'cart', 'brand'))->render();
    }
}
