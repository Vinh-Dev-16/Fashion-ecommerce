<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use Illuminate\Support\Str;
use App\Models\admin\Category;
use App\Models\admin\Image;
use App\Models\admin\ValueAttribute;
use App\Models\Voucher;
use Exception;
use Illuminate\Support\Facades\Session;

class productController extends Controller
{

    public function index(Request $request)
    {
        // Sắp xếp theo số lượng tồn kho để khi stock = 0 thì xử lý
        $products = Product::query();
        if ($request->ajax()) {
            return $this->listData($request);
        }
        $products = $products->paginate(6);
        return view('admin.product.index', compact('products',));
    }

    public function listData(Request $request): string
    {
        $products = Product::query();
        if (!empty($request->search)) {
            $products->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('price', 'like', '%' . $request->search . '%')
                ->orWhere('stock', 'like', '%' . $request->search . '%')
                ->orWhere('discount', 'like', '%' . $request->search . '%');
        }

        $products = $products->paginate(6);
        return view('admin.product.list_data', compact('products'))->render();
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = ValueAttribute::where('attribute_id', '=', '2')->get();
        $sizes = ValueAttribute::where('attribute_id', '=', 1)->get();
        return view('admin.product.create', compact('brands', 'categories', 'sizes', 'colors', 'brands'));
    }


    public function store(Request $request)
    {
        if ($request->isMethod('Post')) {
            $rules = [
                'name' => 'required|max:255',
                'price' => 'required|integer',
                'stock' => 'required|integer',
                'desce' => 'required',
                'brand_id' => 'required',
                'value' => 'required',
                'percent' => 'required',
                'path' => 'required',
                'quantity' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
                'integer' => 'Trường nhập vào phải là số',
            ];
            $request->validate($rules, $messages);
        }
        try {
            $input = $request->all();
            unset($input['_token']);
            $products = Product::create($input);
            $products->categories()->attach($request->input('id_category'));
            $products->attributevalues()->attach($request->input('attribute_value_id'));
            for ($i = 0; $i < count($request->value); $i++) {
                Voucher::create([
                    'value' => $request->value[$i],
                    'product_id' => $products->id,
                    'quantity' => $request->quantity[$i],
                    'percent' => $request->percent[$i],
                ]);
            }
            for ($j = 0; $j < count($request->path); $j++) {
                Image::create([
                    'path' => $request->path[$j],
                    'product_id' => $products->id,
                ]);
            }
            if (Session::get('products_url')) {
                return redirect(session('products_url'))->with('success', 'Đã thêm products thành công');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::find($id);
        $colors = ValueAttribute::where('attribute_id', '=', '2')->get();
        $sizes = ValueAttribute::where('attribute_id', '=', 1)->get();
        $selects = $products->categories()->pluck('categories.name', 'categories.id');
        $options = $products->attributevalues()->pluck('attribute_value.id', 'attribute_value.value');
        return view('admin.product.edit', compact('products', 'categories', 'brands', 'selects', 'colors', 'sizes', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $products = Product::find($id);
            $input = $request->all();
            unset($input['_token']);
            $products->update($input);
            $products->categories()->sync($request->input('id_category'));
            $products->attributevalues()->sync($request->input('attribute_value_id'));
            $vouchers = Voucher::where('product_id', $products->id)->get();
            if (!empty($request->value)) {
                for ($i = 0; $i < count($request->value); $i++) {
                    foreach ($vouchers as $voucher) {
                        $voucher->value = $request->value[$i];
                        $voucher->quantity = $request->quantity[$i];
                        $voucher->percent = $request->percent[$i];
                        $voucher->save();
                    }
                }
            }
            $images = Image::where('product_id', $products->id)->get();

            for ($j = 0; $j < count($request->path); $j++) {
                foreach ($images as $image) {
                    $image->path = $request->path[$j];
                    $image->save();
                }
            }
            if (Session::get('products_url')) {
                return redirect(session('products_url'))->with('success', 'Đã sửa products thành công');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        if ($products->orderDetails->count() > 0) {
            if (Session::get('products_url')) {
                return redirect(session('products_url'))->with('error', 'Sản phẩm đang có đơn đặt hàng');
            }
        } else {
            $products->delete();
            if (Session::get('products_url')) {
                return redirect(session('products_url'))->with('success', 'Đã xóa mềm products thành công');
            }
        }
    }

    // Phần restore
    public function viewRestore()
    {
        $restores = Product::onlyTrashed()->paginate(6);
        return view('admin.product.restore', compact('restores'));
    }

    public function restore($id)
    {
        Product::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'Đã restore product thành công');
    }

    public function delete($id)
    {
        $products = Product::find($id);
        $products->categories()->detach();
        $products->attributevalues()->detach();
        $images = Image::where('product_id', $products->id)->get();
        foreach ($images as $image) {
            $image->delete();
        }
        $vouchers = Voucher::where('product_id', $products->id)->get();
        foreach ($vouchers as $voucher) {
            $voucher->delete();
        }
        Product::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Đã xóa product thành công');
    }
}
