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

    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|string|\Illuminate\Contracts\Foundation\Application
    {
        $values = ValueAttribute::query();
        if ($request->ajax()) {
            return $this->listData($request);
        }
        $values = ValueAttribute::orderBy('attribute_id')->paginate(6);
        return view('admin.value.index', compact('values'));
    }

    public function listData(Request $request): string
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

    public function create(): string
    {
        $attributes = Attribute::all();
        return view('admin.value.modal.create', compact('attributes'))->render();
    }

    public function validate(Request $request, array $rules = [], array $messages = [], array $customAttributes = []): \Illuminate\Contracts\Validation\Validator|array
    {
        return Validator::make($request->all(), [
            'value' => 'required|max:255',
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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validate($request);
        if ($validator->fails()) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => $validator->errors()->toArray(),
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


    public function edit($id): string
    {
        $value = ValueAttribute::find($id);
        $attributes = Attribute::all();
        return view('admin.value.modal.edit', compact('value', 'attributes'))->render();
    }

    public function update(Request $request)
    {
        $validator = $this->validate($request);
        if ($validator->fails()) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => $validator->errors()->toArray(),
            ]);
        }
        $id = $request->id;
        try {
            $values = ValueAttribute::find($id);
            $input = $request->all();
            unset($input['_token']);
            $values->update($input);
            $url = url('admin/value/index') . '?page=' . Session::get('page_value');
            return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Cập nhật giá trị thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $value = ValueAttribute::find($id);
        if (empty($value)) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => 'Không tìm thấy giá trị',
            ]);
        }
        try {
            $value->delete();
            $url = url('admin/value/index') . '?page=' . Session::get('page_value');
            return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Xóa giá trị thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }

    }
}
