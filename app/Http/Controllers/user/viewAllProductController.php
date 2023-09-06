<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            if ($request->category) {
                $products = $products->whereHas('categories', function ($query) use ($request) {
                    $query->where('id_category', $request->category);
                });
            }
            if ($request->brand) {
                $products = $products->where('brand_id', $request->brand);
            }
            if ($request->size) {
                $products->whereHas('attributevalues', function ($query) use ($request) {
                    $query->where('attribute_value_id', $request->size);
                });
            }

            if ($request->color) {
                $products->whereHas('attributevalues', function ($query) use ($request) {
                    $query->where('attribute_value_id', $request->color);
                });
            }

            if ($request->price) {
                switch ($request->price) {
                    case '1':
                        $products = $products->where(function($query)  {
                            $query->where(DB::raw('(price - (price * discount / 100))'), '<', '100000');
                        });
                        break;
                    case '2':
                        $products = $products->where(function($query)  {
                            $query->whereBetween(DB::raw('(price - (price * discount / 100))'), [100000, 500000]);
                        });
                        break;
                    case '3':
                        $products = $products->where(function($query)  {
                            $query->whereBetween(DB::raw('(price - (price * discount / 100))'), [500000, 1000000]);
                        });
                        break;
                    case '4':
                        $products = $products->where(function($query)  {
                            $query->whereBetween(DB::raw('(price - (price * discount / 100))'), [1000000, 5000000]);
                        });
                        break;
                    case '5':
                        $products = $products->where(function($query)  {
                            $query->where(DB::raw('(price - (price * discount / 100))'), '>', '5000000');
                        });
                        break;
                }
            }

            $products = $products->paginate(4);
            return view('user.design.view_all_product.list_data', compact('products'))->render();
        }
            $products = $products->paginate(4   );
        return view('user.design.view_all_product.index', compact('products'));
    }


}
