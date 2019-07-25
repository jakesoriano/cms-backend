<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

Route::group(['prefix' => 'cms'], function () {
    Route::group(['prefix' => 'panel'], function () {
        Route::get('/' , 'PanelController@index');
        Route::post('/' , 'PanelController@store');
        Route::put('{id}' , 'PanelController@update');
        Route::delete('{id}' , 'PanelController@destroy');
    });
    Route::group(['prefix' => 'page'], function () {
        Route::get('/' , 'PageController@index');
        Route::post('/' , 'PageController@store');
        Route::put('{id}' , 'PageController@update');
        Route::delete('{id}' , 'PageController@destroy');

        Route::group(['prefix' => 'panel'], function () {
            Route::get('/' , 'PagePanelController@index');
            Route::get('{id}' , 'PagePanelController@getById');
            Route::post('/' , 'PagePanelController@store');
            Route::put('{id}' , 'PagePanelController@update');
            Route::delete('{page_id}' , 'PagePanelController@destroy');
            
            Route::group(['prefix' => 'content'], function () {
                Route::get('/' , 'PanelContentController@index');
                Route::get('{id}' , 'PanelContentController@getById');
                Route::post('/' , 'PanelContentController@store');
                Route::put('{id}' , 'PanelContentController@update');
                Route::delete('{page_id}' , 'PanelContentController@destroy');
            });
        });
    });
    Route::group(['prefix' => 'file'], function () {
        Route::post('/upload' , 'FileController@index');
        Route::get('/upload' , 'FileController@get');
    });
});
Route::group(['prefix' => 'web-views'], function () {
    Route::get('{slug}' , 'WebController@index');
});