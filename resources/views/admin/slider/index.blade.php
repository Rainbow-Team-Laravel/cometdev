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









            <div class="row">
                <div class="col-lg-12">
                    @include('validate')
                    <a class="btn btn-sm btn-primary" href="#post_modal"  data-toggle="modal">Add New Slide</a>
                    <br>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Sliders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <div class="row">
                                    @foreach($all_data as $data)
                                    <div class="col-sm-4">
                                        <div class="card" style="width: 17rem;">

                                            <div class="card-body">

                                                <h5 class="card-title">{{ $data->title }}</h5>
                                                {{--<p class="card-text">Text here</p>--}}
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"> <a id="slide_edit" data-toggle="modal" edit_id="{{$data->id}}"  class="btn btn-sm btn-warning" href="#slide_modal_update">
                                                        @if(!empty($data->featured_image))
                                                            <img style="width: 200px; height: 200px" src="{{URL::to('/')}}/media/sliders/{{$data->featured_image}}" alt="">
                                                        @endif
                                                    </a></li>

                                            </ul>
                                            <div class="card-body">
                                                {{--<a class="btn btn-sm btn-info" href="{{route('staff.show', $data ->id)}}">View</a>--}}

                                                <a href="{{route('slide.view', $data->id)}}" class="card-link">View</a>
                                                <a href="#" class="card-link">Another link</a>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                </div>


                                {{--<table  class="table table-striped mb-0 data-table">--}}
                                    {{--<thead>--}}
                                    {{--<tr class="col-md-4">--}}
                                        {{--<th>Featured Image</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@foreach($all_data as $data)--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}

                                            {{--<a id="slide_edit" data-toggle="modal" edit_id="{{$data->id}}"  class="btn btn-sm btn-warning" href="#slide_modal_update">--}}
                                                  {{--@if(!empty($data->featured_image))--}}
                                                    {{--<img style="width: 200px; height: 200px" src="{{URL::to('/')}}/media/sliders/{{$data->featured_image}}" alt=""> <br><br> {{$data ->title}}--}}
                                                    {{--@endif--}}
                                            {{--</a>--}}
                                            {{--</td>--}}

                                        {{--</tr>--}}

                                        {{--@endforeach--}}

                                    {{--</tbody>--}}
                                {{--</table>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--end row-->


           <!-- Modal for Slider Form  -->
           <div id="post_modal" class="modal fade">
               <div class="modal-dialog modal-dialog-centered modal-lg">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title">Add New Slider</h4>
                           <button class="close" data-dismiss="modal">&times;</button>
                       </div>
                       <div class="modal-body">

                           <form action="{{route('all-slider.store')}}" method="POST" enctype="multipart/form-data">
                               @csrf
                               <div class="form-group">
                                   <input name="title" class="form-control" type="text" placeholder="Title">
                               </div>

                               <div class="form-group">
                                   <label for="">Select Slider</label>
                                       <select name="category" class="custom-select" id="category">
                                           <option selected>Choose...</option>
                                           @foreach($categories as  $category)
                                              <option value="{{$category->name}}">{{$category->name}}</option>
                                           @endforeach
                                       </select>
                               </div>

                               <div class="form-group">
                                   <label style="font-size: 70px; cursor: pointer" for="slide_image"><i class="fa fa-file-image-o" aria-hidden="true"></i></label>
                                   <input style="display: none;" name="fimg" class="" type="file" id="slide_image">
                                   <img style="max-width: 100%;display: block" id="post_slide_image_load" src="" alt="">
                               </div>

                               <div class="form-group">
                                   <input class="btn btn-block btn-primary" type="submit" value="Create Add Slider" >
                               </div>
                           </form>
                       </div>
                       <div class="modal-footer"></div>
                   </div>
               </div>
           </div>




           <!----------------------- Modal for Slider Edit Form   Add Dynamic Slider   -------------------------->

           <div id="slide_modal_update" class="modal fade">
               <div class="modal-dialog modal-dialog-centered modal-lg">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title">Add Dynamic Slider </h4>
                           <button class="close" data-dismiss="modal">&times;</button>
                       </div>
                       <div class="modal-body">

                           <form action="{{route('slide.update')}}" method="POST" enctype="multipart/form-data">
                               @csrf
                               @method('PATCH')
                               <div class="form-group">
                                   <input name="title" class="form-control" type="text" placeholder="Title">
                                   <input name="id" class="form-control" type="text" placeholder="ID">
                               </div>

                               {{--<div class="form-group">--}}
                                   {{--<label style="font-size: 70px; cursor: pointer" for="slide-image-edit"><i class="fa fa-file-image-o" aria-hidden="true"></i></label>--}}
                                   {{--<input style="display: none;" name="fimg-edit" class="" type="file" id="slide-image-edit">--}}
                                   {{--<img style="max-width: 100%;display: block; " id="slide_featured_image_edit" src="" alt="">--}}
                               {{--</div>--}}

                               {{--<div class="form-group">--}}
                                   {{--<label for="">Select Slider</label>--}}
                                   {{--<select name="category" class="custom-select" id="category">--}}
                                       {{--<option selected>Choose...</option>--}}
                                       {{--@foreach($categories as  $category)--}}
                                           {{--<option value="{{$category->id}}">{{$category->name}}</option>--}}
                                       {{--@endforeach--}}
                                   {{--</select>--}}
                               {{--</div>--}}

                               {{--@php--}}
                               {{--echo "<pre>";--}}
                               {{--$all_slider_data = json_decode($slider -> sliders);        //here sliders is field name of table home_pages--}}

                               {{--print_r($all_slider_data);--}}
                               {{--echo "</pre>";--}}
                               {{--@endphp--}}



                                <!----------------Start Dynamic Slider Adding-------------------------->




                               {{--{{$data->sliders}}--}}

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


                                      echo 'TEST DATA ';

                                    $all_slider_data = json_decode($data -> sliders);        //here sliders is field name of table home_pages

                                     print_r($all_slider_data);


                                /*   $all_slider_data->svideo;
                                    print_r($all_slider_data);*/
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
                                    <div class="col-xl-12 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h4 class="card-title">Basic Form</h4>
                                            </div>
                                            <div class="card-body">
                                                {{--<form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">--}}
                                                    {{--@csrf--}}
                                                    <div class="form-group row">
                                                        <label class="col-lg-3 col-form-label">Slider Vedio</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="slider_url" value="{{$all_slider_data ->svideo}}" class="form-control">
                                                            {{--<input type="hidden" name="slider_url" value="" class="form-control">--}}
                                                            {{--<input type="hidden" name="sliders" value="" class="form-control">--}}
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-lg-3 col-form-label"></label>
                                                        <div class="col-lg-9">
                                                            <div class="comet-dynamic-slider-container">


                                                                    @foreach($all_slider_data -> slider as $slide)

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


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-lg-3 col-form-label">Add Slide</label>
                                                        <div class="col-lg-9">
                                                            <button id="comet-single-add-slide" class="btn btn-primary btn-sm">Add New Slide</button>
                                                        </div>
                                                    </div>

                                                    {{--<div class="text-right">--}}
                                                        {{--<button type="submit" class="btn btn-primary">Save</button>--}}
                                                    {{--</div>--}}
                                                {{--</form>--}}
                                            </div>
                                        </div>
                                    </div>

                                </div> <!--end row-->

                                <!------- EndDynamic Slider Adding------------->

                                <div class="form-group">
                                    <input class="btn btn-block btn-primary" type="submit" value="Update" >
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection