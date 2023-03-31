<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(6);
        Session::put('category_url', request()->fullUrl());
        return view('admin.category.index', compact('categories'));
    }


    public function search(Request $request)
    {
        $output = "";
        $searches = Category::where('name', 'like', '%' . $request->search . '%')->get();

        foreach ($searches as $result) {
            $name = $result->parent_id == 0? '<p>Không có</p>' : Category::find($result->parent_id)->name;
            $output .=
                '<tr>
               <td>' . $result->id . '</td>
               <td>' . $result->name . '</td>
               <td>'. $name. '</td>
               <td class="table_crud" style="display:flex;justify-content:space-between;width:110px">' . '
                   <a href="' . route('admin.category.edit', $result->id) . '" title="Sửa Category"
                   style="border: none;outline:none">
                   <i class="fa-solid fa-pen" style=" font-size:22px;"></i></a>
                   <a href="' . route('admin.category.destroy', $result->id) . '" title="Xoa Category"
                   style="border:none;outline:none">
                   <i class="fa-solid fa-trash"
                   style="font-size:22px;"></i></a>
              ' . '</td>
           </tr>';
        }
        return response($output);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
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
                'name' => 'required|max:255',
                'parent_id' => 'required',
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
            if (Session::get('category_url')) {
                return redirect(session('category_url'))->with('success', 'Đã thêm category thành công');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
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
        $categories = Category::find($id);
        $category = Category::all();
        return view('admin.category.edit', compact('categories','category'));
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
            $categories = Category::find($id);
            $input = $request->all();
            unset($input['_token']);
            $categories->update($input);
            if (Session::get('category_url')) {
                return redirect(session('category_url'))->with('success', 'Đã sửa category thành công');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
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
        $categories = Category::find($id);
        $categories->delete();
        if (Session::get('category_url')) {
            return redirect(session('category_url'))->with('success', 'Đã xóa category thành công');
        }
    }
}
