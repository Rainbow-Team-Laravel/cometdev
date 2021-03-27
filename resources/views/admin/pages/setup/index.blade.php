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
                                <table  class="table table-striped mb-0 data-table">
                                    <thead>
                                    <tr class="col-md-4">
                                        <th>Featured Image</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_data as $data)
                                        <tr>
                                            <td>

                                                <a id="slide_edit" data-toggle="modal" edit_id="{{$data->id}}"  class="btn btn-sm btn-warning" href="#slide_modal_update">
                                                    @if(!empty($data->featured_image))
                                                        <img style="width: 200px; height: 200px" src="{{URL::to('/')}}/media/sliders/{{$data->featured_image}}" alt="">
                                                    @endif
                                                </a>
                                            </td>


                                            {{--<td>--}}
                                            {{--@if($data->status=='Published')--}}

                                            {{--href="{{route('slider.unpublished',$data->id)}}"--}}

                                            {{--<a class="btn btn-sm btn-danger" href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>--}}
                                            {{--@else--}}

                                            {{--href="{{route('slider.published', $data->id)}}"--}}

                                            {{--<a class="btn btn-sm btn-success" href=""><i class="fa fa-eye" aria-hidden="true"></i></a>--}}
                                            {{--@endif--}}


                                            {{--<a  class="btn btn-sm btn-warning" href="#">Edit</a>--}}

                                            {{--<a id="slide_edit" data-toggle="modal" edit_id="{{$data->id}}"  class="btn btn-sm btn-warning" href="#slide_modal_update">Edit</a>--}}
                                            {{----}}
                                            {{--</td>--}}

                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
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
                            {{--{{route('post.store') is name route}}--}}
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
                            {{--{{route('post-tag.store') is name route}}--}}
                            <form action="{{route('slide.update')}}" method="POST" enctype="multipart/form-data">
                                {{--<form action="{{route('all-slider.update.ajax')}}" method="POST" enctype="multipart/form-data">--}}
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



                            <!----------------Start Dynamic Slider Adding-------------------------->

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
                                                        <input type="text" name="slider_url"  class="form-control">
                                                        {{--<input type="text" name="slider_url" value="{{$all_slider_data->svideo}}" class="form-control">--}}
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label"></label>
                                                    <div class="col-lg-9">
                                                        <div class="comet-dynamic-slider-container">



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