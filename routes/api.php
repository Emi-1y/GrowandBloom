<?php

// Author: Emily Cardona Castañeda

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/plants', 'App\Http\Controllers\Api\PlantApiController@index')->name('api.plant.index');
Route::get('/plants/{id}', 'App\Http\Controllers\Api\PlantApiController@show')->name('api.plant.show');
