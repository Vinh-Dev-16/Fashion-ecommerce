<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Image;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class imagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderBy('product_id')->paginate(6);
        Session::put('image_url', request()->fullUrl());
        return view('admin.images.index', compact('images'));
    }

    public function search(Request $request)
    {
        $output = "";
        $searches = Product::where('name', 'like', '%' . $request->search . '%')->get();
        foreach ($searches as $result) {
           $key = Image::where('product_id', $result->id)->get();
           foreach($key as $images) {
            $name = Str::of($images->products->name)->words(4);
            $path = '<img  style="display:flex;justify-content:space-between;width:110px" src=" '. $images->path. '" alt="'. $name.'">.';
            $output .=
                '<tr>
              <td> '. $images->id. ' </td>
               <td>'. $path . '</td>
               <td> '. $name. ' </td>
               <td class="table_crud" style="display:flex;justify-content:space-between;width:110px">' . '
                   <a href="' . route('admin.images.edit', $images->id) . '" title="Sửa image"
                   style="border: none;outline:none">
                   <i class="fa-solid fa-pen" style=" font-size:22px;"></i></a>
                   <a href="' . route('admin.images.destroy', $images->id) . '" title="Xoa image"
                   style="border:none;outline:none">
                   <i class="fa-solid fa-trash"
                   style="font-size:22px;"></i></a>
              ' . '</td>
           </tr>';
        }
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
        $images = Image::all();
        $products = Product::all();
        return view('admin.images.create', compact('images','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'path' => 'required|max:255',
                'product_id' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
                'max' => 'Đã vượt qua số từ cho phép',
            ];
            $request->validate($rules, $messages);
        }
        try {
            $input = $request->all();
            unset($input['_token']);
            Image::create($input);
            if (Session::get('image_url')) {
                return redirect(session('image_url'))->with('success', 'Đã thêm image thành công');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
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
        $images = Image::find($id);
        $products = Product::all();
        return view('admin.images.edit', compact('images','products'));
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
            $images = Image::find($id);
            $input = $request->all();
            unset($input['_token']);
            $images->update($input);
            if (Session::get('image_url')) {
                return redirect(session('image_url'))->with('success', 'Đã sửa image thành công');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
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
        $images = Image::find($id);
        $images->delete();
        if (Session::get('image_url')) {
            return redirect(session('image_url'))->with('success', 'Đã xóa image thành công');
        }
    }
}
