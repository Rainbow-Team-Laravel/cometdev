<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\ProductPost;
use App\Models\ProductCategory;

class FrontEndController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homePage(){
        return view('frontend.home');           //To load homepage          //folder.pagename
    }

    public function blogSingleSidebarLeft(){

        $all_data = ProductPost::latest()->get();                       //  $all_data = ProductPost::all();      means descending order showing

        $product_categories = ProductCategory::all();

        return view('frontend.blog-single-sidebar-left', compact('all_data', 'product_categories'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function blogPage(){
        //$all_post = Post::latest()->get();
        $all_post = Post::latest()->paginate(5);
        return view('frontend.blog', compact('all_post'));           //To load blogPage          //folder.pagename
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function singlePost($slug){
       $single_post = Post::where('slug', $slug)->first();             //first() means single value. we will not use get()
        return view('frontend.blog-single',compact('single_post'));    //To load blogsingle Page   //foldernname.pagename
    }

    //Post search by Category
    public function postByCategory($slug){

//        $cats =  Category::where('slug', 'Django') -> first();
//          foreach ($cats -> posts as $post){
//              echo $post ->title;
//          }

        $cats = Category::where('slug', $slug) ->first();

        return view('frontend.category-search', compact('cats'));
    }

    public function postBySearch(Request $request){
        //return $request -> all();   to catch search value (for check purpose)

        $seach_text = $request->search;

        $posts = Post::where('title', 'like', '%'.$seach_text.'%') ->orWhere('content', 'like', '%'.$seach_text.'%') ->get();

        return view('frontend.search', compact('posts'));
    }

}
