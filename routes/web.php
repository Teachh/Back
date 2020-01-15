<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

// grupo nuestro
Route::group(['middleware' => 'auth'], function () {
  // productos
  Route::get('productos', 'ProductController@indexDash')->name('apartados.products');
  Route::post('/productos/crear','ProductController@createDash');
  Route::get('productos/crear', function () {
    return view('apartados.products-create');
  })->name('products.create');
  Route::put('/productos/delete/{id}','ProductController@deleteDash');
  Route::get('/productos/edit/{id}','ProductController@getEditDash');
  Route::put('/productos/edit/{id}','ProductController@putEditDash');
  Route::get('productos/search', 'ProductController@searchDash');
  // ingredientes
  Route::get('ingredientes', 'IngredientController@indexDash')->name('apartados.ingredients');
  Route::get('ingredientes/search', 'IngredientController@searchDash');
  Route::post('/ingredientes/crear','IngredientController@createDash');
  Route::put('/ingredientes/delete/{id}','IngredientController@deleteDash');
  Route::get('ingredientes/crear', function () {
    return view('apartados.ingredients-create');
  })->name('ingredients.create');
  // pedidos
  Route::get('/pedidos/{id}','OrderController@showDash');


});
