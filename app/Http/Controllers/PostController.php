<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $all_data = Post::all();
        $all_data = Post::latest()->get();
        $categories = Category::all();
        return view('admin.post.index',compact('all_data','categories'));  //folder.folder.page name = admin.post.index
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
        // return $request->all();  to check the form value after submitting

        $this -> validate($request,[
            'title'   => 'required',
            'content' => 'required'
        ]);

        if($request->hasFile('fimg')){

            $img = $request->file('fimg');

            $file_name = md5(time().rand()). '.' .$img ->getClientOriginalExtension();

            $img ->move(public_path('media/posts'), $file_name);
        }

        else{
            $file_name ='';
        }

        $post_user = Post::create([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),   //To show single post, slug will be used
            'user_id' => Auth::user()->id,             //user_id will be one to many relationship
            'content' => $request->content,
            'featured_image' => $file_name,

        ]);

        //Now we will call the categories() method from $post_user  and name will be category name
        $post_user ->categories()->attach($request->category);

        return redirect()->route('post.index')->with('success', 'Post Added Successfully');
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
        $data = Post::find($id);           //return $data;

        $cat_all = Category::all();

       $post_cat = $data -> categories;
       $check_id =[];
       foreach ($post_cat as $check_cat){
           array_push($check_id, $check_cat ->id);
       }

        $cat_list = '';

        foreach ($cat_all as $cat){
            if(in_array($cat ->id, $check_id)){
                $checked = 'checked';
            }
            else{
                $checked = '';
            }
            $cat_list .= '<div class="checkbox"><label><input '.$checked.' type="checkbox" value="'.$cat->id.'" name="category[]"> '.$cat->name.'</label></div>';
        }

        return [
            'id'        => $data->id,
            'title'     => $data->title,
            'image'     => $data->featured_image,
            'cat_list'  => $cat_list,
            'content'   => $data->content
        ];

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

    public function unpublishedPost($id){
        echo 'Unpublished ID : '.$id;
        $data = Post::find($id);
        $data->status = 'Unpublished';
        $data->update();
        return redirect()->route('post.index')->with('success','Post Unpublished Successfully');
    }


    public function publishedPost($id){
        echo 'Published ID : '.$id;
        $data = Post::find($id);
        $data->status = 'Published';
        $data->update();
        return redirect()->route('post.index')->with('success','Post Published Successfully');
    }




    public function postUpdate(Request $request){
       // return $request->all();

        if($request ->hasFile('fimg-edit')){

            $img = $request->file('fimg-edit');                                      echo 'Value of Image : '.$img;

            $file_name = md5(time().rand()). '.' . $img -> getClientOriginalName();   echo 'File Name : '.$file_name;

            $img -> move(public_path('media/posts'), $file_name);
        }

        else{
            $file_name = '';
        }


        $post_id = $request->id;
        $post_data = Post::find($post_id);
        $post_data ->title = $request ->title;
        $post_data ->content = $request->content;
        $post_data ->featured_image = $file_name;

        $post_data ->update();

        $post_data ->categories() -> detach();

        $post_data ->categories() -> attach($request -> category);

        return redirect() -> route('post.index')->with('success', 'Post Updated Successfully');

    }

    public function destroy($id)
    {
        echo 'Deleted ID : '.$id;
        $data = Post::find($id);
        $data->delete();
        return redirect()->route('post.index')->with('success', 'Post Item Deleted Successfully');
    }


//    public function delete($id){
//      echo 'Delete ID '.$id;
//      $data = Post::find($id);
//      $data -> delete();
//      return redirect() ->route('post.index') ->with('success', 'Post Item Deleted Successfully');
//    }


}
