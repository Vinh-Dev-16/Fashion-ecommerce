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

class informationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $user = User::find($id);
        $cart = session()->get('cart', []);
        return view('user.design.information.index', compact('user','products', 'categories', 'brands','cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                'address' => 'required',
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
                'address' => $input['address'],
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
        $user = User::find($id);
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);

        return view('user.design.information.edit', compact('products', 'categories', 'brands', 'cart','user'));
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
                'address' => 'required',
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
        $information->address = $input['address'];
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
