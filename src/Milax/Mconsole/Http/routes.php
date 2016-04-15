<?php

Route::group([
    'prefix' => 'mconsole',
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Http\Controllers',
], function () {
    
    // Authentication
    Route::get('/login', 'MconsoleController@login');
    Route::post('/login', 'MconsoleController@auth');
    Route::get('/logout', 'MconsoleController@logout');
    
    // Mconsole root
    Route::get('/', 'MconsoleController@index');
    
    // API
    Route::group([
        'prefix' => 'api',
    ], function () {
        Route::get('/notifications', 'APIController@getNotifications');
        Route::get('/notifications/{id}/seen', 'APIController@seeNotification');
        Route::get('/search', 'APIController@doSearch');
        Route::any('/images/upload', 'API\ImagesController@uploadImage');
        Route::get('/images/get', 'API\ImagesController@get');
        Route::get('/images/delete/{file}', 'API\ImagesController@deleteImage');
    });
    
    // Resources
    Route::resource('/users', 'UsersController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/roles', 'RolesController');
    Route::resource('/presets', 'PresetsController');
    
    // Modules
    Route::group([
        'prefix' => 'modules',
    ], function () {
        Route::get('/', 'ModulesController@index');
        Route::get('/{id}/install', 'ModulesController@install');
        Route::get('/{id}/uninstall', 'ModulesController@uninstall');
        Route::get('/{id}/extend', 'ModulesController@extend');
    });
    
    // Settings
    Route::get('/settings', 'SettingsController@index');
    Route::post('/settings', 'SettingsController@save');
    Route::get('/settings/clearcache', 'SettingsController@clearCache');
    Route::get('/settings/reloadtrans', 'SettingsController@reloadTranslations');
    
    // Variables
    Route::get('/variables', 'VariablesController@index');
    Route::post('/variables', 'VariablesController@save');

});
