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
})->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::get('/linked_opus_cards', 'LinkedOpusCardController@index')->name('opus_cards')->middleware('verified');

Route::get('/link_opus_card', 'LinkedOpusCardController@form')->name('opus_cards')->middleware('verified');

Route::post('/link_opus_card', 'LinkedOpusCardController@store')->name('opus_cards')->middleware('verified');