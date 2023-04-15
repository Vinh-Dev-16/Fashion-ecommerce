<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Session;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = User::orderBy('role_id')->paginate(6);
        Session::put('admin_url', request()->fullUrl());
        return view('admin.account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $accounts = User::find($id);
        $roles = Role::all();
        return view('admin.account.edit', compact('accounts','roles'));
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
        try{
        $accounts = User::find($id);
        $input  = $request->all();
        unset($input['_token']);
        $accounts->update($input);
        if (Session::get('admin_url')) {
            return redirect(session('admin_url'))->with('success', 'Đã sửa vai trò thành công');
        }
        }catch(Exception $e){
            return redirect()->back()>with('error', 'Đã xảy ra lỗi');
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
