<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\admin\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $categories = $categories->paginate(6);
        return view('admin.category.list_data', compact('categories'))->render();
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }


    public function store(Request $request, CategoryRequest $categoryRequest): \Illuminate\Http\RedirectResponse
    {
        $categoryRequest->validated();
        try {
            $input = $request->all();
            unset($input['_token']);
            Category::create($input);
            return redirect()->route('admin.category.index')->with('success', 'Đã thêm danh mục thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function edit($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::where('slug', $slug)->first();
        $category = Category::all();
        return view('admin.category.edit', compact('categories','category'));
    }


    public function update(Request $request, $id, CategoryRequest $categoryRequest): \Illuminate\Http\RedirectResponse
    {
        $categoryRequest->validated();
        try {
            $categories = Category::find($id);
            $input = $request->all();
            unset($input['_token']);
            $categories->update($input);
            return redirect()->route('admin.category.index')->with('success', 'Đã sửa danh mục thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }


    public function destroy($id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return redirect()->route('admin.category.index')->with('success', 'Đã xóa danh mục thành công');
    }
}
