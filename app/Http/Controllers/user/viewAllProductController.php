<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class viewAllProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();
        if ($request->ajax()) {
            if ($request->sort) {
                switch ($request->sort) {
                    case '1':
                        $products->orderBy('id', 'desc');
                        break;
                    case '2':
                        $products->orderByRaw('price - ((price * discount) / 100) asc');
                        break;
                    case '3':
                        $products->orderByRaw('price - ((price * discount) / 100) desc');
                        break;
                    case '4':
                        $products->orderBy('name', 'asc');
                        break;
                    case '5':
                        $products->orderBy('name', 'desc');
                        break;
                }
            }
                $products = $products->paginate(4);
            return view('user.design.view_all_product.list_data', compact('products'))->render();
        }
            $products = $products->paginate(4);
        return view('user.design.view_all_product.index', compact('products'));
    }


}
