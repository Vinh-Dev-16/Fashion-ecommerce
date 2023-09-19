<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
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


    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required|max:255',
                'parent_id' => 'required',
                'slug'=> 'required',
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
            Category::create($input);
            return redirect()->route('admin.category.index')->with('success', 'Đã thêm category thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::findOrFail($id);
        $category = Category::all();
        return view('admin.category.edit', compact('categories','category'));
    }


    public function update(Request $request, $id)
    {
        try {
            $categories = Category::find($id);
            $input = $request->all();
            unset($input['_token']);
            $categories->update($input);
            return redirect()->route('admin.category.index')->with('success', 'Đã sửa category thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }


    public function destroy($id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return redirect()->route('admin.category.index')->with('success', 'Đã xóa category thành công');
    }
}
