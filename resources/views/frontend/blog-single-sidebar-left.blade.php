@extends('frontend.layouts.app')

@section('main-content')

  <section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="frontend/images/bg/15.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">This is our product<span class="red-dot"></span></h1>
              <h4>We have a few collections for you.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="sidebar hidden-sm hidden-xs">
            <div class="widget">
              <h6 class="upper">Search blog</h6>
              <form>
                <input type="text" placeholder="Search.." class="form-control">
              </form>
            </div>
            <!-- end of widget        -->
            <div class="widget">
              <h6 class="upper">Categories</h6>
              <ul class="nav">

                @foreach($product_categories as $product)

                <li><a href="#">{{$product->name}}</a></li>
                 @endforeach

              </ul>
            </div>
            <!-- end of widget        -->
            <div class="widget">
              <h6 class="upper">Popular Tags</h6>
              <div class="tags clearfix"><a href="#">Design</a><a href="#">Fashion</a><a href="#">Startups</a><a href="#">Tech</a><a href="#">Web</a><a href="#">Lifestyle</a>
              </div>
            </div>
            <!-- end of widget      -->
            <div class="widget">
              <h6 class="upper">Latest Posts</h6>
              <ul class="nav">
                <li><a href="#">Checklists for Startups<i class="ti-arrow-right"></i><span>30 Sep, 2015</span></a>
                </li>
                <li><a href="#">The Death of Thought<i class="ti-arrow-right"></i><span>29 Sep, 2015</span></a>
                </li>
                <li><a href="#">Give it five minutes<i class="ti-arrow-right"></i><span>24 Sep, 2015</span></a>
                </li>
                <li><a href="#">Uber launches in Las Vegas<i class="ti-arrow-right"></i><span>20 Sep, 2015</span></a>
                </li>
                <li><a href="#">Fun with Product Hunt<i class="ti-arrow-right"></i><span>16 Sep, 2015</span></a>
                </li>
              </ul>
            </div>
            <!-- end of widget          -->
          </div>
          <!-- end of sidebar-->
        </div>


        <div class="col-md-8 col-md-offset-1">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Product Lists </h3>
              <hr>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                  @foreach($all_data as $data)
                    <div class="col-sm-4">
                      <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><a href="" class="text-primary">View</a></li>
                          <li class="list-group-item"> <a id="slide_edit" data-toggle="modal" edit_id="{{$data->id}}"   href="#slide_modal_update">
                              @if(!empty($data->product_img))
                                <img style="width: 200px; height:200px" src="{{URL::to('/')}}/media/products/{{$data->product_img}}" alt="">
                              @endif
                            </a></li>
                          <li class="list-group-item"><h6 class="card-title"><small>{{ $data->title }}</small></h6>

                            <a href="{{route('slide.view', $data->id)}}" class="card-link">{{$data->price}}</a>
                          </li>
                        </ul>
                      </div>

                    </div>
                  @endforeach

              </div> <!---table-responsive--->
            </div> <!--- end card-body-->
          </div> <!-- end card --->
        </div>


      </div>
      <!-- end of row-->
    </div>
  </section>

@endsection


