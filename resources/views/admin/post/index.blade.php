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
                             <h4 class="card-title">All Posts</h4>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table  class="table table-striped mb-0 data-table">
                                     <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>Title</th>
                                         {{--<th>Slug</th>--}}
                                         <th>Categories</th>
                                         {{--<th>Content</th>--}}
                                         <th>Tags</th>
                                         <th>Featured Image</th>
                                         <th>Author</th>
                                         <th>Time</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @foreach($all_data as $data)

                                         <tr>
                                             <td>{{$loop->index+1}}</td>
                                             <td>{{$data->title}}</td>
                                             {{--<td>{{$data->slug}}</td>--}}
                                             <td>
                                                 @foreach($data->categories as $category)
                                                     {{ $category->name }} |
                                                     @endforeach
                                             </td>
                                             {{--<td>{{$data->content}}</td>--}}

                                             <td>{{$data->tags}}</td>
                                             <td>
                                                 @if(!empty($data->featured_image))
                                                     <img style="width: 60px; height: 60px" src="{{URL::to('/')}}/media/posts/{{$data->featured_image}}" alt="">
                                                     @endif
                                             </td>
                                             <td>
                                                 {{--{{$data->author}}--}}
                                                 {{$data->author->name}}
                                             </td>
                                             <td>{{$data->created_at->diffForHumans()}}</td>
                                             <td>
                                                 @if($data->status=='Published')
                                                    <span class="badge badge-success">Published</span>
                                                     @else
                                                     <span class="badge badge-danger">Unpublished</span>
                                                     @endif
                                             </td>
                                             <td>
                                                 @if($data->status=='Published')
                                                  <a class="btn btn-sm btn-danger" href="{{route('post.unpublished',$data->id)}}"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    @else
                                                     <a class="btn btn-sm btn-success" href="{{route('post.published', $data->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                     @endif

                                                     <a id="post_edit" data-toggle="modal" edit_id="{{$data->id}}" class="btn btn-sm btn-warning" href="#post_modal_update">Edit</a>


                                                     <form style="display: inline" action="{{route('post.destroy', $data->id)}}" method="POST">
                                                         @csrf
                                                         @method('DELETE')
                                                         <button class="btn btn-danger btn-sm" >Delete</button>
                                                     </form>

                                                     {{--{{'By using name route for delete '}}--}}
                                                   {{--<form style="display: inline" action="{{route('post.item', $data->id)}}" method="POST">--}}
                                                       {{--@csrf--}}
                                                       {{--@method('DELETE')--}}
                                                    {{--<button class="btn btn-sm btn-danger">Delete</button>--}}
                                                   {{--</form>--}}
                                             </td>


                                         </tr>

                                         @endforeach

                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div> <!--end row-->


            <!-- Modal for Category Form  -->
            <div id="post_modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Post</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{--{{route('post-tag.store') is name route}}--}}
                            <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input name="title" class="form-control" type="text" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <label for="">Categories</label>
                                    <hr>
                                    @foreach($categories as $category)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{$category->id}}" name="category[]"> {{$category->name}}
                                            </label>
                                        </div>
                                        @endforeach

                                </div>

                                <div class="form-group">
                                    <label style="font-size: 70px; cursor: pointer" for="fimage"><i class="fa fa-file-image-o" aria-hidden="true"></i></label>
                                    <input style="display: none;" name="fimg" class="" type="file" id="fimage">
                                    <img style="max-width: 100%;display: block" id="post_featured_image_load" src="" alt="">
                                </div>

                                <div class="form-group">
                                    <textarea id="post_editor" name="content"></textarea>
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