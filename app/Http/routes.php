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
Route::auth();

//Route::get('/home', 'HomeController@index');

Route::get('/', 'PageController@getIndex');
Route::get('/calendar', 'PageController@getCalendar');
Route::get('/news', ['as' => 'news.index','uses'=> 'PageController@getNews']);
Route::get('/events', ['as' => 'news.events','uses'=> 'PageController@getEvents']);
Route::get('/awards', ['as' => 'news.awards','uses'=> 'PageController@getAwards']);
Route::get('/about','PageController@getAbout');
//Route::get('/about',['uses' => 'PageController@getAbout','middleware'=>['auth','roles'], 'roles' => ['Admin']]);
Route::get('/contact','PageController@getContact');
Route::get('/news/{id}', ['as' => 'news.single','uses'=> 'PageController@getSingle']);
Route::get('/cats/{id}', ['as' => 'pub_categories.show','uses'=> 'PageController@getCategories']);
    //->where('slug', '[\w\d\-\_]+');
//Route::get('/blog', ['as' => 'blog.index','uses'=> 'BlogController@getIndex']);


Route::group(['middleware'=>'roles', 'roles' => ['Admin']], function (){
    //Post routes
    Route::resource('posts','PostController');

    //Categories Controller
    Route::resource('categories','CategoryController',['except' => ['create']]);
});
