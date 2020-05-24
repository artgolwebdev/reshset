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

Route::get('/iptocountry',function(){
    // set IP address and API access key 
    $ip =  Request::ip();
    $access_key = '8cd55756eac4d3602f2d4c9935f2fc9d';

    // Initialize CURL:
    $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response:
    $api_result = json_decode($json, true);

    // Output the "capital" object inside "location"
    return response()->json($api_result);
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

    Route::get('/friendsbylocation',[
        'uses' => 'HomeController@getFriendsByLocation' , 
        'as' => 'friendsbylocation'
    ]);

    Route::post('/add-comment',[
        'uses' => 'PostController@addcomment' , 
        'as' => 'add-comment'
    ]);

    Route::get('/chat',[
        'uses' => 'HomeController@chatpage' , 
        'as' => 'chat' 
    ]);

    Route::get('/chat/contacts',[
        'uses' => 'ContactsController@get' , 
        'as' => 'chat.contacts'
    ]);

    Route::get('/conversation/{id}',[
        'uses' => 'ContactsController@getMessagesFor' , 
        'as' => 'conversation'
    ]);

    Route::post('/conversation/send',[
        'uses' => 'ContactsController@send' , 
        'as' =>  'conversation.send'
    ]);

    Route::get('/get_unread_messages',[
        'uses' => 'ContactsController@getunreadmessages' , 
        'as' => 'get_unread_messages'
    ]);
});


