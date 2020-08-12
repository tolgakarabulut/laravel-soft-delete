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


Route::group(['prefix'=>'blog'], static function(){
    Route::get('all','BlogController@all');
    Route::get('list','BlogController@list');
    Route::get('only-trashed','BlogController@onlyTrashed');
    Route::post('store','BlogController@store');
    Route::delete('delete/{id}','BlogController@delete');
    Route::patch('restore/{id}','BlogController@restore');
});

