<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Review;
use App\Models\admin\Product;
use App\Models\admin\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class reviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
         if ($request->isMethod('Post')) {
            $rules = [
                'title' => 'required|max:255',
                'content' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',

            ];
            $request->validate($rules, $messages);
        }        
            $product_id = Product::find($id)->id;
            $input = $request->all(); 
            if(request()->hasFile('image')){
                $file = $request->file('image');
                $file->storeAs('review' , time().'.'.$file->getClientOriginalExtension(),'public');
                $image = time().'.'.$file->getClientOriginalExtension();
                    $view=  Review::create([
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'title' => $input['title'],
                        'image' => 'storage/review/'. $image,
                        'content'=>$input['content'],
                        'product_id' => $product_id,
                        'rate' =>$input['rate'],
                     ]);
                  
            }else{
                    $view = Review::create([
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'title' => $input['title'],
                        'content'=>$input['content'],
                        'product_id' => $product_id,
                        'rate' => $input['rate'],
                     ]);
            }
            $data= Review::all();
            $rateProduct = Product::find($id);
            $rate = $rateProduct->reviews()->pluck('feedbacks.rate')->avg();
            $rateProduct->update([
                'rate' => $rate,
            ]);
            
            return response()->json([
                'result'=>$data,
            ]);
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
        $review = Review::find($id);
        return response()->json([
            'result'=>$review,
        ]);
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
        $reviews = Review::find($id);
        $input = $request->all();
        $reviews->product_id = $reviews->product_id;
        $reviews->name = $input['name'];
        $reviews->email = $input['email'];
        $reviews->title = $input['title'];
        $reviews->content = $input['content'];
        $reviews->rate = $input['rate'];
        $input = $request->all(); 
        if(request()->hasFile('image')){
            $destination = 'storage/review/'. $reviews->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('image');
            $file->storeAs('review' , time().'.'.$file->getClientOriginalExtension(),'public');
            $image = 'storage/review/'.time().'.'.$file->getClientOriginalExtension();
            $reviews->image = $image;     
        }
        $reviews->update();
        $data= Review::all();
        $rateProduct = Product::find($reviews->product_id);
        $rate = $rateProduct->reviews()->pluck('feedbacks.rate')->avg();
        $rateProduct->update([
            'rate' => $rate,
        ]);
        return response()->json([
            'result'=>$data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
            $review = Review::find($id);
            $review->delete();
            $reviews = Review::all();
            $file = $review->image;
            Storage::delete($file);
            return response()->json([
                'result'=>$reviews,
            ]);
     }
}
