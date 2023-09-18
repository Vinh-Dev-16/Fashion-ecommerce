<?php

namespace App\Http\Controllers\user;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class wishlistController extends Controller
{

    public function index(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if ($request->ajax()) {
            $wishlists = Wishlist::where('user_id',$id)->paginate(12);
            return view('user.design.wishlist.list_data',compact('wishlists', 'cart'));
        }
        $wishlists = Wishlist::where('user_id',$id)->paginate(12);
        return view('user.design.wishlist.index',compact('wishlists', 'cart'));
    }

    public function delete(Request $request): array
    {
        $wishlist = Wishlist::findOrFail($request->id);
        $wishlist->delete();
        return [
            'success' => true,
        ];
    }
}
