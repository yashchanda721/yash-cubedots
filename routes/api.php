<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => ['api', 'web'],
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('signIn', 'PostController@signIn');
    Route::get('signOut', 'PostController@signOut');

    Route::post('posts', 'PostController@allPosts');

    Route::get('posts/add', 'PostController@addPost');
    Route::post('posts/save', 'PostController@store');
    Route::post('posts/edit', 'PostController@edit');
    Route::get('post/{slug}', 'PostController@editPost');
    Route::post('posts/delete/{id}', 'PostController@delete');
    Route::get('posts/show', 'PostController@show');
});
