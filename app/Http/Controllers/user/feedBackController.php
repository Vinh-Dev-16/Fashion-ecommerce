<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FeedBack;
use App\Models\admin\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class feedBackController extends Controller
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

    public function store(Request $request, $id)
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
        FeedBack::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'title' => $input['title'],
            'content' => $input['content'],
            'product_id' => $product_id,
            'rate' => $input['rate'],
        ]);
        $data = FeedBack::all();
        $rateProduct = Product::find($id);
        $rate = $rateProduct->feedback()->pluck('feedbacks.rate')->avg();
        $count = $rateProduct->reviews->count();
        $rateProduct->update([
            'rate' => $rate,
            'count' => $count,
        ]);

        return response()->json([
            'result' => $data,
        ]);
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $review = FeedBack::find($id);
        return response()->json([
            'result' => $review,
        ]);
    }


    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $feedBack = FeedBack::find($id);
        $input = $request->all();
        $feedBack->product_id = $input['product_id'];
        $feedBack->name = $input['name'];
        $feedBack->email = $input['email'];
        $feedBack->title = $input['title'];
        $feedBack->content = $input['content'];
        $feedBack->rate = $input['rate'];
        $input = $request->all();
        $feedBack->update();
        $data = FeedBack::all();
        $rateProduct = Product::find($feedBack->product_id);
        $rate = $rateProduct->feedbacks()->pluck('feedbacks.rate')->avg();
        $count = $rateProduct->reviews->count();
        $rateProduct->update([
            'rate' => $rate,
            'count' => $count,
        ]);
        return response()->json([
            'result' => $data,
        ]);
    }


    public function destroy($id)
    {
        $review = FeedBack::find($id);
        $review->delete();
        $feedBack = FeedBack::all();
        $file = $review->image;
        return response()->json([
            'result' => $feedBack,
        ]);
    }
}
