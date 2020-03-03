<?php

use Illuminate\Http\Request;

Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/question/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@like');
Route::delete('/like/{reply}', 'LikeController@unlike');

Route::post('notifications', 'NotificationController@index');
Route::post('markAsRead', 'NotificationController@markAsRead');

Route::group(['middleware' => 'api','prefix' => 'auth'], static function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
