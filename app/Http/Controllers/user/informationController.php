<?php

namespace App\Http\Controllers\user;
use App\Models\Information;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class informationController extends Controller
{

    public function index($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $user = User::find($id);
        $cart = session()->get('cart', []);
        return view('user.design.information.index', compact('user','products', 'categories', 'brands','cart'));
    }


    public function store(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        if ($request->isMethod('POST')) {
            $now = date('Y-m-d');
            $rules = [
                'birthday' => 'required|before:today|before:'.now()->subYear(10)->toDateString(),
                'avatar' => 'required|image',
                'fullname' => 'required|max:255',
                'phone' => 'required|max:10',
                'hobbies' => 'required',
                'description' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
                'image' => 'Phải là ảnh',
                'max' => 'Vượt quá giới hạn cho phép',
                'before:today'=> 'Ngày không được ở tương lai',
                'before:' => 'Số tuổi phải trên 10',
            ];
            $request->validate($rules, $messages);
        }

        $file = $request->file('avatar');
        $file->storeAs('avatar' , time().'.'.$file->getClientOriginalExtension(),'public');
        $image = time().'.'.$file->getClientOriginalExtension();
        $user = User::find($request->user_id);
        try {
            $input = $request->all();
            unset($input['_token']);
            Information::create([
                'user_id' => $input['user_id'],
                'fullname' => $input['fullname'],
                'phone' => $input['phone'],
                'birthday' => $input['birthday'],
                'hobbies' => $input['hobbies'],
                'description' => $input['description'],
                'avatar' => $image,
                'gender' =>$input['gender'],
            ]);
            return view('user.design.information.index',compact('products', 'categories', 'brands','cart','user'))->with('success', 'Đã thêm thông tin thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function createAddress($id)
    {
        $user = User::find($id);
        $cart = session()->get('cart', []);
        return view('user.design.information.create_address', compact('cart','user'));
    }

    public function doCreateAddress(Request $request) {

        $validate = Validator::make($request->all(), [
            'district' => 'required',
            'province' => 'required',
            'address' => 'required',
        ],
         [
             'required' => 'Không được để trống trường này',
         ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => $validate->errors()->toArray(),
            ]);
        }

        try {
            $cart = session()->get('cart', []);
            $user = User::find($request->user_id);
            $input = $request->all();
            unset($input['_token']);
            $input['commune'] = empty($input['commune']) ? '' : $input['commune'];
            $input['commune_id'] = empty($input['commune_id']) ? '' : $input['commune_id'];
            $information = Information::where('user_id', $request->user_id)->first();
            $information->update([
                'district' => $input['district'],
                'province' => $input['province'],
                'province_id' => $input['province_id'],
                'district_id' => $input['district_id'],
                'commune_id' => $input['commune_id'],
                'address' => $input['address'],
                'commune' => $input['commune'],
            ]);
           return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Thêm địa chỉ thành công',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }


    public function editAddress($id)
    {
        $user = User::find($id);
        $cart = session()->get('cart', []);
        return view('user.design.information.edit_address', compact('cart','user'));
    }

    public function updateAddress(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'district' => 'required',
            'province' => 'required',
            'address' => 'required',
        ],
            [
                'required' => 'Không được để trống trường này',
            ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => STATUS_ERROR,
                'message' => $validate->errors()->toArray(),
            ]);
        }

        try {

            $input = $request->all();
            unset($input['_token']);
            $input['commune'] = empty($input['commune']) ? '' : $input['commune'];
            $input['commune_id'] = empty($input['commune_id']) ? '' : $input['commune_id'];
            $information = Information::where('user_id', $request->user_id)->first();
            $information->update([
                'district' => $input['district'],
                'province' => $input['province'],
                'address' => $input['address'],
                'commune_id' => $input['commune_id'],
                'district_id' => $input['district_id'],
                'province_id' => $input['province_id'],
                'commune' => $input['commune'],
            ]);
            return response()->json([
                'status' => STATUS_SUCCESS,
                'message' => 'Sửa địa chỉ thành công',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => STATUS_FAIL,
                'message' => 'Đã xảy ra lỗi',
            ]);
        }
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($id);
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);

        return view('user.design.information.edit', compact('products', 'categories', 'brands', 'cart','user'));
    }

    public function update(Request $request, $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        if ($request->isMethod('POST')) {
            $now = date('Y-m-d');
            $rules = [
                'birthday' => 'required|before:today|before:'.now()->subYear(10)->toDateString(),
                'avatar' => 'required|image',
                'fullname' => 'required|max:255',
                'phone' => 'required|max:10',
                'hobbies' => 'required',
                'description' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
                'image' => 'Phải là ảnh',
                'max' => 'Vượt quá giới hạn cho phép',
                'before:today'=> 'Ngày không được ở tương lai',
                'before:' => 'Số tuổi phải trên 10',
            ];
            $request->validate($rules, $messages);
        }
        $user = User::find($id);
        $information = Information::where('user_id', $id)->first();
        $input = $request->all();
        $information->fullname = $input['fullname'];
        $information->phone = $input['phone'];
        $information->birthday = $input['birthday'];
        $information->hobbies = $input['hobbies'];
        $information->gender = $input['gender'];
        $information->description = $input['description'];
        if($request->hasFile('avatar')){
            $destination = 'storage/avatar/' . $information->avatar;
            if(File::exists($destination)){
                Storage::delete($information->avatar);
            }
            $file = $request->file('avatar');
            $file->storeAs('public/avatar' , time().'.'.$file->getClientOriginalExtension());
            $image = time().'.'.$file->getClientOriginalExtension();
            $information->avatar = $image;
        }
        try{
            $information->save();
            return view('user.design.information.index',compact('products', 'categories', 'brands','cart','user'))->with('success', 'Đã thêm thông tin thành công');
        }catch(Exception $e){
            return redirect()->back()->with('error','Đã xảy ra lỗi');
        }
    }


    public function destroy($id)
    {
        //
    }
}
