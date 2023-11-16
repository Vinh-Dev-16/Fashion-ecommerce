<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class voucherController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->listData($request);
        }
        $vouchers = Voucher::paginate(6);
        return view('admin.voucher.index', compact('vouchers'));
    }

    public function listData(Request $request): string
    {
        $vouchers = Voucher::query();
        if ($request->has('search')) {
            $vouchers->where('value', 'like', '%' . $request->get('search') . '%')
                ->orWhere('percent', 'like', '%' . $request->get('search') . '%')
                ->orWhere('max', 'like', '%' . $request->get('search') . '%')
                ->orWhere('start_date', 'like', '%' . $request->get('search') . '%')
                ->orWhere('end_date', 'like', '%' . $request->get('search') . '%')
                ->orWhere('min_price', 'like', '%' . $request->get('search') . '%');
        }
        $currentPage = $request->input('page', 1);
        Session::put('page', $currentPage);
        $vouchers = $vouchers->paginate(6, ['*'], 'page', $currentPage);
        return view('admin.voucher.list_data', compact('vouchers'))->render();
    }

    public function create(): string
    {
        $brands = Brand::all();
        return view('admin.voucher.modal.create', compact('brands'))->render();
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'value' => 'required|max:255',
            'quantity' => 'numeric',
            'percent' => 'max:255',
            'price' => 'required|max:255',
            'max' => 'required|max:255',
            'start_date' => 'required|max:255|date|before:end_date',
            'end_date' => 'required|date|after:start_date|max:255',
            'min_price' => 'required|max:255',
            'type' => 'required',
            'status' => 'required|numeric',
        ],
            [
                'value.required' => 'Giá trị không được để trống',
                'value.max' => 'Giá trị không được quá 255 ký tự',
                'quantity.required' => 'Số lượng không được để trống',
                'quantity.numeric' => 'Số lượng phải là số',
                'percent.max' => 'Phần trăm không được quá 255 ký tự',
                'price.max' => 'Giá không được quá 255 ký tự',
                'max.required' => 'Giá trị tối đa không được để trống',
                'max.max' => 'Giá trị tối đa không được quá 255 ký tự',
                'type.required' => 'Loại không được để trống',
                'start_date.required' => 'Ngày bắt đầu không được để trống',
                'start_date.max' => 'Ngày bắt đầu không được quá 255 ký tự',
                'start_date.date' => 'Ngày bắt đầu không đúng định dạng',
                'start_date.before' => 'Ngày bắt đầu phải trước ngày kết thúc',
                'end_date.required' => 'Ngày kết thúc không được để trống',
                'end_date.date' => 'Ngày kết thúc không đúng định dạng',
                'end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
                'end_date.max' => 'Ngày kết thúc không được quá 255 ký tự',
                'min_price.required' => 'Giá trị tối thiểu không được để trống',
                'min_price.max' => 'Giá trị tối thiểu không được quá 255 ký tự',
                'status.required' => 'Trạng thái không được để trống',
                'status.numeric' => 'Trạng thái phải là số',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ]);
        }
        try {
            $min_price = str_replace(',', '', $request->min_price);
            $max = str_replace(',', '', $request->max);
            $price = str_replace(',', '', $request->price);
            $input = $request->all();

            if (!empty($request->price) && !empty($request->percent)) {
                return response()->json([
                    'status' => 2,
                    'message' => 'Không được nhập cả 2 giá trị giá và phần trăm',
                ]);
            } elseif (empty($request->price) && empty($request->percent)) {
                return response()->json([
                    'status' => 2,
                    'message' => 'Phải nhập 1 trong 2 giá trị giá và phần trăm',
                ]);
            }
            if (!($request->type == 1) || !($request->type == 0)) {
                return response()->json([
                    'status' => 2,
                    'message' => 'Loại không hợp lệ',
                ]);
            }
            unset($input['_token']);
            $input = array_merge($input, ['status' => 1]);
            $input['min_price'] = $min_price;
            $input['max'] = $max;
            $input['price'] = $price;
            $voucher = Voucher::create($input);
            $voucher->brands()->attach($request->brand_id);
            $url = url('admin/voucher/index') . '?page=' . Session::get('page');
            return response()->json([
                'status' => 1,
                'message' => 'Thêm voucher thành công',
                'url' => $url,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 2,
                'message' => $exception->getMessage(),
            ]);
        }
    }


    public function edit($id): string
    {
        $voucher = Voucher::find($id);
        $brands = Brand::all();
        return view('admin.voucher.modal.edit', compact('voucher', 'brands'))->render();
    }

}
