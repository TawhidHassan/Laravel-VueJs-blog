<?php

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

Route::get('/', function () {
    return view('fornt/index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/post', 'PostController@all_post')->name('post');
//Route::get('/{anypath}', 'HomeController@index')->where('path','.*');


//category

Route::group(['middleware' => ['auth']], function () {
    Route::post('/addcategory', 'CategoryController@add');
    Route::get('/categoryes', 'CategoryController@all');
    Route::get('deletecategory/{id}', 'CategoryController@delete');
    Route::get('editcategory/{id}', 'CategoryController@edit');
    Route::post('updatecategory/{id}', 'CategoryController@update');
    Route::get('/deletecategory/{id}','CategoryController@selected_category');

//post
    Route::get('/posts', 'PostController@all_post');
    Route::post('/addnewpost', 'PostController@addnewpost');
    Route::get('/postdelete/{id}', 'PostController@deletepost');
    Route::get('/editpost/{id}', 'PostController@edit_post');
    Route::post('/update/{id}', 'PostController@update_post');
});

Route::get('/blogposts', 'BlogController@all_posts');
Route::get('/singlepost/{id}','BlogController@getpost_by_id');
Route::get('/categories','BlogController@get_all_category');
Route::get('/categorypost/{id}','BlogController@get_all_post_by_cat_id');


Route::get('/search','BlogController@search_post');
