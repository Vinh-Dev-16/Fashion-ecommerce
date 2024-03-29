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
    public function index(Request $request,$slug)
    {
        $cart = session()->get('cart', []);
       if ($request->ajax()) {
           $category = Category::where('slug', $slug)->first();
           $products =$category->products();
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
                       $products->orderByRaw('price - ((price * discount) / 100) asc');
                       break;
                   case '2':
                       $products->orderByRaw('price - ((price * discount) / 100) desc');
                       break;
                   case '3':
                       $products->orderBy('name', 'asc');
                       break;
                   case '4':
                       $products->orderBy('name', 'desc');
                       break;
               }
           }

           $products = $products->paginate(12);
           return view('user.design.category.list_data', compact('products',  'category'))->render();
        }
        $category = Category::where('slug', $slug)->first();
        $paginate = $category->products()->paginate(12);
        return view('user.design.category.index', compact('category',  'paginate', 'cart'));
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
