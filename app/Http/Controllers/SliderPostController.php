<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use App\Models\SliderCategory;
use App\Models\SliderPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SliderPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $all_data = SliderPost::all();   // return $all_data;
       $categories = SliderCategory::all();
       return view('admin.slider.index' , compact('all_data','categories'));
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
       // return $request -> all();

        $this->validate($request,[
            'title'    => 'required',
            'category' => 'required',
        ]);

        if($request->hasFile('fimg')){

            $img = $request->file('fimg');

            $file_name = md5(time().rand()). '.' .$img ->getClientOriginalExtension();

            $img ->move(public_path('media/sliders'), $file_name);
        }

        else{
            $file_name ='';
        }

        SliderPost::create([
            'title'    => $request -> title,
            'slug'     => Str::slug($request -> title),
            'category' => $request->category,
            'user_id'  => Auth::user() -> id,   //one to many relationship. one user can post one by one
            'featured_image' => $file_name

        ]);

        return redirect()->route('all-slider.index')->with('success', 'Slide Added Successfully');   //back to route (  slider.index )
    }


    public function slideStoreUpdate(Request $request)
    {

        $post_id = $request->id;


        //  return $request ->all();      // to check all captured data
        //  return $request -> subtitle;   // ["Hello World","Hello World -1","Hello World -3"]
        //  $slider_num = count($request -> subtitle);    return $slider_num;

        $slider = [];
        $slider_num = count($request ->subtitle);
        for($i=0; $i<$slider_num; $i++){
            $slider_arr = [
                'slide_code'  => $request -> slide_code[$i],      //slide_code is array field name from script.js page
                'subtitle'    => $request -> subtitle[$i],        //subtitle is array field name
                'title'       => $request -> title[$i],           //title is array field name
                'btn1_title'  => $request -> btn1_title[$i],      //btn1_title is array field name
                'btn1_link'   => $request -> btn1_link[$i],       //btn1_link is array field name
                'btn2_title'  => $request -> btn2_title[$i],      //btn2_title is array field name
                'btn2_link'   => $request -> btn2_link[$i],       //btn2_link is array field name
            ];

            //return $slider_arr;   //if we return then only one slide value will show  //{"slide_code":"922","subtitle":"Hello World","title":"This is first project","btn1_title":"Button 01 Title","btn1_link":"Button 01 Link","btn2_title":"Button 02 Title","btn2_link":"Button 02 Link"}

            //now we will make array inside array by using array_push function and we will take a array variable $slider = [];

            //To get all array values we have to return a array variable $slider where all dynamic slide value were store

            array_push($slider, $slider_arr);
        }

        // return $slider;                        // out put will show in browser as this [{"slide_code":"922","subtitle":"Hello World","title":"This is first project","btn1_title":"Button 01 Title","btn1_link":"Button 01 Link","btn2_title":"Button 02 Title","btn2_link":"Button 02 Link"},{"slide_code":"613","subtitle":"Hello World -1","title":"Project with nice","btn1_title":"Button 01 Title","btn1_link":"Button 01 Link","btn2_title":"Button 02 Title","btn2_link":"Button 02 Link"}]

        $slider_arr = [
            'svideo' =>  $request -> slider_url,    // input file name slider_url and input youtube link
            'slider' =>  $slider
        ];

        //  return $slider_arr;                      // we will not send $slider_arr in database now will convert $slider_arr into json data(as json encode)

        $slider_json = json_encode($slider_arr);    // return $slider_json;    // it will conver $slider_json as json //{"svideo":"https:\/\/www.youtube.com\/watch?v=-LPe4tYckkg","slider":[{"slide_code":"305","subtitle":"Hello World","title":"This is first project","btn1_title":"Test-1","btn1_link":"Apply-1","btn2_title":"Read More -2","btn2_link":"Read More -2"},{"slide_code":"199","subtitle":"Hello World -1","title":"This is first project Today","btn1_title":"Apply-1","btn1_link":"Read More -1","btn2_title":"Shop Now Today","btn2_link":"Read More -2"}]}

        //$slider_data = HomePage::find(1);           // return $slider_data;   //here Homepage::find(1) means only one row(id=1) slider value will show in homepage from home_pages table   //{"id":1,"sliders":null,"wwa":null,"vision":null,"clients":null,"testimonials":null,"setup":null,"created_at":null,"updated_at":null}

        $slider_data = SliderPost::find($post_id);

        $slider_data ->sliders = $slider_json;    // here sliders is table field name were json data will send

        //SliderPost::where('id',$request->id)->update(['sliders'=>$slider_data]);

        $slider_data ->update();

        return redirect()->back();





















        // return $request->all();   //to check all captured data
        // return $request -> subtitle;
        // $slider_num = count($request -> subtitle);    return $slider_num;
//
//        $slider_num = count($request -> subtitle);
//
//        $slider = [];
//        for($i=0; $i < $slider_num; $i++){
//            $slider_arr = [
//                'slide_code'  => $request ->  slide_code[$i],
//                'subtitle'    => $request -> subtitle[$i],
//                'title'       => $request -> title[$i],
//                'btn1_title'  => $request -> btn1_title[$i],
//                'btn1_link'   => $request -> btn1_link[$i],
//                'btn2_title'  => $request -> btn2_title[$i],
//                'btn2_link'   => $request -> btn2_link[$i]
//            ];
//
//            // return $slider_arr;  To show single data
//
//            array_push($slider, $slider_arr);
//        }
//
//        // return $slider;
//
//        $slider_arr = [
////            'svideo' => $request ->slider_url,
////            'slider' => $slider
//
//            'svideo' => ('stock-footage-big-data-collecting-data-from-a-mass-of-people.webm'),
//            'slider' => $slider
//        ];
//
//
//        // return $slider_arr;
//
//        $slider_json = json_encode($slider_arr);  // return $slider_json;
//
//        $slider_data = HomePage::find(1);        // return $slider_data;
//
//        $slider_data -> sliders = $slider_json;   // return $slider_data; // sliders is field name of table where json value will store
//
////        $post_id = $request ->id;
////        $post_data = SliderPost::find($post_id);
////        $post_data->sliders = $request ->sliders;
//
//        SliderPost::where('id',$request->id)->update(['sliders'=>$slider_data]);
//
//       // $slider_data ->update();
//
//        return redirect() ->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // echo 'ID id : '.$id;

        $single_id = $id;

        $all_data = SliderPost::all();          //return $all_data;

        return view('admin.slider.show', compact('all_data','single_id'));



       // $all_data = SliderPost::all();   // return $all_data;
       // $categories = SliderCategory::all();

       // return view('admin.slider.index' , compact('all_data','categories'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SliderPost::find($id);             // return $data;                          //to check all fetch value with id


       return [
           'id'         => $data ->id,
           'title'      => $data ->title,
           'category'   => $data ->category,
           'sliders'    => $data ->sliders,
           'image'      => $data->featured_image

       ];

//        return [
//            'id'        => $data->id,
//            'title'     => $data->title,
//            'image'     => $data->featured_image,
//            'cat_list'  => $cat_list,
//            'content'   => $data->content
//        ];

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
