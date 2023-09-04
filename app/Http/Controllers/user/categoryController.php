<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\Wishlist;
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
