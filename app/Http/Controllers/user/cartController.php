<?php

namespace App\Http\Controllers\user;
use App\Models\admin\Product;
use App\Http\Controllers\Controller;
use App\Models\admin\ValueAttribute;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function addToCart(Request $request, $id)
    {


        $cart = collect(session('cart', []));
        $foundIndex = $cart->search(function ($item, $index) use ($id) {
            return $item['product']->id == $id;
        });
        $cart = $cart->toArray();
        if ($foundIndex !== false && $foundIndex >= 0) {
            $cart[$foundIndex]['quantity'] += ($request->quantity);
        } else {
            array_push($cart, [
                'product' => Product::find($id),
                'quantity' => $request->quantity,
                'size' => ValueAttribute::find($request->size)->value,
                'color' => ValueAttribute::find($request->color)->value,
                'image' => Product::find($id)->images->first()->path,
            ]);
        }
        session()->put('cart', $cart);
        return response()->json([
            'cart'=>$cart,
        ]);
    }

    public function removeCart($id){        
        $cart = collect(session('cart', []));
        $tmpCart = $cart->filter(function ($item) use ($id) {
            return $item['product']->id != $id;
        })->values();
        session()->put('cart', $tmpCart->toArray());
        
        return response()->json([
            'cart'=>$tmpCart,
        ]);
    }
}
