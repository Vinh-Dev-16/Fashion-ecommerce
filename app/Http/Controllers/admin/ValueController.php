<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Attribute;
use App\Models\admin\ValueAttribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ValueController extends Controller
{

    public function index(Request $request)
    {
        $values = ValueAttribute::query();
        if ($request->ajax()) {
            return $this->listData($request);
        }
        $values = ValueAttribute::orderBy('attribute_id')->paginate(6);
        return view('admin.value.index', compact('values'));
    }

    public function listData(Request $request)
    {
        $values = ValueAttribute::query();
        if (!empty($request->search)) {
            $values->where('value', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }
        $currentPage = $request->input('page', 1);

        Session::put('page_value', $currentPage);
        $values = $values->orderBy('attribute_id');
        $values = $values->paginate(6, ['*'], 'page', $currentPage);
        return view('admin.value.list_data', compact('values'))->render();
    }

    public function create()
    {
        $attributes = Attribute::all();
        return view('admin.value.modal.create', compact('attributes'))->render();
    }

    public function validate(Request $request, array $rules = [], array $messages = [], array $customAttributes = [])
    {
        return Validator::make($request->all(), [
            'value' => 'required|unique:values|max:255',
            'attribute_id' => 'required'
        ], [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại',
            'max' => ':attribute không được quá 255 ký tự',
            'attribute_id.required' => 'Vui lòng chọn attribute'
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request);
        if ($validate->fails()) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => $validate->errors()->toArray(),
            ]);
        }
        try {
            $input = $request->all();
            unset($input['_token']);
            ValueAttribute::create($input);
            $url = url('admin/value/index') . '?page=' . Session::get('page_value');
            return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Thêm attribute value thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $values = ValueAttribute::find($id);
        $attributes = Attribute::all();
        return view('admin.value.edit', compact('values', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $values = ValueAttribute::find($id);
        $values->delete();
        return redirect('admin/value/index')->with('success', 'Đã xóa value thành công');
    }
}
