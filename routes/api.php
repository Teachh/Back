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
// usuarios √
Route::resource('users', 'UserController');
// product √
Route::resource('products', 'ProductController');
//alergenos √
Route::resource('allergens', 'AllergenController');
// orders √
Route::resource('orders', 'OrderController');
// messages √
Route::resource('messages', 'MessageController');
// ingredietns √
Route::resource('ingredients', 'IngredientController');
// noticias √
Route::resource('news', 'NoticiaController');
// categorias
Route::resource('categories', 'CategoryController');
