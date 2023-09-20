<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\admin\Brand;
use App\Models\admin\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Exception;
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

    public function listData(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $brands = Brand::query();
        if ($request->has('search')) {
            $brands->where('name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('slug', 'like', '%' . $request->get('search') . '%');
        }
        $brands = $brands->paginate(6);
        return view('admin.brand.list_data', compact('brands'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $products  = Product::all();
        return view('admin.brand.create',compact('products'));
    }


    public function store(Request $request, BrandRequest $brandRequest)
    {
            $brandRequest->validated();
            try{
                $input = $request-> all();
                unset($input['_token']);
                $brand = Brand::create($input);
                if (!empty($input['value'])) {
                    for ($i = 0; $i < count($input['value']); $i++) {
                        $data = [
                            'brand_id' => $brand->id,
                            'value' => $input['value'][$i],
                            'quantity' => $input['quantity'][$i],
                            'percent' => $input['percent'][$i],
                        ];
                        Voucher::create($data);
                    }
                }
               return redirect()->route('admin.brand.index')->with('success','Đã thêm brand thành công');
            }catch(Exception $e){
                return back()->withErrors($e->getMessage('error','Đã xảy ra lỗi'));
            }

    }

    public function edit($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $brand= Brand::where('slug',$slug)->first();
        return view('admin.brand.edit',compact('brand'));
    }


    public function update(Request $request, $id, BrandRequest $brandRequest): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $brandRequest->validated();
        try {
            $brands = Brand::find($id);
            $input = $request->all();
            unset($input['_token']);
            $brands->update($input);
            if (!empty($input['value'])) {
                for ($i = 0; $i < count($input['value']); $i++) {
                    $data = [
                        'brand_id' => $brands->id,
                        'value' => $input['value'][$i],
                        'quantity' => $input['quantity'][$i],
                        'percent' => $input['percent'][$i],
                    ];
                    Voucher::update($data);
                }
            }
            return redirect()->route('admin.brand.index')->with('success', 'Đã cập nhật brand thành công');
        } catch (Exception $e) {
            return redirect('admin/brand/edit/' . $id)->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $brands = Brand::find($id);
        $brands->delete();
        return redirect()->route('admin.brand.index')->with('success', 'Đã xóa brand thành công');
    }
}
