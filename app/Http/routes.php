<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});


/*Route::get('register',function(){
   App\User::create(array(
      'name' => 'Admin',
       'email' => 'badmustaofeeq@gmail.com',
       'password' => Hash::make('password')
   ));
});*/

//Route::get('/login', ['uses' => 'Auth\AuthController@showLoginForm','as' => 'login']);
//Route::auth();
// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');


//Route::get('/home', 'HomeController@index');

Route::get('/', ['as' => 'home','uses'=>'PageController@getIndex']);
Route::get('/calendar', ['as' => 'calendar','uses'=>'PageController@getCalendar']);
Route::get('/news', ['as' => 'news.index','uses'=> 'PageController@getNews']);
Route::get('/facilities', ['as' => 'facilities','uses'=> 'PageController@getFacilities']);
Route::get('/admissions', ['as' => 'admissions','uses'=> 'PageController@getAdmissions']);
Route::get('/events', ['as' => 'news.events','uses'=> 'PageController@getEvents']);
Route::get('/awards', ['as' => 'news.awards','uses'=> 'PageController@getAwards']);
Route::get('/about',['as' => 'about','uses'=>'PageController@getAbout']);
Route::get('/classroom',['as' => 'classroom','uses'=>'PageController@getVirtualClassroomPosts']);
//Route::get('/about',['uses' => 'PageController@getAbout','middleware'=>['auth','roles'], 'roles' => ['Admin']]);

Route::get('/contact',['as' => 'contact.get','uses'=>'PageController@getContact']);
Route::post('/contact',['as' => 'contact.post','uses'=>'PageController@postContact']);
Route::get('/mail',['uses'=>'PageController@zohoMail']);

Route::get('/news/{id}', ['as' => 'news.single','uses'=> 'PageController@getSingle']);
Route::get('/cats/{id}', ['as' => 'pub_categories.show','uses'=> 'PageController@getCategories']);
    //->where('slug', '[\w\d\-\_]+');
//Route::get('/blog', ['as' => 'blog.index','uses'=> 'BlogController@getIndex']);

//manage application
Route::resource('application','ApplicationController');
Route::post('searchapplications',['as' => 'application.search','uses'=>'ApplicationController@search']);
Route::get('prospectapplication',['as' => 'application.prospect','uses'=>'ApplicationController@prospect']);
Route::post('retrieveapplication',['as' => 'application.retrieve','uses'=>'ApplicationController@retrieve']);
Route::get('/viewapplication/{id}',['as' => 'application.viewapp','uses'=>'ApplicationController@show']);
Route::get('/editapplication/{id}',['as' => 'application.editapp','uses'=>'ApplicationController@edit']);

Route::post('comments/{post_id}',['as' => 'comments.store','uses'=>'CommentsController@store','middleware'=>['role:user|admin']]);


//Admin routes
Route::group(['middleware'=>['auth','role:admin']], function (){
    //register users
    Route::get('register', 'PageController@getRegister');
    Route::post('register', 'PageController@postRegister');

    //Post routes
    Route::resource('posts','PostController');
    Route::post('searchposts',['as' => 'posts.search','uses'=>'PostController@search']);

    //Document routes
    Route::resource('documents','DocumentController');
    Route::post('searchdocuments',['as' => 'documents.search','uses'=>'DocumentController@search']);
    Route::get('documents/{post_id}/delete',['as' => 'documents.delete','uses'=>'DocumentController@destroy']);

    //Categories Controller
    Route::resource('categories','CategoryController',['except' => ['create']]);

    //Comments Controller
    Route::resource('comments','CommentsController', ['except'=> ['store']]);
    Route::get('comments/{post_id}/delete',['as' => 'comments.delete','uses'=>'CommentsController@delete']);

    //uploads
    Route::get('/uploads',['as' => 'uploads.get','uses'=>'PageController@getSliderImages']);
    Route::post('/uploads',['as' => 'uploads.post','uses'=>'PageController@postSliderImages']);

    //homevideopath
    Route::post('/homevideopath',['as' => 'homevideopath.post','uses'=>'PageController@setHomeVideoPath']);

    //manage users
    Route::resource('users','ManageUserController');
    Route::post('searchusers',['as' => 'users.search','uses'=>'ManageUserController@search']);
    Route::post('updateprofile',['as' => 'users.userUpdate','uses'=>'ManageUserController@search']);

    //list of users with a certain role
    Route::get('roles/{role_id}',['as' => 'roles.show','uses'=>'RolesController@show']);
});
