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
Route::get('/postarina/vrsta/{id_vrsta}/masa/{masa}/ugovor/{id_ugovor}', 'CenovnikController@dohvatiCenuPostarine')->name('cena-postarine');
Route::get('/broj-posiljke-validacija/{broj?}', 'PosiljkaController@proveraBrojaPosiljke')->name('broj-posiljke-validacija');

// Sajt
Route::get('/', 'SiteController@index')->name('index');
Route::get('/kontakt', 'SiteController@contact')->name('contact');
Route::get('/cenovnik', 'SiteController@cenovnik')->name('cenovnik');

Route::get('/pretraga-posiljke/{broj_posiljke?}', 'PosiljkaController@vratiStatuse')->name('pretraga-posiljke');

// CMS
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
            'dostava' => 'DostavaController',
            'kompanija' => 'CompanyController',
            'ugovor' => 'UgovorController'
        ]);

        Route::get('/posiljke/{ids?}', 'DostavaController@posiljke')->name('posiljke');
        Route::get('/posiljke-na-dostavi/{ids?}/{dostava_id?}', 'DostavaController@posiljkeNaDostavi')->name('posiljke-na-dostavi');
        Route::get('/posiljke-unete/{id?}', 'DostavaController@posiljkeUnete')->name('posiljke-unete');
        Route::get('/razduzi/{id?}', 'DostavaController@razduzi')->name('razduzi');

        Route::get('/posiljaoci-primaoci/{ime?}', 'PosiljalacPrimalacController@getPosiljaoci')->name('posiljaoci-primaoci');

        Route::get('/posiljka-status/{id_posiljka?}/{id_spisak?}/{status?}', 'PosiljkaController@updateStatus')->name('posiljka-status');
        Route::get('/posiljka-status-vracena/{id_posiljka?}/{id_spisak?}/{status?}', 'PosiljkaController@updateStatusVracena')->name('posiljka-status-vracena');

        Route::get('/posiljalac-izvestaj/{id}/{posiljalac_id}', 'DostavaController@spisakPoPosiljaocu')->name('posiljalac-izvestaj');
        Route::get('/posiljalac-izvestaj-spiskovi/{spiskovi}/{posiljalac_id}/{datum}', 'DostavaController@spiskoviPoPosiljaocu')->name('posiljalac-izvestaj-spiskovi');

        Route::get('/dostava-brisanje-priprema/{id?}', 'DostavaController@proveraZaBrisanje')->name('dostava-brisanje-provera');
        Route::get('/dostava-brisanje/{id?}', 'DostavaController@destroy')->name('dostava-brisanje');
    });
});
