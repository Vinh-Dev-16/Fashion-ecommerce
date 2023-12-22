<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\admin\Brand;
use App\Models\admin\Category;
use App\Models\admin\Image;
use App\Models\admin\Product;
use App\Models\admin\ValueAttribute;
use App\Models\Material;
use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $currentPage = $request->input('page', 1);
        Session::put('page_product', $currentPage);
        $products = $products->paginate(6, ['*'], 'page', $currentPage);
        return view('admin.product.list_data', compact('products'))->render();
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = ValueAttribute::where('attribute_id', '=', '2')->get();
        $sizes = ValueAttribute::where('attribute_id', '=', 1)->get();
        return view('admin.product.modal.create',
            compact('brands', 'categories', 'sizes', 'colors', 'brands'))->render();
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'unique:products|required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'desce' => 'required',
            'brand_id' => 'required',
            'path' => 'required',
            'sale' => 'required|integer',
            'tags' => 'required',
            'material' => 'required',
            'weight' => 'required|integer',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'slug.unique' => 'Tên sản phẩm đã tồn tại',
            'slug.required' => 'Slug không được để trống',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.integer' => 'Giá sản phẩm phải là số',
            'stock.required' => 'Số lượng sản phẩm không được để trống',
            'stock.integer' => 'Số lượng sản phẩm phải là số',
            'desce.required' => 'Mô tả sản phẩm không được để trống',
            'brand_id.required' => 'Thương hiệu sản phẩm không được để trống',
            'sale.integer' => 'Giảm giá sản phẩm phải là số',
            'tags.required' => 'Tags sản phẩm không được để trống',
            'material.required' => 'Chất liệu sản phẩm không được để trống',
            'weight.required' => 'Trọng lượng sản phẩm không được để trống',
            'weight.integer' => 'Trọng lượng sản phẩm phải là số',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ]);
        }

        try {
            $input = $request->all();
            unset($input['_token']);
            $products = Product::create($input);
            $products->categories()->attach($request->input('id_category'));
            $products->attributevalues()->attach($request->input('attribute_value_id'));
            for ($i = 0; $i < count($request->material); $i++) {
                Material::create([
                    'name' => $request->material[$i],
                    'product_id' => $products->id,
                ]);
            }
            for ($j = 0; $j < count($request->path); $j++) {
                Image::create([
                    'path' => $request->path[$j],
                    'product_id' => $products->id,
                ]);
            }
            return redirect()->route('admin.product.index')->with('success', 'Đã thêm sản phẩm thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function edit(Request $request)
    {
        $slug = $request->get('slug');
        $brands = Brand::all();
        $categories = Category::all();
        $product = Product::where('slug', $slug)->first();
        $colors = ValueAttribute::where('attribute_id', '=', '2')->get();
        $sizes = ValueAttribute::where('attribute_id', '=', 1)->get();
        $selects = $product->categories()->pluck('categories.name', 'categories.id');
        $options = $product->attributevalues()->pluck('attribute_value.id', 'attribute_value.value');
        return view('admin.product.modal.edit',
            compact('product', 'categories', 'brands', 'selects', 'colors', 'sizes', 'options'))
            ->render();
    }


    public function update(Request $request, ProductRequest $productRequest)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'unique:products|required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'desce' => 'required',
            'brand_id' => 'required',
            'path' => 'required',
            'sale' => 'required|integer',
            'tags' => 'required',
            'material' => 'required',
            'weight' => 'required|integer',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'slug.unique' => 'Tên sản phẩm đã tồn tại',
            'slug.required' => 'Slug không được để trống',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.integer' => 'Giá sản phẩm phải là số',
            'stock.required' => 'Số lượng sản phẩm không được để trống',
            'stock.integer' => 'Số lượng sản phẩm phải là số',
            'desce.required' => 'Mô tả sản phẩm không được để trống',
            'brand_id.required' => 'Thương hiệu sản phẩm không được để trống',
            'sale.integer' => 'Giảm giá sản phẩm phải là số',
            'tags.required' => 'Tags sản phẩm không được để trống',
            'material.required' => 'Chất liệu sản phẩm không được để trống',
            'weight.required' => 'Trọng lượng sản phẩm không được để trống',
            'weight.integer' => 'Trọng lượng sản phẩm phải là số',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ]);
        }

        $id = $request->get('id');
        try {
            $product = Product::find($id);
            $input = $request->all();
            unset($input['_token']);
            $product->update($input);
            $product->categories()->sync($request->input('id_category'));
            $product->attributevalues()->sync($request->input('attribute_value_id'));

            $images = Image::where('product_id', $product->id)->get();
            $imageNames = $request->path;

            $existingMaterials = Material::where('product_id', $product->id)->get();
            $materialNames = $request->material;


            $existingMaterialNames = $existingMaterials->pluck('name')->toArray();

            foreach ($materialNames as $materialName) {

                if (in_array($materialName, $existingMaterialNames)) {

                    Material::where('product_id', $product->id)
                        ->where('name', $materialName)
                        ->update(['name' => $materialName]);
                } else {

                    Material::create([
                        'name' => $materialName,
                        'product_id' => $product->id,
                    ]);
                }
            }

            Material::where('product_id', $product->id)
                ->whereNotIn('name', $materialNames)
                ->delete();

            $existingImageNames = $images->pluck('path')->toArray();
            foreach ($imageNames as $imageName) {
                if (in_array($imageName, $existingImageNames)) {
                    Image::where('product_id', $product->id)
                        ->where('path', $imageName)
                        ->update(['path' => $imageName]);
                } else {
                    Image::create([
                        'path' => $imageName,
                        'product_id' => $product->id,
                    ]);
                }
            }
            Image::where('product_id', $product->id)
                ->whereNotIn('path', $imageNames)
                ->delete();


            return redirect()->route('admin.product.index')->with('success', 'Đã cập nhật sản phẩm thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function destroy($id)
    {
        $products = Product::find($id);
        if ($products->orderDetails->count() > 0) {
            return back()->with('error', 'Không thể xóa vì đã có đơn hàng');
        } else {
            $products->delete();
            return redirect()->route('admin.product.index')->with('success', 'Đã xóa sản phẩm thành công');
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
