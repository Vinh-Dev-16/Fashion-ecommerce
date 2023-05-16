<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use App\Models\admin\Product;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Session;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(6);
        Session::put('brand_url', request()->fullUrl() );
        return view('admin.brand.index', compact('brands'));
    }

        public function search(Request $request)
        {
            $output = "";
            $searches = Brand::where('name', 'like', '%' . $request->search . '%')->get();
    
            foreach ($searches as $result) {
                $name = $result->products->count()== 0 ? '<p>Chưa có sản phẩm</p>' : $result->products->count();
                $output .=
                    '<tr>
                   <td>' . $result->id . '</td>
                   <td>' . $result->name . '</td>
                   <td style="width:150px;height:120px;"><img class="logo_brand" src=" '. $result->logo .'"
                   alt='. "Logo của  $result->name " .'></td>
                   <td>'. $name. '</td>
                   <td class="table_crud" style="display:flex;justify-content:space-between;width:110px">' . '
                       <a href="' . route('admin.brand.edit', $result->id) . '" title="Sửa Category"
                       style="border: none;outline:none">
                       <i class="fa-solid fa-pen" style=" font-size:22px;"></i></a>
                       <a href="' . route('admin.brand.destroy', $result->id) . '" title="Xoa Category"
                       style="border:none;outline:none">
                       <i class="fa-solid fa-trash"
                       style="font-size:22px;"></i></a>
                  ' . '</td>
               </tr>';
            }
            return response($output);
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products  = Product::all();
        return view('admin.brand.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request ->isMethod('Post')){
            $rules = [
                'name' =>'required|max:255',
                'logo'=>'required',
                'description' =>'required',
            ];
            $messages = [
                'required' =>'Không được để trống trường này',
                'max' => 'Số kí tự nhập vượt quá giới hạn cho phép',
            ];
            $request -> validate($rules,$messages);
            try{
                $input = $request-> all();
                unset($input['_token']);
                Brand::create($input);
                if (Session::get('brand_url')) {
                    return redirect(session('brand_url'))->with('success', 'Đã thêm brand thành công');
                }
            }catch(Exception $e){
                return back()->withErrors($e->getMessage('error','Đã xảy ra lỗi'));
            }
        }
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
        $brand= Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
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
            $brands = Brand::find($id);
            $input = $request->all();
            unset($input['_token']);
            $brands->update($input);
            if (Session::get('brand_url')) {
                return redirect(session('brand_url'))->with('success', 'Đã sửa brand thành công');
            }
        } catch (Exception $e) {
            return redirect('admin/brand/edit/' . $id)->with('error', 'Đã xảy ra lỗi');
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
        $brands = Brand::find($id);
        $brands->delete();
        if (Session::get('brand_url')) {
            return redirect(session('brand_url'))->with('success', 'Đã xóa brand thành công');
        }
    }
}
