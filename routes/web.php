<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * Basic Home Page
 */

Route::get('/', 'App\Http\Controllers\FrontEndController@homePage');

Route::get('/blog','App\Http\Controllers\FrontEndController@blogPage')->name('blog');

Route::get('/blog-single/{slug}', 'App\Http\Controllers\FrontEndController@singlePost')->name('blog.single');


Route::get('/blog-single-sidebar-left', 'App\Http\Controllers\FrontEndController@blogSingleSidebarLeft');

//Route::get('/', function (){
//    return view('home');
//});


//Blog post search by category
Route::get('category/{slug}', 'App\Http\Controllers\FrontEndController@postByCategory')->name('blog.search.category');

//Blog Post search by search field
Route::post('search', 'App\Http\Controllers\FrontEndController@postBySearch')->name('post.search');



//Route::get('/', function () {
//    return view('frontend.home');    // not need to declare but we can use directly  //function () {  return view('frontend.home'); } is callback function or closer/
//});
//
//Route::get('/blog', function(){
//    return view('frontend.blog');
//});
//
//Route::get('/blog-single', function(){
//    return view('frontend.blog-single');
//});

//
//Route::get('/blog-single-sidebar-left',function (){
//    return view('frontend.blog-single-sidebar-left');
//});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Add resource route
//No need to add name route because name route already given  for resource route(Route::resource)
//name route is post-category

//Product routes

Route::resource('product-category', 'App\Http\Controllers\ProductControllerBackup');


// Category routes

Route::resource('post-category','App\Http\Controllers\CategoryController');




//post-category-edit is called route or url

//Route::get is called get route and used for fetching value

Route::get('post-category-edit/{id}', 'App\Http\Controllers\CategoryController@edit');

//Route::post  is called post route because form will submit

Route::post('post-category-update', 'App\Http\Controllers\CategoryController@update')->name('category.update');

//name('category.unpublished') is called name route and unpublishedCategory is user defined method so we has to make inside CategoryController

Route::get('post-category-unpublished/{id}','App\Http\Controllers\CategoryController@unpublishedCategory')->name('category.unpublished');

Route::get('post-category-published/{id}','App\Http\Controllers\CategoryController@publishedCategory')->name('category.published');


//Tag Routes
Route::resource('post-tag', 'App\Http\Controllers\TagController');

Route::get('post-tag-unpublished/{id}', 'App\Http\Controllers\TagController@unpublishedTag')->name('tag.unpublished');

Route::get('post-tag-published/{id}','App\Http\Controllers\TagController@publishedTag')->name('tag.published');

Route::delete('post-tag/{id}','App\Http\Controllers\TagController@destroy')->name('post-tag.destroy');


//Post Routes
Route::resource('post', 'App\Http\Controllers\PostController');

Route::get('post-unpublished/{id}', 'App\Http\Controllers\PostController@unpublishedPost')->name('post.unpublished');

Route::get('post-published/{id}','App\Http\Controllers\PostController@publishedPost')->name('post.published');

Route::get('post-edit/{id}', 'App\Http\Controllers\PostController@edit');

Route::patch('post-update', 'App\Http\Controllers\PostController@postUpdate')->name('post.update.ajax');


//{{'By using name route for delete '}}

//Route::delete('post-item/{id}', 'App\Http\Controllers\PostController@delete')->name('post.item');

//Route::delete('post-item/{id}', 'App\Http\Controllers\PostController@destroy')->name('post.item');


//Home Page
//Route::group(['namespace' => 'App\Http\Controllers', 'prefix' =>'home'], function (){
//    Route::get('slider', 'HomePageController@index') -> name('slider.index');
//    Route::post('slider/store', 'HomePageController@sliderStore') ->name('slider.store');
//});

Route::group(['namespace' => 'App\Http\Controllers','prefix' =>'home'], function (){
    Route::get('slider', 'HomePageController@index') -> name('slider.index');
    Route::post('slider', 'HomePageController@sliderStore')->name('slider.store');
//   Route::get('slider','HomePageController@sliderSetupHomePage')->name('slider.setup');
});


// Product
Route::group(['namespace' => 'App\Http\Controllers', 'prefix' =>'product'], function (){
    Route::get('product-category', 'ProductController@index') ->name('product-category.index');
    Route::post('product-category', 'ProductController@store')->name('product-category.store');

});

//Product Post Routes
Route::group(['namespace' =>'App\Http\Controllers', 'prefix' =>'product'],function(){
    Route::get('product-post', 'ProductPostController@index')->name('product-post.index');
    Route::post('product-post', 'ProductPostController@store')->name('product-post.store');


});


// Route for SELECTED WORKS(testimonial)
// name('selectedwork.index') is called name route

Route::group(['namespace' =>'App\Http\Controllers', 'prefix' =>'testimonial'], function (){

    Route::resource('selectedwork', 'TestimonialController');

// Route::get('selectedwork', 'TestimonialController@testimonialList')->name('selectedwork.index');
//Route::get('selectedwork', 'HomePageController@testimonialList') ->name('selectedwork.index');
//Route::post('selectedwork', 'HomePageController@testimonialStore')->name('selectedwork.store');
});



//slider

/*Route is resource route
route name/name route is slider-category -> slider-category
where will go the slider-category  -> Location :  'App\Http\Controllers\SliderController'
*/

Route::resource('slider-category', 'App\Http\Controllers\SliderController');

//Slider Post Routes

Route::resource('all-slider', 'App\Http\Controllers\SliderPostController');

Route::get('slide-edit/{id}', 'App\Http\Controllers\SliderPostController@edit');

//Route::get('post-edit/{id}', 'App\Http\Controllers\PostController@edit');

//Route::patch('post-update', 'App\Http\Controllers\PostController@postUpdate')->name('post.update.ajax');

Route::patch('slide-update', 'App\Http\Controllers\SliderPostController@slideStoreUpdate')->name('slide.update');

Route::get('slide-view/{id}','App\Http\Controllers\SliderPostController@show')->name('slide.view');
































































































