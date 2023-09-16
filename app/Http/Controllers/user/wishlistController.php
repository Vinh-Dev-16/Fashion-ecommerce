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

    public function index($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $cart = session()->get('cart', []);
        $wishlists = Wishlist::where('user_id',$id)->paginate(12);
        return view('user.design.wishlist',compact('wishlists', 'cart'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request): \Illuminate\Http\JsonResponse
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
