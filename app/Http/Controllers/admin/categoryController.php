<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\admin\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|string|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::paginate(6);
        if ($request->ajax()) {
            return $this->listData($request);
        }
        return view('admin.category.index', compact('categories'));
    }


    public function listData(Request $request): string
    {
        $categories = Category::query();
        if (!empty($request->search)) {
            $categories->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }
        $currentPage = $request->input('page', 1);
        Session::put('page', $currentPage);
        $categories = $categories->paginate(6, ['*'], 'page', $currentPage);
        return view('admin.category.list_data', compact('categories'))->render();
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::all();
        return view('admin.category.modal.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'name.max' => 'Tên danh mục không được quá 255 ký tự',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'slug.max' => 'Slug không được quá 255 ký tự',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ]);
        }
        try {
            $input = $request->all();
            unset($input['_token']);
            unset($input['page']);
            Category::create($input);
            $url = url('admin/category/index') . '?page=' . Session::get('page');
            return response()->json([
                'status' => 1,
                'message' => 'Thêm danh mục thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
          return response()->json([
                'status' => 2,
                'message' => 'Đã xảy ra lỗi',
          ]);
        }
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.category.modal.edit', compact('categories','category'));
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục không được quá 255 ký tự',
            'slug.required' => 'Slug không được để trống',
            'slug.max' => 'Slug không được quá 255 ký tự',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ]);
        }
        try {
            $category = Category::find($id);
            $input = $request->all();
            unset($input['_token']);
            unset($input['page']);
            $category->update($input);
            $url = url('admin/category/index') . '?page=' . Session::get('page');
            return response()->json([
                'status' => 1,
                'message' => 'Thêm danh mục thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 2,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }


    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $category = Category::find($id);
        if (empty($category)) {
           return response()->json([
                'status' => 0,
                'message' => 'Không tìm thấy danh mục',
           ]);
        }
        try {
            $category->delete();
            $url = url('admin/category/index') . '?page=' . Session::get('page');
            return response()->json([
                'status' => 1,
                'message' => 'Xóa danh mục thành công',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 2,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }
}
