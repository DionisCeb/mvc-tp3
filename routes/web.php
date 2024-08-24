<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/home', 'HomeController@index');
Route::get('', 'HomeController@index');

/*les pages*/
Route::get('/page/about', 'AboutController@index');
Route::get('/page/catalog', 'CatalogController@index');
Route::get('/page/blog', 'BlogController@index');
Route::get('/page/team', 'TeamController@index');

/*creer une reservation*/
Route::get('/booking/create', 'BookingController@create');
Route::post('/booking/create', 'BookingController@store');
/*reservations liste*/
Route::get('/bookings', 'BookingController@list');

/*reservation specifique*/
Route::get('/booking/show', 'BookingController@show');

/*modifier la réservation*/
Route::get('/booking/edit', 'BookingController@edit');
Route::post('/booking/edit', 'BookingController@update');

/*supprimer une reservation*/
Route::post('/booking/delete', 'BookingController@delete');

/* USER CREATE */
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

/*login*/
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');

/*logout*/
Route::get('/logout', 'AuthController@delete');




Route::dispatch();
?>