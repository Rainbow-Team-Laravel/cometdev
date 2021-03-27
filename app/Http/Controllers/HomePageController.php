<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $sliders = HomePage::find(1);    //from page we has to find 1
        return view('admin.pages.home.slider.index', ['slider' => $sliders]);   //index page location inside folder
    }





    public function sliderStore(Request $request)
    {
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
          'slider' =>  $slider                    //'slider'  is send to home page as $slider variable
      ];

     //  return $slider_arr;                      // we will not send $slider_arr in database now will convert $slider_arr into json data(as json encode)

      $slider_json = json_encode($slider_arr);    // return $slider_json;    // it will conver $slider_json as json //{"svideo":"https:\/\/www.youtube.com\/watch?v=-LPe4tYckkg","slider":[{"slide_code":"305","subtitle":"Hello World","title":"This is first project","btn1_title":"Test-1","btn1_link":"Apply-1","btn2_title":"Read More -2","btn2_link":"Read More -2"},{"slide_code":"199","subtitle":"Hello World -1","title":"This is first project Today","btn1_title":"Apply-1","btn1_link":"Read More -1","btn2_title":"Shop Now Today","btn2_link":"Read More -2"}]}

      $slider_data = HomePage::find(1);           // return $slider_data;   //here Homepage::find(1) means only one row(id=1) slider value will show in homepage from home_pages table   //{"id":1,"sliders":null,"wwa":null,"vision":null,"clients":null,"testimonials":null,"setup":null,"created_at":null,"updated_at":null}

      $slider_data -> sliders = $slider_json;    // here sliders is table field name were json data will send

      $slider_data ->update();

      return redirect()->back();


//        $slider_num = count($request -> subtitle);
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
//              // return $slider_arr;  To show single data
//
//              array_push($slider, $slider_arr);
//        }
//
//       // return $slider;
//
//         $slider_arr = [
//             'svideo' => $request ->slider_url,
//             'slider' => $slider
//         ];
//
//
//      // return $slider_arr;
//
//        $slider_json = json_encode($slider_arr);  // return $slider_json;
//
//        $slider_data = HomePage::find(1);        // return $slider_data;
//
//        $slider_data -> sliders = $slider_json;   // return $slider_data; // sliders is field name of table where json value will store
//
//        $slider_data ->update();
//
//        return redirect() ->back();


// 'To understand these process '

//       $slider_arr =[
//
//           'svideo' => 'video url',
//           'slider' => [
//               [
//                   'subtitle' => 'Muhsina Akter',
//                   'title'  => 'Muhsina',
//                   'btn1_title' =>'Read More1',
//                   'btn1_link' => 'Read More'
//               ],
//               [
//                   'subtitle' => 'Bushra Aktar',
//                   'title'  => 'Bushra',
//                   'btn1_title' =>'Read More2',
//                   'btn1_link' => 'Read More'
//               ],
//               [
//                   'subtitle' => 'Radia Islam',
//                   'title'  => 'Radia',
//                   'btn1_title' =>'Read More3',
//                   'btn1_link' => 'Read More'
//               ],
//           ]
//
//           ];
//
//       return $slider_arr;
    }


//    public function SetupHomePage(){
//        return view('admin.pages.setup.index');
//    }


//public function testimonialList(){
//    return view('admin.pages.home.testimonial.index');
//}
//
////$sliders = HomePage::find(1);    //from page we has to find 1
////return view('admin.pages.home.slider.index', ['slider' => $sliders]);
//
//    public function testimonialStore(Request $request){
//       // return $request ->all();
//       // return $request->title;
//       // $testimonial_num = count($request -> title);
//       // return $testimonial_num;
//    }


}





