<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Home And Signin/up
Route::get('/','HomeController@index')->name('home');
Route::get('/signin','HomeController@signin');
Route::get('/signup','HomeController@signup');
Route::get('/lupapass','HomeController@lupapass');

// Program
Route::get('/program/detail/ongoing/{id}','HomeController@detailongoing')->middleware('auth');
Route::get('/program/detail/upcoming/{id}','HomeController@detailupcoming')->middleware('auth');
Route::get('/program/daftar/mistalk/{id}','HomeController@daftarmistalk')->middleware('auth');
Route::get('/program/daftar/coachclinic/{id}','HomeController@daftarcclinic')->middleware('auth');
Route::get('/program/daftar/kubis/{id}','HomeController@daftarkubis')->middleware('auth');
Route::get('/program/daftar/sukses','HomeController@suksesdaftar');

// Proses daftar program
Route::post('/program/proses/mistalk','HomeController@prosesmistalk');
Route::post('/program/proses/cclinic','HomeController@prosescclinic');
Route::post('/program/proses/kubis','HomeController@proseskubis');

// Admin
Route::get('/miadmin','MiadminController@index')->name('loginadmin');
Route::get('/miadmin/homeadmin','MiadminController@homeadmin')->middleware('adminauth');
Route::get('/miadmin/datafinalis','MiadminController@datafinalis')->middleware('adminauth');
Route::get('/miadmin/datamis','MiadminController@datamis')->middleware('adminauth');
Route::get('/miadmin/datamistalk','MiadminController@datamistalk')->middleware('adminauth');
Route::get('/miadmin/datacclinic','MiadminController@datacclinic')->middleware('adminauth');
Route::get('/miadmin/datakubis','MiadminController@datakubis')->middleware('adminauth');
Route::get('/miadmin/dataprogram','MiadminController@dataprogram')->middleware('adminauth');
Route::get('/miadmin/formprogram','MiadminController@formprogram')->middleware('adminauth');
Route::get('/miadmin/ubahprogram/{id}','MiadminController@ubahprogram')->middleware('adminauth');
Route::get('/miadmin/logoutadmin', 'MiadminController@logoutadmin')->middleware('adminauth');

// PROSES ADMIN
Route::post('/miadmin/cekadmin', 'MiadminController@cekadmin');
Route::get('/miadmin/hapusprogram/{id}', 'MiadminController@hapusprogram')->middleware('adminauth');
Route::post('/miadmin/inputprogram', 'MiadminController@inputprogram')->middleware('adminauth');
Route::get('/miadmin/ubahprogram/{id}', 'MiadminController@ubahprogram')->middleware('adminauth');
Route::post('/miadmin/prsubahprogram', 'MiadminController@prsubahprogram')->middleware('adminauth');
Route::get('/miadmin/xlsmis', 'MiadminController@xlsmis')->middleware('adminauth');
Route::get('/miadmin/xlsfinal', 'MiadminController@xlsfinalis')->middleware('adminauth');
Route::get('/miadmin/xlsmistalk', 'MiadminController@xlsmistalk')->middleware('adminauth');
Route::get('/miadmin/xlscclinic', 'MiadminController@xlscclinic')->middleware('adminauth');
Route::get('/miadmin/xlskubis', 'MiadminController@xlskuliahbisnis')->middleware('adminauth');

// Akun proses
Route::post('/akun/buatakun', 'AkunController@buatakun');
Route::post('/akun/loginakun', 'AkunController@loginakun');
Route::post('/akun/hapussession', 'AkunController@hapussession');
Route::post('/akun/lupapass', 'AkunController@lupapass');
Route::post('/akun/ubahpass', 'AkunController@ubahpass');

// Program proses
Route::get('/home/pastprogram/{page}', 'HomeController@pastprogram')->where('page', '[0-9]+');
Route::get('/home/ongoingprogram', 'HomeController@ongoingprogram');
Route::get('/home/upcomingprogram', 'HomeController@upcomingprogram');
