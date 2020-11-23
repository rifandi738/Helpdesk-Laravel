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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/home', function () {
    return view('layouts.home');
})->middleware('auth');
Route::get('/login','AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/login','AuthController@postLogin')->middleware('guest');
Route::get('/logout','AuthController@logout')->name('logout');
Route::get('/reset-password','AuthController@reset')->name('reset');
Route::get('/password/confirm/{id}','AuthController@password_confirm')->name('password-confirm');
Route::post('/sendEmail','AuthController@sendEmail')->name('sendEmail');
Route::post('/reset-password','AuthController@reset_password')->name('reset-password');
Route::put('/confirm-password/{id}','AuthController@confirm_password')->name('confirm-password');

Route::group(['middleware' => ['auth', 'superAdmin:1']],function(){
    Route::resource('status', 'StatusController');
    Route::resource('dashboard', 'DashboardController');
    Route::resource('aplikasi', 'AplikasiController');
    Route::resource('pengaduan', 'PengaduanController');
    Route::resource('pegawai', 'PegawaiController');
    Route::resource('klien', 'KlienController');
    Route::resource('divisi', 'DivisiController');
    Route::resource('jabatan', 'JabatanController');
    Route::get('showDetail/{id}', 'PengaduanController@showDetail')->name('showDetail');
    Route::resource('modul', 'ModulController');
    Route::get('/laporan', 'LaporanController@index')->name('laporan-pengaduan');
    Route::get('/cetak-laporan', 'LaporanController@cetakLaporan')->name('cetak-laporan');
    Route::get('getModul/{id}','PengaduanController@getModul');
    Route::get('getJabatan/{id}','PegawaiController@getJabatan');
    Route::get('/pengaduan/{id}/responStatus', 'PengaduanController@responSatus');

    ///
    Route::get('getPengaduan', 'PengaduanController@getPengaduan')->name('getPengaduan');
    Route::get('pengaduan/editPengaduan/{id}', 'PengaduanController@editPengaduan')->name('pengaduan.editPengaduan');
    Route::put('pengaduan/updatePengaduan/{id}', 'PengaduanController@updatePengaduan')->name('pengaduan.updatePengaduan');
    Route::post('postStore', 'PengaduanController@postStore')->name('postStore');
    Route::get('getCreate','PengaduanController@getCreate')->name('getCreate');
    Route::get('historyPengaduan', 'PengaduanController@historyPengaduan')->name('pengaduan-history');
});

Route::group(['middleware' => ['auth','notAdmin:2']], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('aplikasi', 'AplikasiController');
    Route::resource('pengaduan', 'PengaduanController');
    Route::resource('status', 'StatusController');
    Route::resource('modul', 'ModulController');
    Route::resource('klien', 'KlienController');
    Route::get('showDetail/{id}', 'PengaduanController@showDetail')->name('showDetail');
    Route::get('getModul/{id}','PengaduanController@getModul')->name('getModul');
    Route::get('/pengaduan/{id}/responStatus', 'PengaduanController@responStatus');
    Route::get('/laporan', 'LaporanController@index')->name('laporan-pengaduan');
    Route::get('/cetak-laporan', 'LaporanController@cetakLaporan')->name('cetak-laporan');
});


Route::group(['middleware' => ['auth','isUser:3']], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::get('getPengaduan', 'PengaduanController@getPengaduan')->name('getPengaduan');
    Route::get('showDetail/{id}', 'PengaduanController@showDetail')->name('showDetail');
    Route::get('/pengaduan/{id}/responStatus', 'PengaduanController@responStatus');
});


Route::group(['middleware' => ['auth']], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::get('getPengaduan', 'PengaduanController@getPengaduan')->name('getPengaduan');
    Route::get('pengaduan/editPengaduan/{id}', 'PengaduanController@editPengaduan')->name('pengaduan.editPengaduan');
    Route::put('pengaduan/updatePengaduan/{id}', 'PengaduanController@updatePengaduan')->name('pengaduan.updatePengaduan');
    Route::post('postStore', 'PengaduanController@postStore')->name('postStore');
    Route::get('getCreate','PengaduanController@getCreate')->name('getCreate');
    Route::get('historyPengaduan', 'PengaduanController@historyPengaduan')->name('pengaduan-history');
    Route::get('getModul/{id}','PengaduanController@getModul');
    Route::get('showDetail/{id}', 'PengaduanController@showDetail')->name('showDetail');
    Route::get('/pengaduan/{id}/responStatus', 'PengaduanController@responStatus');
});



