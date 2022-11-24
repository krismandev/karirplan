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
    return redirect(Route('login'));
});

Auth::routes();
Route::post('/submit_login','LoginController@submitLogin')->name('loginwoy');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil', 'ProfilController@index')->name('profil');
Route::get('/profil/gantiSandi', 'ProfilController@gantiSandi');

Route::get('/plan', 'PlanController@index')->name('plan');
Route::get('/plan/input', 'PlanController@input');
Route::post('/plan/input', 'PlanController@store')->name('kirim_plan');

Route::get('Api', function() {return "API";})->name("api");
Route::post('Api/profil/update', 'API\Profil@updateProfil');
Route::post('Api/profil/update/sandi', 'API\Profil@updateSandi');

Route::get('/hasil_plan', 'hasilController@index')->name('hasil_plan');
Route::get('/hasil_plan/{id}', 'hasilController@delete');