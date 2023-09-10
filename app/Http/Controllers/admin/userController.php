<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Session;
class userController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        Session::put('user-url', request()->fullUrl());
        $users = User::paginate(6);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function role($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.role', compact('roles', 'user'));
    }


    public function doRole(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($id);
        $user->roles()->sync($request->role_id);
        $users = User::paginate(6);
        return view('admin.user.index', compact('users'))->with('success', 'Đã sửa role');
    }
    public function permission($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($id);
        $permissions = Permission::all();
        return view('admin.user.permission', compact('permissions', 'user'));
    }

    public function doPermission($id, Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($id);
        $permissionIDs = $request->permission_id;

        if (empty($permissionIDs)) {
            $user->permissions()->detach();
        } elseif(count($permissionIDs) > count($user->permissions)) {
            foreach ($permissionIDs as $permission){
                $user->permissions()->attach($permission);
            }
        } else {
            foreach ($permissionIDs as $permission){
                $user->permissions()->sync($permission);
            }
        }

        $users = User::paginate(6);
        return view('admin.user.index', compact('users'))->with('success', 'Đã sửa permission');
    }

    public function destroy($id)
    {
        $accounts = User::find($id);
        $infomation = Information::where('user_id', $id)->first();
        $infomation->delete();
        $accounts->delete();
        if (Session::get('admin_url')) {
            return redirect(session('admin_url'))->with('success', 'Đã xóa mềm User thành công');
        }
    }

     // Phần restore
     public function viewRestore(){
        $restores = User::onlyTrashed()->paginate(6);
        return view('admin.account.restore', compact('restores'));
    }

    public function restore($id){
        User::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'Đã restore user thành công');
    }

    public function delete($id){
        User::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Đã xóa user thành công');
    }
}
