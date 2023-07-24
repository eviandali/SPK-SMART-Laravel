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
    return view('cpywelcome');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'pengguna', 'middleware' => ['auth']], function() {
    Route::resource('kriteria', 'KriteriaController');
});

Route::group(['prefix' => 'pengguna', 'middleware' => ['auth']], function() {
    Route::resource('alternatif', 'AlternatifController');
    Route::get('alternatif/{id}', 'AlternatifController@detail')->name('alternatif.hasil');
    Route::get('/alternatif/{id}/managedoi', 'AlternatifController@managedoi')->name('alternatif.managedoi');

});

Route::group(['prefix' => 'pengguna', 'middleware' =>['auth']], function(){
    Route::resource('pembobotan', 'PembobotanController');
    Route::POST('/pembobotan/hitung', 'PembobotanController@hitung')->name('pembobotan.hitung');

});

Route::group(['prefix' => 'pengguna', 'middleware' =>['auth']], function(){
    Route::resource('hasil', 'HasilController');
    Route::get('hasil/{id}', 'HasilController@detail')->name('detailHasil');

});
