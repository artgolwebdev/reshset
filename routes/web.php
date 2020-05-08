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
    if(Auth::user()){
        return redirect()->route('home');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::post('/profile/update',[
        'uses' => 'ProfilesController@update' ,
        'as' => 'profile.update'
    ]);
    Route::get('/profile/edit',[
        'uses' => 'ProfilesController@edit' ,
        'as' => 'profile.edit'
    ]);
    Route::get('/profile/{slug}',[
        'uses' => 'ProfilesController@index' ,
        'as' => 'profile'
    ]);
    Route::get('/check_relationship_status/{id}',[
        'uses' => 'FriendshipsController@check', 
        'as' => 'check'
    ]);
    Route::get('/add_friend/{id}',[
        'uses' => 'FriendshipsController@add_friend',
        'as' => 'add_friend'
    ]);
    Route::get('/accept_friend/{id}',[
        'uses' => 'FriendshipsController@accept_friend',
        'as' => 'accept_friend'
    ]);
    Route::get('/user/friends/{id}',[
        'uses' => 'FriendshipsController@getfrineds' , 
        'as' => 'user/friends'
    ]);

    Route::get('/get_unread',function(){
        return Auth::user()->unreadNotifications;
    });

    Route::get('/notifications',[
        'uses' => 'HomeController@notifications' , 
        'as' => 'notifications'
    ]);

    Route::post('/create/post/',[
        'uses' => 'PostController@store' , 
        'as' => 'create.post'
    ]);

    Route::get('/feed/{user_id}',[
        'uses' => 'FeedController@feed',
        'as' => 'feed'
    ]);

    Route::get('/getsinglepost/{id}',[
        'uses' => 'FeedController@getsinglepost',
        'as' => 'getsinglepost'
    ]);

    Route::get('/get_auth_user_data',function(){
        return Auth::user();
    });

    Route::get('/post/like/{id}',[
        'uses' => 'LikesController@like',
    ]);

    Route::get('/post/unlike/{id}',[
        'uses' => 'LikesController@unlike' , 
    ]);

    Route::get('/post/{id}',[
        'uses' => 'PostController@show',
        'as' => 'post'
    ]);

    Route::get('/search',[
        'uses' => 'SearchController@index' , 
        'as' => 'search'
    ]);

    Route::post('/searchdata',[
        'uses' => 'SearchController@search' , 
        'as' => 'searchdata'
    ]);
});
