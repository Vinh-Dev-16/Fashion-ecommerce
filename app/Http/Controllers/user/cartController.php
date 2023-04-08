<?php

namespace App\Http\Controllers\user;
use App\Models\admin\Product;
use App\Http\Controllers\Controller;
use App\Models\admin\ValueAttribute;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use Illuminate\Http\Request;

class cartController extends Controller
{

    public function viewCart(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.cart',compact('brands','products','categories','cart'));
    }

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

    public function deleteCart($id){
        $tmpCart = collect(session('cart', []));
        $cart = $tmpCart->filter(function ($item) use ($id) {
            return $item['product']->id != $id;
        })->values();
        session()->put('cart', $cart->toArray()); 
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('user.design.cart',compact('cart','brands','products','categories'));
    }

    public function checkOut(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.checkout',compact('brands','products','categories','cart'));                
    }

    public function payment(Request $request, $id){

        if ($request->isMethod('Post')) {
            $rules = [
                'color' => 'required',
                'size' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
            ];
            $request->validate($rules, $messages);
        }

        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        $product = Product::find($id);
        $quantity = $request->stock;
        $size = ValueAttribute::find($request->size)->value;
        $color = ValueAttribute::find($request->color)->value;
        $image = Product::find($id)->images->first()->path;

        return view('user.design.payment',compact('brands','products','categories','cart','product','size','color','image','quantity'));                
    }
}
