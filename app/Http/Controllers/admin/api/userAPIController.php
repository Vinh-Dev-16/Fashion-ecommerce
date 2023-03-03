<?php

namespace App\Http\Controllers\admin\api;

use App\Http\Controllers\admin\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class userAPIController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(6);
        return response()->json([
            'status' =>'success',
            'results' => $users,
            'message' => trans('admin.message_add_success'),
        ]);
    }
}
