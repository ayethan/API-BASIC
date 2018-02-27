<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'UserRegisterController@register');

Route::group(['prefix' => 'post'], function(){
    
    Route::get('/', 'PostController@index'); 
    Route::get('/{post}', 'PostController@show'); 
    Route::post('/store', 'PostController@store')->middleware('auth:api');
    Route::patch('/{post}', 'PostController@update')->middleware('auth:api');
    Route::delete('/{post}', 'PostController@destory')->middleware('auth:api');


});
