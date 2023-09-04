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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $wishlists = Wishlist::where('user_id',$id)->paginate(12);
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.wishlist',compact('wishlists','products', 'categories', 'brands','cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request): \Illuminate\Http\Response
    {
        Wishlist::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
        ]);
        $wishlists = Wishlist::where('user_id', $request->user_id)->get();
        return response()->json([
            'result' => $wishlists,
        ]);
    }






    public function edit($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Wishlist::find($id)->user_id;
        Wishlist::find($id)->delete();
        $wishlists = Wishlist::where('user_id', $user_id)->get();
        return response()->json([
            'result' => $wishlists,
        ]);
    }
    public function delete($id)
    {
        Wishlist::find($id)->delete();
        return redirect()->back()->with('success','Đã xóa thành công');
    }
}
