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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('/', 'UsersController', ['only' => ['index', 'show']]);

// Route::get('/', 'UsersController@index');
Route::get('/', 'MoviesController@index');

Route::group(['middleware'=>'auth'],function(){
    Route::get('upload','UploadController@index')->name('upload.get');
    Route::post('upload','UploadController@store')->name('upload.post');
});

Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

Route::get('users/{id}', 'UsersController@show')->name('users.show');

Route::group(['prefix'=>'users/{id}'],function(){
       Route::get('followings','UsersController@followings')->name('users.followings');
       Route::get('followers','UsersController@followers')->name('users.followers');
    });

Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'users/{id}'],function(){
       Route::post('follow','UserFollowController@store')->name('user.follow');
       Route::delete('unfollow','UserFollowController@destroy')->name('user.unfollow');
    // Route::group(['prefix'=>'recommend'],function(){
            // Route::resource('movies','MoviesController',['only'=>['store','destroy']]);
    //   });
    });
});

Route::get('recommend/{id}','MoviesController@recommend')->name('recommend');
Route::group(['prefix'=>'recommend'],function(){
    // Route::get('movies/{m_id}','MoviesController@recommend')->name('recommend');
    Route::get('movies/{m_id}','MoviesController@select')->name('movies.select');
    Route::post('movies/{m_id}','MoviesController@deleteData')->name('movies.delete');
    Route::post('movies','MoviesController@store')->name('movies.store');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('channel/{id}','UsersController@channel')->name('channel');
    Route::put('rename','UsersController@rename')->name('rename');
    Route::put('profile','UsersController@profile')->name('profile');
    Route::delete('deleteData','UsersController@deleteData')->name('users.delete');

    Route::post('storeIcon','PhotosController@storeIcon')->name('icon.store');
    Route::post('storeTop','PhotosController@storeTop')->name('top.store');
    Route::post('topTrimming','PhotosController@topTrimming')->name('topTorimming');
});

Route::group(['prefix'=>'recommend'],function(){
    Route::post('word','UsersController@wordStore')->name('word.store');
});

// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
// });