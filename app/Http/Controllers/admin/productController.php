<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use Illuminate\Support\Str;
use App\Models\admin\Category;
use App\Models\admin\ValueAttribute;
use Exception;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Sắp xếp theo số lượng tồn kho để khi stock = 0 thì xử lý
        $products = Product::orderBy('stock')->paginate(6);
        $categories = Category::all();
        $count = Product::count();
        return view('admin.product.index', compact('products', 'categories', 'count'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = ValueAttribute::where('attribute_id', '=', '2')->get();
        $sizes = ValueAttribute::where('attribute_id', '=', 1)->get();
        return view('admin.product.create', compact('brands', 'categories','sizes','colors','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if ($request->isMethod('Post')) {
            $rules = [
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                'price' => 'required|integer',
                'tags' => 'required',
                'discount' => 'integer',
                'stock' => 'required|integer',
                'desce' => 'required',
                'brand_id' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
                'integer' => 'Trường nhập vào phải là số',
                'date' => 'Trường nhập vào phải là ngày tháng',

            ];
            $request->validate($rules, $messages);
        }
    try{
            $input = $request->all();
            unset($input['_token']);
            $products = Product::create($input);
            $products->categories()->attach($request->input('id_category'));
            $products->attributevalues()->attach($request->input('attribute_value_id'));
            return redirect('admin/product/index')->with('success', 'Đã thêm product thành công');
        } catch (Exception $e) {
            return redirect('admin/product/create')->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function search(Request $request)
    {
        $output = "";
        $searches = Product::where('name', 'like', '%' . $request->search . '%')->get();

        foreach ($searches as $result) {
            $output .=
                '<tr>
               <td>' . $result->id . '</td>
               <td>' . Str::of($result->name)->words(4) . '</td>
               <td>' . number_format($result->price) . ' VND</td>
               <td>' . $result->discount . '%</td>
               <td>' . $result->stock . '</td>
               <td class="table_crud" style="display:flex;justify-content:space-between;width:110px">' . '
                   <a href="' . route('admin.product.edit', $result->id) . '" title="Sửa Product"
                   style="border: none;outline:none">
                   <i class="fa-solid fa-pen" style="color: #f4f4f4; font-size:22px;"></i></a>
                   <a href="' . route('admin.product.destroy', $result->id) . '" title="Xoa Product"
                   style="border:none;outline:none">
                   <i class="fa-solid fa-trash"
                   style="color: #f4f4f; font-size:22px;"></i></a>
              ' . '</td>
           </tr>';
        }
        return response()->json($output);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::find($id);
        $colors = ValueAttribute::where('attribute_id', '=', '2')->get();
        $sizes = ValueAttribute::where('attribute_id', '=', 1)->get();
        $select = $products->categories()->pluck('categories.id');
        $select->all();
        return view('admin.product.edit', compact('products','categories','brands','select','colors','sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $products = Product::find($id);
            $input = $request->all();
            unset($input['_token']);
            $products->update($input);
            $products -> categories()->sync($request->input('id_category'));
            $products -> attributevalues()->sync($request->input('attribute_value_id'));
            return redirect('admin/product/index')->with('success', 'Đã sửa product thành công');
        } catch (Exception $e) {
            return redirect('admin/product/edit/' . $id)->with('error', 'Đã xảy ra lỗi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect('admin/product/index')->with('success', 'Đã xóa product thành công');
    }

    // Phần restore 
    public function viewRestore(){
        $restores = Product::onlyTrashed()->paginate(6);
        return view('admin.product.restore', compact('restores'));
    }

    public function restore($id){
        Product::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'Đã restore product thành công');
    }  

    public function delete($id){
        Product::onlyTrashed()->find($id)->forceDelete();
        $products = Product::find($id);
        $products->categories()->detach();
        $products->attributevalues()->detach();
        return back()->with('success', 'Đã xóa product thành công');
    }
}
