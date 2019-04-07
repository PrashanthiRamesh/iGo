<?php

use Illuminate\Http\Request;
use App\OpusCard;

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

Route::get('stm/opus_cards', 'OpusCardController@index');
Route::get('stm/opus_cards/{id}', 'OpusCardController@show');
Route::get('stm/opus_cards/email/{email}', 'OpusCardController@find');
Route::post('stm/opus_cards', 'OpusCardController@store');
Route::put('stm/opus_cards/{id}', 'OpusCardController@update');
Route::delete('stm/opus_cards/{id}', 'OpusCardController@delete');