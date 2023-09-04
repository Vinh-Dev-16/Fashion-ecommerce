<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\Wishlist;
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

    public function love(Request $request)
    {
        try {

            $whislist = Wishlist::where('product_id',$request->product_id)->where('user_id', $request->user_id)->first();
            if($whislist){
                $whislist->delete();
                $count = Wishlist::where('user_id', $request->user_id)->count();
                return [
                    'status' => config('contains.STATUS_SUCCESS'),
                    'message' => "Đã xóa khỏi danh sách yêu thích",
                    'count' => $count,
                ];
            } else {
                Wishlist::create([
                    'product_id' => $request->product_id,
                    'user_id' => $request->user_id,
                ]);
                $count = Wishlist::where('user_id', $request->user_id)->count();
                return [
                    'status' => config('contains.STATUS_SUCCESS'),
                    'message' => "Đã thêm vào danh sách yêu thích",
                    'count' => $count,
                ];
            }
        } catch (\Throwable $th) {
            return [
                'status' => config('contains.STATUS_ERROR'),
                'message' => $th->getMessage(),
            ];
        }

    }
}
