<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/naselje', 'API\ApiController@getNaselja')->name('api.naselje');
Route::get('/pravo-naselje', 'API\ApiController@getPravoNaselje')->name('api.pravo-naselje');

Route::get('/firme', 'API\ApiController@apiFirme')->name('api.firme');
Route::get('/ulice', 'API\ApiController@apiUlice')->name('api.ulice');
Route::get('/naselja', 'API\ApiController@apiNaselja')->name('api.naselja');
Route::get('/primalac-posiljalac', 'API\ApiController@apiPrimalacPosiljalac')->name('api.primalac-posiljalac');
Route::get('/racuni', 'API\ApiController@apiRacuni')->name('api.racuni');
Route::get('/ugovori', 'API\ApiController@apiUgovori')->name('api.ugovori');