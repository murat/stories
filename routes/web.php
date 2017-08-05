<?php

Route::get('/', 'StoriesController@index');
Route::get('/home', 'StoriesController@index');
Route::get('/help', 'HomeController@help');

Route::resource('stories', 'StoriesController');
Route::resource('stories.comments', 'CommentsController');
Route::put('/stories/{id}/vote/{type}', 'StoriesController@vote');

Route::get('/user/{user}', 'StoriesController@index');

Auth::routes();
Route::group(['prefix' => 'login'], function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
});
Route::get('logout', 'Auth\LoginController@logout');
