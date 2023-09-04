<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class viewAllProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(4);
        if ($request->ajax()) {
            return view('user.design.view_all_product.list_data', compact('products'));
        }
        return view('user.design.view_all_product.index', compact('products'));
    }
}
