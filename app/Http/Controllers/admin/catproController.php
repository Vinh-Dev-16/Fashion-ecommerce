<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Category;
use App\Models\admin\CategoryProduct;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use Exception;

class catproController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catpro = CategoryProduct::paginate(6);
        return view('admin.catpro.index', compact('catpro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin.catpro.create', compact('categories', 'products'));
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
                'id_product' => 'required',
                'id_category' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',

            ];

            $request->validate($rules, $messages);
        }
        try {
            $input = $request->all();
            CategoryProduct::create($input);
            return redirect('admin/catpro/index')->with('thongbao', 'Đã thêm thành công');
        } catch (Exception $e) {
            return redirect('admin/catpro/create')->with('loi', 'Da loi');
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
        $catpro = CategoryProduct::find($id);
        $products = Product::all();
        $categories = Category::all();
        return view('admin.catpro.edit', compact('catpro', 'products', 'categories'));
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
            $products = Category::find($id);
            $input = $request->all();
            $products->update($input);
            return redirect('admin/catpro/index')->with('sua', 'Da sua');
        } catch (Exception $e) {
            return redirect('admin/catpro/edit/' . $id)->with('loi', 'Da loi');
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
        $categories = CategoryProduct::find($id);
        $categories->delete();
        return redirect('admin/catpro/index')->with('xoa', 'Da xoa');
    }
}
