<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/postarina/vrsta/{id_vrsta}/masa/{masa}', 'CenovnikController@dohvatiCenuPostarine')->name('cena-postarine');
Route::get('/', 'SiteController@index')->name('index');

Route::group([
    'middleware' => ['cmsAuth'],
    'as' => 'cms.',
    'prefix'=> 'cms'
], function() {
    Route::group(['middleware' => ['notLoggedIn']], function () {
        /// ovde rute ako nije je ulogovan
        Route::get('/', 'LoginController@loginFront')->name('login-front');
        Route::post('/', 'LoginController@loginBack')->name('login-back');
    });

    Route::group(['middleware' => ['isLoggedIn']], function () {
        /// ovde rute ako je ulogovan
        Route::get('/logout', 'LoginController@logout')->name('logout');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::resources([
            'posiljka' => 'PosiljkaController',
            'dostava' => 'DostavaController'
        ]);

        Route::get('/posiljke/{ids?}', 'DostavaController@posiljke')->name('posiljke');
        Route::get('/posiljke-unete/{id?}', 'DostavaController@posiljkeUnete')->name('posiljke-unete');

        Route::get('/posiljaoci-primaoci/{ime?}', 'PosiljalacPrimalacController@getPosiljaoci')->name('posiljaoci-primaoci');
    });
});
