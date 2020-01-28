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
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

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
  Route::put('profile/image', ['as' => 'profile.image', 'uses' => 'ProfileController@image']);
});

// grupo nuestro
Route::group(['middleware' => 'auth'], function () {
  // productos
  Route::get('productos', 'ProductController@indexDash')->name('apartados.products');
  Route::post('productos/crear', 'ProductController@createDash');
  Route::get('productos/crear', function () {
    return view('apartados.products-create');
  })->name('products.create');
  Route::put('productos/delete/{id}', 'ProductController@deleteDash');
  Route::get('productos/edit/{id}', 'ProductController@getEditDash');
  Route::put('productos/edit/{id}', 'ProductController@putEditDash');
  Route::get('productos/search', 'ProductController@searchDash');
  // ingredientes
  Route::get('ingredientes', 'IngredientController@indexDash')->name('apartados.ingredients');
  Route::get('ingredientes/search', 'IngredientController@searchDash');
  Route::post('ingredientes/crear', 'IngredientController@createDash');
  Route::get('ingredientes/edit/{id}', 'IngredientController@getEditDash');
  Route::put('ingredientes/edit/{id}', 'IngredientController@putEditDash');
  Route::put('ingredientes/delete/{id}', 'IngredientController@deleteDash');
  Route::get('ingredientes/crear', function () {
    return view('apartados.ingredients-create');
  })->name('ingredients.create');
  // pedidos
  Route::get('pedidos/search', 'OrderController@searchDash');
  Route::get('pedidos/{id}', 'OrderController@showDash');
  Route::put('pedidos/delete/{id}', 'OrderController@deleteDash');
  Route::put('pedidos/edit/{id}', 'OrderController@setEntregado');
  Route::get('pedidos', 'OrderController@indexDash')->name('apartados.orders');
  Route::get('pedidos', 'OrderController@indexDash')->name('apartados.orders');
  // Mensajes
  Route::get('mensajes', 'MessageController@indexDash')->name('apartados.messages');
  Route::get('mensajes/search', 'MessageController@searchDash');
  Route::put('mensajes/delete/{id}', 'MessageController@deleteDash');

  //categorias
  Route::get('categorias', 'CategoryController@indexDash')->name('apartados.categories');
  Route::get('categorias/search', 'CategoryController@searchDash');
  Route::post('categorias/crear', 'CategoryController@createDash');
  Route::get('categorias/edit/{id}', 'CategoryController@getEditDash');
  Route::put('categorias/edit/{id}', 'CategoryController@putEditDash');
  Route::put('categorias/delete/{id}', 'CategoryController@deleteDash');
  Route::get('categorias/crear', function () {
    return view('apartados.categories-create');
  })->name('categorias.create');
  //alergenos
  Route::get('alergenos', 'AllergenController@indexDash')->name('apartados.alergens');
  Route::get('alergenos/search', 'AllergenController@searchDash');
  Route::post('alergenos/crear', 'AllergenController@createDash');
  Route::get('alergenos/edit/{id}', 'AllergenController@getEditDash');
  Route::put('alergenos/edit/{id}', 'AllergenController@putEditDash');
  Route::put('alergenos/delete/{id}', 'AllergenController@deleteDash');
  Route::get('alergenos/crear', function () {
    return view('apartados.allergens-create');
  })->name('alergenos.create');
  //noticias
  Route::get('noticias', 'NoticiaController@indexDash')->name('apartados.noticias');
  Route::get('noticias/search', 'NoticiaController@searchDash');
  Route::post('noticias/crear', 'NoticiaController@createDash');
  Route::get('noticias/edit/{id}', 'NoticiaController@getEditDash');
  Route::put('noticias/edit/{id}', 'NoticiaController@putEditDash');
  Route::put('noticias/delete/{id}', 'NoticiaController@deleteDash');
  Route::get('noticias/crear', function () {
    return view('apartados.noticias-create');
  })->name('noticias.create');
  //tascas
  Route::post('home', 'TaskController@createDash');
  Route::put('delete/{id}', 'TaskController@deleteDash');
  Route::post('edit/{id}', 'TaskController@putEditDash');
  Route::post('view/{id}', 'TaskController@putFinishDash');
});
