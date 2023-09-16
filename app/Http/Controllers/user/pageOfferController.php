<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class pageOfferController extends Controller
{
    public function index($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $cart = session()->get('cart', []);
        $product = Product::where('slug', $slug)->firstOrFail();
        $rate = $product->reviews()->pluck('feedbacks.rate')->avg();
        return view('user.design.page_offer.index', compact('product','rate', 'cart'));
    }

    public function love(Request $request): array
    {
      $product = Product::findOrFail($request->product_id);
      if ($request->love == 1) {
          Wishlist::create([
              'product_id' => $request->product_id,
              'user_id' => $request->user_id,
          ]);
          $count = Wishlist::where('user_id', $request->user_id)->count();
          return [
              'status ' => 1,
              'view' => view('user.design.page_offer.wishlist', compact('product'))->render(),
              'count' => $count,
          ];
      } else {
          Wishlist::where('product_id', $request->product_id)->where('user_id', $request->user_id)->delete();
          $count = Wishlist::where('user_id', $request->user_id)->count();
            return [
                'status ' => 0,
                'view' => view('user.design.page_offer.wishlist', compact('product'))->render(),
                'count' => $count,
            ];
      }

    }
}
