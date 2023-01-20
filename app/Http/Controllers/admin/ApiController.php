<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        return $categories;
    }
}
