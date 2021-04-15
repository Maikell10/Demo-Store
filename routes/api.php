<?php

use Illuminate\Http\Request;

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

Route::apiResource('category','API\CategoryController')->names('api.category');

Route::get('sub-category','API\CategoryController@getSubCategories')->name('api.sub-category');

Route::get('main-category','API\CategoryController@getMainCategories')->name('api.main-category');

Route::apiResource('product','API\ProductController')->names('api.product');

Route::delete('/eliminarImagen/{id}','API\ProductController@eliminarImagen')->name('api.eliminarImagen');

Route::get('/autocomplete', 'API\AutocompleteController@autocomplete')->name('autocomplete');
Route::get('/autocomplete_index', 'API\AutocompleteController@autocomplete_index')->name('autocomplete_index');

// Rating
Route::get('rating/new','API\ProductController@setRating')->name('api.setRating');
Route::get('rating/{id}','API\ProductController@getRating')->name('api.getRating');

// AddProduct Shopping
Route::get('shopping/add','API\ProductController@fillTable')->name('api.fillTable');

// Edit User-Profile
Route::get('profile/edit','Store\ProfileController@updateUser')->name('api.updateUser');
