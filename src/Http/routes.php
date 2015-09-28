<?php

Route::group(['middleware' => 'mconsole'], function () {
	
	Route::get('mconsole/login', 'Milax\Mconsole\Http\Controllers\MconsoleController@login');
	Route::post('mconsole/login', 'Milax\Mconsole\Http\Controllers\MconsoleController@auth');
	
	Route::resource('mconsole', 'Milax\Mconsole\Http\Controllers\MconsoleController');
});