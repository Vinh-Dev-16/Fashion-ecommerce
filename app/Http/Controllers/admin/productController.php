<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\admin\Brand;
use App\Models\Material;
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


    public function store(Request $request, ProductRequest $productRequest)
    {
       $validate = $productRequest->validated();

        // try {
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
            if (Session::get('products_url')) {
                return redirect(session('products_url'))->with('success', 'Đã thêm products thành công');
            }
        // } catch (Exception $e) {
        //     return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        // }
    }

    public function edit($slug)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $product = Product::where('slug', $slug)->first();
        $colors = ValueAttribute::where('attribute_id', '=', '2')->get();
        $sizes = ValueAttribute::where('attribute_id', '=', 1)->get();
        $selects = $product->categories()->pluck('categories.name', 'categories.id');
        $options = $product->attributevalues()->pluck('attribute_value.id', 'attribute_value.value');
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'selects', 'colors', 'sizes', 'options'));
    }


    public function update(Request $request, $id, ProductRequest $productRequest)
    {
        $validate = $productRequest->validated();
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
