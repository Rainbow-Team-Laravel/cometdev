@extends('layouts.app')

@section('main-content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


             <div class="row">
                 <div class="col-lg-12">
                     @include('validate')
                     <a class="btn btn-sm btn-primary" href="#category_modal"  data-toggle="modal">Add New Category(Slider)</a>
                     <br>
                     <br>
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">All Categories</h4>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped data-table mb-0">
                                     <thead>
                                     <tr>
                                         <th>SL</th>
                                         <th>Category Name</th>
                                         <th>Slug</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @foreach($all_data as $data)

                                         <tr>
                                             <td>{{$loop -> index +1}}</td>
                                             <td>{{$data -> name}}</td>
                                             <td>{{$data -> slug}}</td>
                                             <td>
                                                  @if($data->status =='Published')
                                                   <span class="badge badge-success">Published</span>
                                                 @else
                                                     <span class="badge badge-danger">Unpublished</span>
                                                 @endif

                                             </td>

                                             <td>
                                                 @if($data->status =='Published')
                                                  <a class="btn btn-sm btn-danger" href="{{route('category.unpublished', $data->id)}}"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                 @else
                                                     <a class="btn btn-sm btn-success" href="{{route('category.published', $data->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                 @endif

                                                 <a id="category_edit" edit_id="{{$data->id}}" class="btn btn-warning btn-sm" data-toggle="modal" href="#category_modal_update" >Edit</a>

                                                     <form style="display: inline" action="{{route('post-category.destroy', $data->id)}}" method="POST">
                                                         @csrf
                                                         @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" >Delete</button>
                                                     </form>
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
            <div id="category_modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Category</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('slider-category.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="name" class="form-control" type="text" placeholder="Category Name">
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
            <div id="category_modal_update" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Category</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('category.update')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="name" class="form-control" type="text" placeholder="Category Name">
                                    <input name="id" class="form-control" type="hidden" placeholder="Category Name">
                                </div>

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