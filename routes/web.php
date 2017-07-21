<?php

Route::get('/', 'StoriesController@index');

Route::resource('stories', 'StoriesController');
Route::resource('stories.comments', 'CommentsController');

Route::get('/help', 'HomeController@help');
