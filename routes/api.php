<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('contacts', 'ContactController@getAllContact');
Route::group(['prefix' => 'contact'], function () {
    Route::post('add-contact', 'ContactController@addContact');
    Route::get('get-contact/{id}', 'ContactController@getContact');
    Route::post('edit-contact', 'ContactController@editContact');
    Route::delete('delete-contact/{id}', 'ContactController@deleteContact');
});