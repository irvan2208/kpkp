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
    return view('index');
})->middleware('auth');

Route::get('index', function () {
    return view('index');
});

// Route::get('starter', function () {
//     return view('starter');
// });

Route::get('admin/users/create','UserController@showprodi')->middleware('auth');
Route::get('admin/users','UserController@showuser')->middleware('auth');
Route::get('admin/users/{npm}/edit','UserController@edit')->middleware('auth');
Route::put('admin/users/{npm}','UserController@update')->middleware('auth');

Route::post('admin/users','UserController@store')->middleware('auth');

Route::get('pembayaran/baru','TransactionController@show')->middleware('auth');
Route::post('pembayaran/baru','TransactionController@tambah')->middleware('auth');

Route::get('pembayaran/konfirmasi', function () {
    return view('conpembayaran');
})->middleware('auth');

Route::get('admin/perpanjangan', function () {
    return view('4dm/perpanjangan');
})->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index');

