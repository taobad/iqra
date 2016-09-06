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

Route::get('/', function () {
    return view('welcome');
});


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
Route::get('/events', ['as' => 'news.events','uses'=> 'PageController@getEvents']);
Route::get('/awards', ['as' => 'news.awards','uses'=> 'PageController@getAwards']);
Route::get('/about',['as' => 'about','uses'=>'PageController@getAbout']);
//Route::get('/about',['uses' => 'PageController@getAbout','middleware'=>['auth','roles'], 'roles' => ['Admin']]);

Route::get('/contact',['as' => 'contact.get','uses'=>'pageController@getContact']);
Route::post('/contact',['as' => 'contact.post','uses'=>'pageController@postContact']);

Route::get('/news/{id}', ['as' => 'news.single','uses'=> 'PageController@getSingle']);
Route::get('/cats/{id}', ['as' => 'pub_categories.show','uses'=> 'PageController@getCategories']);
    //->where('slug', '[\w\d\-\_]+');
//Route::get('/blog', ['as' => 'blog.index','uses'=> 'BlogController@getIndex']);


Route::post('comments/{post_id}',['as' => 'comments.store','uses'=>'CommentsController@store','middleware'=>'roles', 'roles' => ['User','Admin']]);

Route::group(['middleware'=>'roles', 'roles' => ['Admin']], function (){
    //register users
    Route::get('register', 'PageController@getRegister');
    Route::post('register', 'PageController@postRegister');

    //Post routes
    Route::resource('posts','PostController');
    Route::post('searchposts',['as' => 'posts.search','uses'=>'PostController@search']);

    //Categories Controller
    Route::resource('categories','CategoryController',['except' => ['create']]);

    //Comments Controller
    Route::resource('comments','CommentsController', ['except'=> ['store']]);
    Route::get('comments/{post_id}/delete',['as' => 'comments.delete','uses'=>'CommentsController@delete']);

    //uploadsliderimages
    Route::get('/uploadsliderimages',['as' => 'uploadsliderimages.get','uses'=>'pageController@getSliderImages']);
    Route::post('/uploadsliderimages',['as' => 'uploadsliderimages.post','uses'=>'pageController@postSliderImages']);
});
