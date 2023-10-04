<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Attribute;
use Exception;

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
        $attributes = $attributes->paginate(6);
        return view('admin.attribute.list_data', compact('attributes'))->render();
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.attribute.create');
    }


    public function store(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'value' => 'required|max:255',
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
            Attribute::create($input);
            return redirect('admin/attribute/index')->with('success', 'Đã thêm thành công');
        } catch (Exception $e) {
            return redirect('admin/attribute/create')->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function edit($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $attribute = Attribute::where('slug', $slug)->first();
        return view('admin.attribute.edit', compact('attribute'));
    }


    public function update(Request $request, $id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
           $attributes = Attribute::find($id);
            $input = $request->all();
            unset($input['_token']);
           $attributes->update($input);
            return redirect('admin/attribute/index')->with('success', 'Đã sửa  thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }


    public function destroy($id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $attribute = Attribute::find($id);
        if ($attribute->product->count() > 0) {
            return redirect('admin/attribute/index')->with('error', 'Không thể xóa vì có sản phẩm đang sử dụng');
        }
        if (empty($attribute)) {
            return redirect('admin/attribute/index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $attribute->delete();
        return redirect('admin/attribute/index')->with('success', 'Xóa thành công');
    }
}
