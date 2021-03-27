<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //to fetch all value inside this page

        $all_data = Testimonial::all();

        return view('admin.pages.home.testimonial.index', compact('all_data'));
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
     $this->validate($request,[
        'title' => 'required',
         'content' => 'required',
     ]);

     if($request -> hasfile('timg')){

          $img = $request -> file('timg');

          $file_name = md5(time().rand()). '.' . $img -> getClientOriginalExtension();

          $img ->move(public_path('media/testimonials'),$file_name);
       }

       else{
           $file_name = '';
        }


       // return $request->all();

     $testimonial_post = Testimonial::create([
            'title' => $request->title,
            'slug' =>Str::slug($request -> title),
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'testimonial_img' => $file_name,
            'user_id' =>Auth::user()->id
        ]);


      return redirect()->route('selectedwork.index')->with('success', 'Testimonial Added Successfully');


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
