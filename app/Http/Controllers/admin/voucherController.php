<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

}
