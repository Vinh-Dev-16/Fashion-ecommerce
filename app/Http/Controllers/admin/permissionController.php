<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class permissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(6);
        Session::put('permission-url', request()->fullUrl());
        return view('admin.permission.index', compact('permissions'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()->can('create-permission')) {
            $roles = Role::all();
            return view('admin.permission.create', compact('roles'));
        } else {
            return view('403')->with('error', 'Bạn không có quyền truy cập vào đây');
        }
    }

    public function store(Request $request)
    {

        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required',
                'slug' => 'required',
                'role_id' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
            ];
            $request->validate($rules, $messages);
        }

        try {
            $data = $request->all();
            unset($data['_token']);
            unset($data['role_id']);
            $permission = Permission::create($data);
            $permission->roles()->attach($request->input('role_id'));
            if (Session::get('permission-url')) {
                return redirect(session('permission-url'))->with('success', 'Đã thêm permission thành công');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($slug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()->can('edit-permission')) {
            $permission = Permission::where('slug', $slug)->first();
            $roles = Role::all();
            $selectedID = $permission->roles->pluck('id')->toArray();
            return view('admin.permission.edit', compact( 'roles', 'permission', 'selectedID'));
        } else {
            return abort(403);
        }
    }


    public function update(Request $request,$id){
        $data = $request->all();
        try{
            $permission = Permission::find($id);
            $permission->update($data);
            $permission->roles()->sync($request->input('role_id'));
            if (Session::get('permission-url')) {
                return redirect(session('permission-url'))->with('success', 'Đã sửa permission thành công');
            }
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id) {
        if (auth()->user()->can('delete-permission')) {
            try{
                $permission =  Permission::find($id);
                $permission->roles()->detach();
                $permission->delete();
                if (Session::get('permission-url')) {
                    return redirect(session('permission-url'))->with('success', 'Đã xóa permission thành công');
                }
            }catch(Exception $e){
                return back()->with('error', $e->getMessage());
            }
        } else {
            return abort(403);
        }
    }
}
