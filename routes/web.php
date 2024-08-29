<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/home', 'HomeController@index');
Route::get('', 'HomeController@index');
/**
 * Abonnez a newsletter
 */
Route::post('/newsletter/subscribe', 'NewsletterController@subscribe');

/*les pages*/
Route::get('/page/about', 'PagesController@about');
Route::get('/page/catalog', 'PagesController@catalog');
Route::get('/page/blog', 'PagesController@blog');
Route::get('/page/team', 'PagesController@team');

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

/*compliller PDF*/
Route::get('/booking/generate-pdf', 'BookingController@generatePdf');


/* USER CREATE */
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

/*login*/
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');

/*logout*/
Route::get('/logout', 'AuthController@delete');

/* COTE ADMIN GESTION AVEC L'APPLICATION */
Route::get('/manager/tracker', 'TrackerController@tracker');
Route::get('/manager/cars', 'ManagerController@cars');
Route::get('/manager/clients', 'ManagerController@clients');



Route::dispatch();
?>