@extends('layouts.app')

@section('main-content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{Auth::user()->name}}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Posts</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            @php

           // echo "<pre>";
           // print_r($slider);               //these are json type
           // echo "</pre>";
           // print_r(json_decode($slider));  //these are object type data
           // $all_slider_data = json_decode($slider);
           // echo "<pre>";
           //print_r($all_slider_data);
           // echo "</pre>";

            echo "<pre>";
            $all_slider_data = json_decode($slider -> sliders);        //here sliders is field name of table home_pages

            print_r($all_slider_data);
            echo "</pre>";

              // print_r($slider);                                  //$slider is a json type data (say)  $slider is a json type data and we will take only data for sliders field(sliders is a table field name)
             // print_r(json_decode($slider));                      // data will show as object

            //$all_slider_data = json_decode($slider);

           // $all_slider_data = json_decode($slider ->sliders);    //sliders is array field name   [id] => 1   [sliders] => {"svideo":"Vedio URL","slider":[{"slider_code":"824","subtitle":"Hello World","title":"This is first project","btn1_title":"Test-1","btn1_link":"#","btn2_title":"Test-2","btn2_link":"#"},{"slider_code":"851","subtitle":"Hello World -1","title":"This is 2nd project","btn1_title":"Test-3","btn1_link":"#","btn2_title":"Test-4","btn2_link":"#"}]}
                                                                  // [wwa] =>  [vision] =>  [clients] => [testimonials] =>
            // echo "<pre>";
             //print_r($all_slider_data);
             @endphp

            <div class="row">
                <div class="col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Basic Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                               @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Slider Vedio</label>
                                    <div class="col-lg-9">

                                        {{--{{'We will put vedio url in here'}}--}}

                                        {{--<input type="file" name="svideo"  class="form-control">--}}
                                        <input type="text" name="slider_url" value="{{$all_slider_data -> svideo}}" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"></label>
                                    <div class="col-lg-9">
                                        <div class="comet-slider-container">

                                               {{--@foreach($all_slider_data ->slider as $slide)--}}
                                                     {{--{{$slide->title}}--}}
                                                 {{--@endforeach--}}



                                            @foreach($all_slider_data ->slider as $slide )

                                                <div id="slider-card-{{$slide ->slide_code}}" class="card">
                                                    <div data-toggle="collapse" data-target="#slide-{{$slide ->slide_code}}" style="cursor: pointer" class="card-header"><h4>#Slide - {{$slide ->slide_code}} <button id="comet-slide-remove-btn" remove_id="{{$slide ->slide_code}}" class="close">×</button></h4></div>
                                                    <div id="slide-{{$slide ->slide_code}}" class="collapse">
                                                        <div class="card-body">
                                                             <div class="form-group"><label for="">Sub Title</label>
                                                                 <input type="hidden" name="slide_code[]" value="{{$slide ->slide_code}}" class="form-control">
                                                                 <input type="text" name="subtitle[]" value="{{$slide ->subtitle}}" class="form-control"></div>
                                                            <div class="form-group"><label for="">Title</label>
                                                                <input type="text" name="title[]" value="{{$slide ->title}}" class="form-control">
                                                            </div>
                                                            <div class="form-group"><label for="">Button 01 Title </label>
                                                                <input type="text" name="btn1_title[]" value="{{$slide->btn1_title}}" class="form-control">
                                                            </div>
                                                            <div class="form-group"><label for="">Button 01 Link </label>
                                                                <input type="text" name="btn1_link[]" value="{{$slide->btn1_link}}" class="form-control">
                                                            </div>
                                                            <div class="form-group"><label for="">Button 02 Title </label>
                                                                <input type="text" name="btn2_title[]" value="{{$slide->btn2_title}}" class="form-control">
                                                            </div>
                                                            <div class="form-group"><label for="">Button 02 Link </label>
                                                                <input type="text" name="btn2_link[]" value="{{$slide->btn2_link}}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach







                                                     {{--{{$slide ->slide_code}}--}}

                                         {{--<div id="slider-card-" class="card">--}}

                                             {{--<div data-toggle="collapse" data-target="#slide-" style="cursor: pointer" class="card-header"><h4>#Slide  <button id="comet-slide-remove-btn" remove_id="" class="close">&times;</button></h4></div>--}}
                                              {{--<div id="slide-" class="collapse">--}}
                                                {{--<div class="card-body">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="">Sub Title</label>--}}
                                                        {{--<input type="text"  name="slide_code[]" value="" class="form-control">--}}
                                                        {{--<input type="text" class="form-control">--}}
                                                    {{--</div>--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="">Title</label>--}}
                                                        {{--<input type="text" class="form-control">--}}
                                                     {{--</div>--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="">Button 01 Title </label>--}}
                                                        {{--<input type="text" class="form-control">--}}
                                                    {{--</div>--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="">Button 01 Link </label>--}}
                                                        {{--<input type="text" class="form-control">--}}
                                                    {{--</div>--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="">Button 02 Title </label>--}}
                                                        {{--<input type="text" class="form-control">--}}
                                                    {{--</div>--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="">Button 02 Link </label>--}}
                                                        {{--<input type="text" class="form-control">--}}
                                                    {{--</div>--}}
                                               {{--</div>--}}
                                          {{--</div>--}}
                                       {{--</div>--}}



                                            {{--<div id="slider-card" class="card">--}}
                                                {{--<div data-toggle="collapse" data-target="#slide-1" style="cursor: pointer" class="card-header"><h4>#Slide 1 <button class="close">&times;</button></h4></div>--}}
                                                {{--<div id="slide-1" class="collapse">--}}
                                                    {{--<div class="card-body">--}}

                                                        {{--<div class="form-group">--}}
                                                            {{--<label for="">Sub Title</label>--}}
                                                            {{--<input type="text" class="form-control">--}}
                                                        {{--</div>--}}

                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                          </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Add Slide</label>
                                    <div class="col-lg-9">
                                        <button id="comet-add-slide" class="btn btn-primary btn-sm">Add New Slide</button>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{--<div class="col-xl-6 d-flex">--}}
                    {{--<div class="card flex-fill">--}}
                        {{--<div class="card-header">--}}
                            {{--<h4 class="card-title">Home Page Slider</h4>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div> <!--end row-->


        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection