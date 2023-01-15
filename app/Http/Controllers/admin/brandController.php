<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Brand;
use App\Models\admin\Product;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

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

        return view('admin.brand.index', compact('brands'));
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
                'product_id' =>'required',
                'logo'=>'required',
            ];
            $messages = [
                'required' =>'Không được để trống trường này',
                'max' => 'Số kí tự nhập vượt quá giới hạn cho phép',
            ];
            $request -> validate($rules,$messages);
            try{
                $input = $request-> all();
                Brand::create($input);
                return redirect('admin/brand/index')->with('success','Brand cập nhập thành công');
            }catch(Exception $e){
                return back()->withErrors($e->getMessage('Đã xảy ra lỗi'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
