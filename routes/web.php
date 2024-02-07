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
Route::get('/aktivacija-naloga/{hash}', 'SiteController@aktivacijaNaloga')->name('aktivacija-naloga');

// Sajt
Route::get('/', 'SiteController@index')->name('index');
Route::get('/kontakt', 'SiteController@contact')->name('contact');
Route::get('/cenovnik', 'SiteController@cenovnik')->name('cenovnik');
Route::get('/onama', 'SiteController@onama')->name('about');
Route::get('/wordtemplate', 'DashboardController@adresniceTemplate');

Route::get('/pretraga-posiljke/{broj_posiljke?}', 'PosiljkaController@vratiStatuse')->name('pretraga-posiljke');

Route::post('/send-email', 'SiteController@contactSendEmail')->name('send-mail-contact');

Route::get('/sms', 'SMSController@sendSMSTwilioService');

Route::group(['middleware' => ['notLoggedInSite']], function () {
    /// ovde rute ako nije je ulogovan
    Route::get('/registracija', 'SiteController@registracija')->name('registracija');
    Route::post('/registracija', 'SiteController@registracijaPost')->name('registracijaPost');
    Route::get('/validate-email/{email?}', 'SiteController@validateEmail')->name('validate-email');
    Route::post('/prijava', 'SiteController@prijava')->name('prijava-login');
});

Route::group(['middleware' => ['isLoggedInSite']], function () {
    /// ovde rute ako je ulogovan
    Route::get('/logout-site', 'SiteController@logoutSite')->name('logout');
    Route::get('/dashboard-site', 'SiteController@dashboardSite')->name('dashboard-site');
    Route::get('/posiljke-site', 'SiteCMSController@posiljke')->name('posiljke-site');
    Route::get('/posiljke-nova-site', 'SiteCMSController@posiljkaNova')->name('posiljke-nova-site');
    Route::post('/posiljke-nova-site', 'SiteCMSController@posiljkaNovaStore')->name('posiljke-nova-store-site');
    Route::get('/posiljka-izmena-site/{id}', 'SiteCMSController@posiljkaIzmena')->name('posiljka-izmena-site');
    Route::post('/posiljka-update-site/{id}', 'SiteCMSController@posiljkaIzmenaUpdate')->name('posiljka-update-site');
    Route::get('/moja-firma', 'SiteCMSController@izmenaFirmeEdit')->name('moja-firma');
    Route::post('/moja-firma', 'SiteCMSController@izmenaFirmeUpdate')->name('moja-firma-post');
    Route::get('/posiljke-excel-unos', 'SiteCMSController@unosPosiljkiExcel')->name('posiljke-excel-unos');
    Route::post('/posiljke-excel-unos', 'SiteCMSController@unosPosiljkiExcelStore')->name('posiljke-excel-unos-store');
    Route::post('/posiljke-delete-mass', 'PosiljkaController@destroyMass')->name('posiljke-delete-mass');
});

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
            'ugovor' => 'UgovorController',
            'radnik' => 'RadnikController',
            'korisnik' => 'KorisnikController',
            'te_grad' => 'TEGradController',
            'te_opstina' => 'TEOpstinaController',
            'te_naselje' => 'TENaseljeController',
            'te_ulica' => 'TEUlicaController'
        ]);

        Route::get('/posiljke-eksterne', 'PosiljkaController@indexEksterne')->name('posiljke-eksterne');
        Route::get('/posiljke-stornirane', 'PosiljkaController@indexStornirane')->name('posiljke-stornirane');
        Route::get('/posiljka-vrati/{id}', 'PosiljkaController@restore')->name('posiljka-restore');
        Route::get('/posiljka-import/{id}', 'PosiljkaController@import')->name('posiljka-import');
        Route::post('/posiljka-import-multiple', 'PosiljkaController@importMultiple')->name('posiljka-import-multiple');

        Route::get('/posiljke/{ids?}', 'DostavaController@posiljke')->name('posiljke');
        Route::get('/posiljke-na-dostavi/{ids?}/{dostava_id?}', 'DostavaController@posiljkeNaDostavi')->name('posiljke-na-dostavi');
        Route::get('/posiljke-unete/{id?}', 'DostavaController@posiljkeUnete')->name('posiljke-unete');
        Route::get('/razduzi/{id?}', 'DostavaController@razduzi')->name('razduzi');
        Route::get('/razduzi-sve/{id?}', 'DostavaController@razduziSve')->name('razduzi-sve');

        Route::get('/posiljaoci-primaoci/{ime?}', 'PosiljalacPrimalacController@getPosiljaoci')->name('posiljaoci-primaoci');

        Route::get('/posiljka-status/{id_posiljka?}/{id_spisak?}/{status?}', 'PosiljkaController@updateStatus')->name('posiljka-status');
        Route::get('/posiljka-status-vracena/{id_posiljka?}/{id_spisak?}/{status?}', 'PosiljkaController@updateStatusVracena')->name('posiljka-status-vracena');

        Route::get('/posiljalac-izvestaj/{id}/{posiljalac_id}', 'DostavaController@spisakPoPosiljaocu')->name('posiljalac-izvestaj');
        Route::get('/posiljalac-izvestaj-spiskovi/{spiskovi}/{posiljalac_id}/{datum_od}/{datum_do}', 'DostavaController@spiskoviPoPosiljaocu')->name('posiljalac-izvestaj-spiskovi');
        Route::post('/posiljalac-izvestaj-spiskovi-svi', 'DostavaController@spiskoviPoPosiljaocuSvi')->name('posiljalac-izvestaj-spiskovi-svi');

        Route::get('/dostava-brisanje-priprema/{id?}', 'DostavaController@proveraZaBrisanje')->name('dostava-brisanje-provera');
        Route::get('/dostava-brisanje/{id?}', 'DostavaController@destroy')->name('dostava-brisanje');

        Route::get('/update-barkodovi', 'PosiljkaController@updateBarKodoviBezSlike');

        Route::post('/upload-excel', 'DashboardController@uploadExcel')->name('upload.excel');
    });
});
