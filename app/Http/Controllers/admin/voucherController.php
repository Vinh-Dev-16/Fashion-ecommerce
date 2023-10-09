<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        return view('admin.voucher.modal.create')->render();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'value' => 'required|max:255',
            'quantity' => 'required|numeric',
            'percent' => 'required|max:255',
            'price'  => 'required|max:255',
            'max' => 'required|max:255',
            'start_date' => 'required|max:255|date|before:end_date',
            'end_date' => 'required|date|after:start_date|max:255',
            'min_price' => 'required|max:255',
        ],
            [
                'value.required' => 'Giá trị không được để trống',
                'value.max' => 'Giá trị không được quá 255 ký tự',
                'quantity.required' => 'Số lượng không được để trống',
                'quantity.numeric' => 'Số lượng phải là số',
                'percent.required' => 'Phần trăm không được để trống',
                'percent.max' => 'Phần trăm không được quá 255 ký tự',
                'price.required' => 'Giá không được để trống',
                'price.max' => 'Giá không được quá 255 ký tự',
                'max.required' => 'Giá trị tối đa không được để trống',
                'max.max' => 'Giá trị tối đa không được quá 255 ký tự',
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
            ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->toArray(),
            ]);
        }
        try {
            $input = $request->all();

            if (!empty('price') && !empty('percent')) {
                return response()->json([
                    'status' => 2,
                    'message' => 'Không được nhập cả 2 giá trị giá và phần trăm',
                ]);
            }

            unset($input['_token']);
            Voucher::create($input);
            $url = url('admin/voucher/index') . '?page=' . Session::get('page');
            return response()->json([
                'status' => 1,
                'message' => 'Thêm voucher thành công',
                'url' => $url,
            ]);
        }catch (\Exception $exception) {
            return response()->json([
                'status' => 2,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
