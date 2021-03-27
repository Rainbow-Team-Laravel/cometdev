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
                     <a class="btn btn-sm btn-primary" href="#post_modal"  data-toggle="modal">Add New Post</a>
                     <br>
                     <br>
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">All Product Lists </h4>
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
                                                             {{--@if(!empty($data->featured_image))--}}
                                                                 {{--<img style="width: 200px; height: 200px" src="{{URL::to('/')}}/media/sliders/{{$data->featured_image}}" alt="">--}}
                                                             {{--@endif--}}

                                                             @if(!empty($data->product_img))
                                                                 <img style="width: 200px; height: 250px" src="{{URL::to('/')}}/media/products/{{$data->product_img}}" alt="">
                                                                 @endif
                                                         </a></li>

                                                 </ul>
                                                 <div class="card-body">
                                                     {{--<a class="btn btn-sm btn-info" href="{{route('staff.show', $data ->id)}}">View</a>--}}

                                                     {{--<h5 class="card-title">{{ $data->title }}</h5>--}}
                                                     <a href="{{route('slide.view', $data->id)}}" class="card-link">{{$data->price}}</a>
                                                     {{--<a href="#" class="card-link">Another link</a>--}}
                                                 </div>
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>

                                     {{--@foreach($all_data as $data)--}}


                                             {{--<td>{{$loop->index+1}}</td>--}}
                                             {{--<td>{{$data->title}}</td>--}}
                                             {{--<td>Slug</td>--}}
                                             {{--<td>{{$data->price}}</td>--}}
                                             {{--<td>Category</td>--}}
                                             {{--<td>--}}
                                                 {{--@foreach($data->product_categories as $category)--}}
                                                     {{--{{ $category->name }} |--}}
                                                     {{--@endforeach--}}
                                             {{--</td>--}}

                                             {{--<td>{{$data->tags}}</td>--}}
                                             {{--<td>--}}
                                                 {{--@if(!empty($data->product_img))--}}
                                                     {{--<img style="width: 60px; height: 60px" src="{{URL::to('/')}}/media/products/{{$data->product_img}}" alt="">--}}
                                                     {{--@endif--}}
                                             {{--</td>--}}
                                             {{--<td>--}}
                                                 {{--{{$data->author->name}}--}}
                                             {{--</td>--}}
                                             {{--<td>{{$data->created_at->diffForHumans()}}</td>--}}
                                             {{--<td>--}}
                                                 {{--@if($data->status=='Published')--}}
                                                    {{--<span class="badge badge-success">Published</span>--}}
                                                     {{--@else--}}
                                                     {{--<span class="badge badge-danger">Unpublished</span>--}}
                                                     {{--@endif--}}
                                             {{--</td>--}}
                                             {{--<td>Action</td>--}}
                                             {{--<td>--}}
                                                 {{--@if($data->status=='Published')--}}
                                                  {{--<a class="btn btn-sm btn-danger" href="{{route('post.unpublished',$data->id)}}"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>--}}
                                                    {{--@else--}}
                                                     {{--<a class="btn btn-sm btn-success" href="{{route('post.published', $data->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>--}}
                                                     {{--@endif--}}

                                                     {{--<a id="post_edit" data-toggle="modal" edit_id="{{$data->id}}" class="btn btn-sm btn-warning" href="#post_modal_update">Edit</a>--}}


                                                     {{--<form style="display: inline" action="{{route('post.destroy', $data->id)}}" method="POST">--}}
                                                         {{--@csrf--}}
                                                         {{--@method('DELETE')--}}
                                                         {{--<button class="btn btn-danger btn-sm" >Delete</button>--}}
                                                     {{--</form>--}}

                                                     {{--{{'By using name route for delete '}}--}}
                                                   {{--<form style="display: inline" action="{{route('post.item', $data->id)}}" method="POST">--}}
                                                       {{--@csrf--}}
                                                       {{--@method('DELETE')--}}
                                                    {{--<button class="btn btn-sm btn-danger">Delete</button>--}}
                                                   {{--</form>--}}
                                             {{--</td>--}}




                                         {{--@endforeach--}}



                             </div>
                         </div>
                     </div> <!-- end card --->

                 </div>
             </div> <!--end row-->


            <!-- Modal for Category Form  -->
            <div id="post_modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Product </h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{--{{route('post-tag.store') is name route}}--}}
                            <form action="{{route('product-post.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input name="title" class="form-control" type="text" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <input name="price" class="form-control" type="text" placeholder="Price">
                                </div>

                                <div class="form-group">
                                    <label for="">Product Categories</label>
                                    <hr>
                                    {{--{{category will be many to many relationship}}--}}
                                    {{--{{'many cateries could be under one post or one Caterory under Many Posts->that is why we have to use many to many relationship'}}--}}
                                    {{--{{"Many to many relationship will be between product_categories and product_posts table"}}--}}
                                    @foreach($product_categories as $category)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{$category->id}}" name="product_category[]"> {{$category->name}}
                                            </label>
                                        </div>
                                        @endforeach

                                </div>

                                <div class="form-group">
                                    <label style="font-size: 70px; cursor: pointer" for="pimage"><i class="fa fa-file-image-o" aria-hidden="true"></i></label>
                                    <input style="display: none;" name="pimg" class="" type="file" id="pimage">
                                    <img style="max-width: 100%;display: block" id="product_image_load" src="" alt="">
                                </div>

                                <div class="form-group">
                                    <textarea id="product_editor" name="product_content"></textarea>
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-block btn-primary" type="submit" value="Add" >
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>


            <!-- Modal for Category Edit Form  -->
            <div id="post_modal_update" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Post</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{--{{route('post-tag.store') is name route}}--}}
                            <form action="{{route('post.update.ajax')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <input name="title" class="form-control" type="text" placeholder="Title">
                                    <input name="id" class="form-control" type="hidden" placeholder="ID">
                                </div>

                                <div class="form-group">
                                    <label for="">Categories</label>
                                    <hr>
                                    <div class="cl">

                                    </div>
                                    {{--@foreach($categories as $category)--}}
                                        {{--<div class="checkbox">--}}
                                            {{--<label>--}}
                                                {{--<input type="checkbox" value="{{$category->id}}" name="category[]"> {{$category->name}}--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}

                                </div>

                                <div class="form-group">
                                    <label style="font-size: 70px; cursor: pointer" for="fimage-edit"><i class="fa fa-file-image-o" aria-hidden="true"></i></label>
                                    <input style="display: none;" name="fimg-edit" class="" type="file" id="fimage-edit">
                                    <img style="max-width: 100%;display: block" id="post_featured_image_edit" src="" alt="">
                                </div>

                                <div class="form-group">
                                    <textarea id="" class="form-control" name="content" rows="6"></textarea>
                                </div>

                                {{--<div class="form-group">--}}
                                    {{--<textarea id="post_editor_edit" name="content"> {{$data->content}} </textarea>--}}
                                {{--</div>--}}

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