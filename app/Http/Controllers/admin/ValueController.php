<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\ValueAttribute;
use App\Models\admin\Attribute;
use Illuminate\Http\Request;
use Exception;
class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ValueAttribute::orderBy('attribute_id')->paginate(6);
        return view('admin.value.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $values = Attribute::all();
        return view('admin.value.create', compact('values'));
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
                'value' => 'required|max:255',
                'attribute_id' => 'required',
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
            ValueAttribute::create($input);
            return redirect('admin/value/index')->with('success', 'Đã thêm value thành công');
        } catch (Exception $e) {
            return redirect('admin/value/create')->with('error', 'Đã xảy ra lỗi');
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
        $values = ValueAttribute::find($id);
        $attributes = Attribute::all();
        return view('admin.value.edit', compact('values','attributes'));
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
            $values = ValueAttribute::find($id);
             $input = $request->all();
             unset($input['_token']);
            $values->update($input);
             return redirect('admin/value/index')->with('success', 'Đã sửa attribute value thành công');
         } catch (Exception $e) {
             return redirect('admin/value/edit/' . $id)->with('error', 'Đã xảy ra lỗi');
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
        $values = ValueAttribute::find($id);
        $values->delete();
        return redirect('admin/value/index')->with('success', 'Đã xóa value thành công');
    }
}
