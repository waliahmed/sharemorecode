<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::resource('snippets', 'SnippetsController');

Route::resource('comments', 'CommentsController');

Route::resource('revisions', 'RevisionsController');

Route::resource('features', 'FeaturesController');

Route::resource('issues', 'IssuesController');

Route::resource('reviews', 'ReviewsController');

Route::resource('users', 'UsersController');

Route::resource('tags', 'TagsController');