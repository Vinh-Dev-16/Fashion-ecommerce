<?php

namespace App\Http\Controllers\user;

use App\Events\AdminConfirm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\Information;
use App\Models\OrderDetail;
use App\Models\User;
use DateTime;
use App\Models\Wishlist;
use Exception;
class homeController extends Controller
{
    public function home()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.home', compact('products', 'categories', 'brands','cart'));
    }
    
    public function viewAllProducts()
    {
        $products = Product::orderBy('id','desc')->paginate(12);
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.viewAllProduct', compact('products', 'categories', 'brands','cart'));
    }

    public function search(Request $request)
    {
        $searches = Product::where('name', 'like', '%' . $request->data . '%')->get();
        $results = collect($searches, []);
        foreach ($results as $result) {
            $result->images->first()->path;
        }
        return response()->json([
            'results' => $results,
            'status' => 'success',
        ]);
    }

    public function searchPage(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        $key = $request->search;
        $searches = Product::where([
            ['name' ,'!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->Where('name', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(12);
       
        return view('user.design.search',compact('searches','key','products','categories','brands','cart'));
    }

    public function shipper()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        return view('user.design.shipper', compact('products', 'categories', 'brands','cart'));
    }

    public function shipperStore(Request $request){

        if ($request->isMethod('POST')) {
            $now = date('Y-m-d');
            $rules = [
                'birthday' => 'required|before:today|before:'.now()->subYear(18)->toDateString(),
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
        try {
            $user = User::find($request->user_id);
            if($user){
                $user->role_id = 4;
                $user->save();
            }
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
            return redirect()->route('pageShip')->with('success', 'Đã đăng kí thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function shipperSuccess(Request $request) {

        if ($request->isMethod('POST')) {
            $now = date('Y-m-d');
            $rules = [
                'birthday' => 'before:today|before:'.now()->subYear(18)->toDateString(),
            ];
            $request->validate($rules);
        }


        try {
            $user = User::find($request->user_id);
            if($user){
                $user->role_id = 4;
                $user->save();
            }
            return redirect()->route('pageShip')->with('success', 'Đã đăng kí thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function pageShip(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);

        return view('user.design.pageShip',compact('products', 'categories', 'brands','cart'));
    }

    // Shipper đã ship đơn hàng đến nơi

    public function confirm(Request $request){
        if(!(empty($request->ids))){
            try{
                $now = new DateTime();
                $orderDetails = OrderDetail::whereIn('id',$request->ids)->get();
                foreach($orderDetails as $order){
                    $orderDetails = OrderDetail::where('id',$order->id)
                    ->update(
                        [
                            'ship' => 1,
                            'time' => $now,
                        ]
                    );
                }
                return redirect()->back()->with('success', 'Đã giao hàng');
            }catch(Exception $e){
                return redirect()->back()->with('error','Đã xảy ra lỗi');
            }
        }else{
            return redirect()->back()->with('error','Bạn cần xác nhận đơn hàng');
        }
    }

    // Người dùng đã mua hàng và đã xác nhận

    public function confirmProduct($id){
        try{
            $orderDetail = OrderDetail::find($id);
            if($orderDetail){
                $orderDetail->status = 1;
                $orderDetail->save();
            }
            return redirect()->back()->with('success', 'Đã xác nhận thành công');
        }catch(Exception $e){
            return redirect()->back()->with('error','Đã xảy ra lỗi');
        }
    }

    public function pageConfirm(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $cart = session()->get('cart', []);

        return view('user.design.pageConfirm',compact('products', 'categories', 'brands','cart'));
    }

    // Admin đã xác nhận đơn hàng

    public function confirmItem(Request $request){
        if(!(empty($request->ids))){
            try{
                $now = new DateTime();
                $orderDetails = OrderDetail::whereIn('id',$request->ids)->get();
                foreach($orderDetails as $order){
                    $orderDetails = OrderDetail::where('id',$order->id)
                    ->update(
                        [
                            'status' => 2,
                            'time_confirm' => $now,
                        ]
                    );
                } 
                $count = OrderDetail::where('status', 2)->count();
                event(new AdminConfirm($count));
                return redirect()->back()->with('success', 'Đã xác nhận');
            }catch(Exception $e){
                return redirect()->back()->with('error','Đã xảy ra lỗi');
            }
        }else{
            return redirect()->back()->with('error','Bạn cần xác nhận đơn hàng');
        }
       
    }
}
   
