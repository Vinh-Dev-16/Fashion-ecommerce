<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class roleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(6);
        Session::put('role-url', request()->fullUrl());
        return view('admin.role.index', compact('roles'));
    }



    public function create(){
        if (auth()->user()->can('create-role')) {
            $permissions = Permission::all();
            return view('admin.role.create', compact('permissions'));
        } else {
            return abort(403);
        }
    }


    public function store(Request $request){
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required',
                'slug' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
            ];
            $request->validate($rules, $messages);
        }

        try{
            $data = $request->all();
            unset($data['_token']);
            unset($data['permission_id']);
            $role = Role::create($data);
            $role->permissions()->attach($request->input('permission_id'));
            if (Session::get('role-url')) {
                return redirect(session('role-url'))->with('success', 'Đã thêm role thành công');
            }
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }


    public function edit($slug){
        if (auth()->user()->can('edit-role')) {
            $role = Role::where('slug', $slug)->first();
            $permissions = Permission::all();
            $selectedID = $role->permissions->pluck('id')->toArray();
            return view('admin.role.edit', compact( 'role', 'permissions', 'selectedID'));
        } else {
            return abort(403);
        }
    }


    public function update(Request $request,$id){
        $data = $request->all();
        try{
            $role = Role::find($id);
            $role->update($data);
            $role->permissions()->sync($request->input('permission_id'));
            if (Session::get('role-url')) {
                return redirect(session('role-url'))->with('success', 'Đã sửa role thành công');
            }
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id) {
        if (auth()->user()->can('delete-role')) {
            try{
                $role =  Role::find($id);
                $role->permissions()->detach();
                $role->delete();
                if (Session::get('role-url')) {
                    return redirect(session('role-url'))->with('success', 'Đã xóa role thành công');
                }
            }catch(Exception $e){
                return back()->with('error', $e->getMessage());
            }
        } else {
            return abort(403);
        }
    }
}
