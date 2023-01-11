<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Models\Product;
class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('Post')){
          $request->validate([
            'name' =>'required|max:255',
            'price' =>'required|decimal:2,4',
            'made_by' =>'required',
            'made_day' =>'required|date',
            'thumbnail' =>'image|mimes:jpeg,png,jpg,gif',
            'size'=>'required',
            'color'=>'required',
            'id_year' =>'required|integer',
            'id_category' =>'required|integer',
            'id_brand' =>'required|integer',
            'discount' =>'required|decimal:2',
            'stock'=>'required|integer',
            'desce'=>'required'
          ]);
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
