<?php

namespace App\Http\Controllers;

use App\Models\ProductPost;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // echo  'TEST';

        $all_data = ProductPost::all();

        $product_categories = ProductCategory::all();

        return view('admin.product.index', compact('all_data', 'product_categories'));


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
    public function store(Request $request)
    {
       // return $request->all();

        $this->validate($request, [
            'title' => 'required',
            'price'=>'required',
            'product_content'=>'required'
        ]);

        if($request->hasFile('pimg')){

            $img = $request->file('pimg');

            $file_name = md5(time().rand()). '.' .$img ->getClientOriginalExtension();

            $img ->move(public_path('media/products'), $file_name);
        }

        else{
            $file_name ='';
        }

        $product_data = ProductPost::create([
             'title' => $request->title,
             'slug'  => Str::slug($request->title),
             'price' => $request->price,
             'product_img' =>  $file_name,
             'product_content' => $request->product_content,
             'user_id' => Auth::user()->id
        ]);


        $product_data ->productCategories() ->attach($request -> product_category);

        return redirect()->route('product-post.index')->with('success', 'Product Added Successfullly');
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
        //
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
        //
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
