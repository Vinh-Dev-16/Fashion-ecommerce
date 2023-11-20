<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Attribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class attributeController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|string|\Illuminate\Contracts\Foundation\Application
    {
        $attributes = Attribute::query();
        if ($request->ajax()) {
            return $this->listData($request);
        }
        $attributes = Attribute::paginate(6);
        return view('admin.attribute.index', compact('attributes'));
    }

    public function listData(Request $request): string
    {
        $attributes = Attribute::query();
        if (!empty($request->search)) {
            $attributes->where('value', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }
        $currentPage = $request->input('page', 1);
        Session::put('page_attribute', $currentPage);
        $attributes = $attributes->paginate(6, ['*'], 'page', $currentPage);
        return view('admin.attribute.list_data', compact('attributes'))->render();
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|string
    {
        return view('admin.attribute.create')->render();
    }

    public function validate(Request $request, array $rules = [], array $messages = [], array $customAttributes = []): \Illuminate\Contracts\Validation\Validator|array
    {
        return Validator::make($request->all(), [
            'value' => 'required|unique:attributes|max:255',
        ], [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại',
            'max' => ':attribute không được quá 255 ký tự',
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validate($request);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => STATUS_ERROR,
                    'message' => $validator->errors()->toArray(),
                ]
            );
        }
        try {
            $input = $request->all();
            unset($input['_token']);
            Attribute::create($input);
            $url = url('admin/attribute/index?page=' . Session::get('page_attribute', 1));
            return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Thêm thuộc tính thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $attribute = Attribute::where('id', $id)->first();
        return view('admin.attribute.edit', compact('attribute'));
    }


    public function update(Request $request, $id)
    {
        $validator = $this->validate($request);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => STATUS_ERROR,
                    'message' => $validator->errors()->toArray(),
                ]
            );
        }
        try {
            $attributes = Attribute::find($id);
            $input = $request->all();
            unset($input['_token']);
            $attributes->update($input);
            $url = url('admin/attribute/index?page=' . Session::get('page_attribute', 1));
            return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Sửa thuộc tính thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }


    public function destroy(Request $request)
    {
        $id = request()->input('id');
        $attribute = Attribute::find($id);
        if (empty($attribute)) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => 'Không tìm thấy thuộc tính',
            ]);
        }
        if (empty($attribute->valuesAttributes)) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => 'Không thể xóa vì đã có giá trị thuộc tính',
            ]);
        }

        try {
            $attribute->delete();
            $url = url('admin/attribute/index') . '?page=' . Session::get('page_attribute');
            return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Xóa thuộc tính thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }

    }
}
