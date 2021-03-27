<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return view('admin.post.tag.index');         //to load index page

        // use of compact

        $all_data = Tag::all();
        return view('admin.post.tag.index', compact('all_data'));

        //or use of array

        // $data = Tag::all();
        //return view('admin.post.tag.index',[
        //'all_data' =>$data
        // ]);

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
        //return $request->all();          //to check all values

        $this->validate($request,[
            'name' => 'required | unique:tags'
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('post-tag.index')->with('success','Tag Added Successfully');

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



    public function unpublishedTag($id){
        echo ' Unpublished ID : '.$id;
        $data = Tag::find($id);                 //to take all data from Tag() Model
        $data->status = 'Unpublished';
        $data->update();
        return redirect()->route('post-tag.index')->with('success','Tag Unpublished Successfully');

    }

    public function publishedTag($id){
        echo 'Published ID : '.$id;
        $data = Tag::find($id);
        $data->status = 'Published';
        $data->update();
        return redirect()->route('post-tag.index')->with('success','Tag Published Successfully');
    }


      public function destroy($id)
    {
        echo 'Deleted ID : '.$id;
        $data = Tag::find($id);
        $data->delete();
        return redirect()->route('post-tag.index')->with('success', 'Tag Deleted Successfully');
    }




}
