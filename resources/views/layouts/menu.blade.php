

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>

                <li class="">
                    <a href="{{route('home')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>


                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span>Posts</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('post.index')}}">All Posts</a></li>

                        {{--name route is post-category.index  for category --}}
                        <li><a href="{{route('post-category.index')}}">Category</a></li>
                          {{--name route is tag.index for tag--}}
                        <li><a href="{{route('post-tag.index')}}">Tag</a></li>
                           {{--or--}}
                        {{--<li><a href="{{url('tag')}}">Tag</a></li>--}}
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span>Products</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        <li><a href="{{route('product-post.index')}}">All Products</a></li>

                        <li><a href="{{route('product-category.index')}}">Category</a></li>

                        <li><a href="">Tag</a></li>
                        {{--or--}}
                        {{--<li><a href="{{url('tag')}}">Tag</a></li>--}}
                    </ul>
                </li>


                {{--<li class="submenu">--}}
                    {{--<a href="#"><i class="fe fe-document"></i> <span>Products</span> <span class="menu-arrow"></span></a>--}}
                    {{--<ul style="display: none;">--}}

                        {{--<li><a href="{{route('product.index')}}">All Products</a></li>--}}

                        {{--<li><a href="{{route('product-category.index')}}">Category</a></li>--}}

                        {{--<li><a href="{{route('post-tag.index')}}">Tag</a></li>--}}
                        {{--or--}}
                        {{--<li><a href="{{url('tag')}}">Tag</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span>Sliders</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        <li><a href="{{route('all-slider.index')}}">All Sliders</a></li>

                        <li><a href="{{route('slider-category.index')}}">Category</a></li>

                        {{--<li><a href="{{route('post-tag.index')}}">Tag</a></li>--}}
                        {{--or--}}
                        {{--<li><a href="{{url('tag')}}">Tag</a></li>--}}
                    </ul>
                </li>


                <!------------Home Settings--->
                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span>Home Settings</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('slider.index')}}">Slider</a></li>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Clients</a></li>


                        {{--{{route('selectedwork.index')}}--}}{{-- is called name route--}}

                        <li><a href="{{route('selectedwork.index')}}">Testimonials</a></li>
                        <li><a href="#">Home Setup</a></li>
                        {{--<li><a href="{{route('slider.setup')}}">Home Setup</a></li>--}}
                    </ul>
                </li>


                {{--<li>--}}
                    {{--<a href="settings.html"><i class="fe fe-vector"></i> <span>Settings</span></a>--}}
                {{--</li>--}}


                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span>Settings</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="#">Logo</a></li>
                        <li><a href="#">Social Icon</a></li>
                        <li><a href="#">Footer</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->