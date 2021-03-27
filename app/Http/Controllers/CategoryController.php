<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return view('admin.post.category.index');    //to load index page
      $data = Category::all();
      return view('admin.post.category.index',[
         'all_data' =>$data
      ]);

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
        // return $request->all();               //to check all values after receiving

         $this ->validate($request, [
             'name' => 'required'
         ]);

        Category::create([
            'name' => $request->name,
            'slug' =>Str::slug($request->name),
        ]);

        return redirect()->route('post-category.index')->with('success','Category Added Successfully');
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
        //echo 'Edit ID : '.$id;

        $data = Category::find($id);

        //return in json type
        return[
          'id' => $data -> id,
          'name' => $data ->name,
        ];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // return $request->all();   //to check all receiving value after submitting
        $id = $request -> id ;
        $data = Category::find($id);
        $data->name = $request->name;
        $data->slug= Str::slug(($request->name));
        $data->update();
        return redirect()->route('post-category.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 'Deleted ID : '.$id;
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('post-category.index')->with('success', 'Category Deleted Successfully');
    }

    public function unpublishedCategory($id){
       // echo 'Unpublished : '.$id;
        $data = Category::find($id);
        $data->status = 'Unpublished';
        $data->update();
        return redirect()->route('post-category.index')->with('success', 'Category Unpublished Successfully');
    }

    public function publishedCategory($id){
        echo 'Published : '.$id;
        $data = Category::find($id);
        $data->status = 'Published';
        $data->update();
        return redirect()->route('post-category.index')->with('success', 'Category Published Successfully');
    }


}
