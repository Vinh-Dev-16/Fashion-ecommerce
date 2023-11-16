<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\admin\Brand;
use App\Models\admin\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class brandController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->listData($request);
        }
        $brands = Brand::paginate(6);
        return view('admin.brand.index', compact('brands'));
    }

    public function listData(Request $request): string
    {
        $brands = Brand::query();
        if ($request->has('search')) {
            $brands->where('name', 'like', '%'.$request->get('search').'%')
                ->orWhere('slug', 'like', '%'.$request->get('search').'%');
        }
        $currentPage = $request->input('page', 1);
        Session::put('page', $currentPage);
        $brands = $brands->paginate(6, ['*'], 'page', $currentPage);
        return view('admin.brand.list_data', compact('brands'))->render();
    }

    public function create(): string
    {
        $products = Product::all();
        $vouchers = Voucher::all();
        return view('admin.brand.modal.create', compact('products', 'vouchers'))->render();
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:brands|max:255',
            'slug'        => 'required|unique:brands|max:255',
            'logo'        => 'required|max:2048',
            'description' => 'required',
        ],
            [
                'name.required'        => 'Tên brand không được để trống',
                'name.unique'          => 'Tên brand đã tồn tại',
                'name.max'             => 'Tên brand không được quá 255 ký tự',
                'slug.required'        => 'Slug không được để trống',
                'slug.unique'          => 'Slug đã tồn tại',
                'slug.max'             => 'Slug không được quá 255 ký tự',
                'logo.required'        => 'Logo không được để trống',
                'logo.max'             => 'Logo không được quá 2048 ký tự',
                'description.required' => 'Mô tả không được để trống',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => STATUS_ERROR,
                'message' => $validator->errors()->toArray(),
            ]);
        }
        try {
            $input = $request->all();
            unset($input['_token']);
            $brand =  Brand::create($input);
            $brand->vouchers()->attach($request->value);
            $url   = url('admin/brand/index').'?page='.Session::get('page');
            return response()->json([
                'status'  => STATUS_SUCCESS,
                'message' => 'Thêm brand thành công',
                'url'     => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }

    public function edit($id
    ): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application {
        $brand = Brand::find($id);
        $vouchers = Voucher::all();
        return view('admin.brand.modal.edit', compact('brand', 'vouchers'));
    }


    public function update(Request $request)
    {
        $id        = $request->id;
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:255',
            'slug'        => 'required|max:255',
            'logo'        => 'max:2048',
            'description' => 'required',
        ],
            [
                'name.required'        => 'Tên brand không được để trống',
                'name.unique'          => 'Tên brand đã tồn tại',
                'name.max'             => 'Tên brand không được quá 255 ký tự',
                'slug.required'        => 'Slug không được để trống',
                'slug.unique'          => 'Slug đã tồn tại',
                'slug.max'             => 'Slug không được quá 255 ký tự',
                'logo.required'        => 'Logo không được để trống',
                'logo.max'             => 'Logo không được quá 2048 ký tự',
                'description.required' => 'Mô tả không được để trống',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => STATUS_ERROR,
                'message' => $validator->errors()->toArray(),
            ]);
        }
        try {
            $brand = Brand::find($id);
            $input  = $request->all();
            unset($input['_token']);
            $brand->update($input);
            $brand->vouchers()->sync($request->value);
            $url = url('admin/brand/index').'?page='.Session::get('page');
            return response()->json([
                'status'  => STATUS_SUCCESS,
                'message' => 'Cập nhật brand thành công',
                'url'     => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id    = $request->id;
        $brand = Brand::find($id);
        if (empty($brand)) {
            return response()->json([
                'status'  => STATUS_ERROR,
                'message' => 'Không tìm thấy thương hiệu',
            ]);
        }
        try {
            $brand->vouchers()->detach();
            $brand->delete();
            $url = url('admin/brand/index').'?page='.Session::get('page');
            return response()->json([
                'status'  => STATUS_SUCCESS,
                'message' => 'Xóa thương hiệu thành công',
                'url'     => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }
}
