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
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|string|\Illuminate\Contracts\Foundation\Application
    {
        $images = Image::query();
        if ($request->ajax()) {
            return $this->listData($request);
        }
        $images = $images->orderBy('product_id')->paginate(SIZE);
        return view('admin.images.index', compact('images'));
    }

    public function listData(Request $request): string
    {
        $images = Image::query();
        if (!empty($request->get('search'))) {
            $images->where('path', 'like', '%' . $request->get('search') . '%')
                ->orWhereHas('products', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->get('search') . '%');
                });
        }
        $currentPage = $request->input('page', 1);
        Session::put('page_image', $currentPage);
        $images->orderBy('product_id');
        $images = $images->paginate(SIZE, ['*'], 'page', $currentPage);
        return view('admin.images.list_data', compact('images'))->render();
    }

    public function create()
    {
        $images = Image::all();
        $products = Product::all();
        return view('admin.images.create', compact('images','products'));
    }



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
