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
    return redirect()->route('deposit.create');
});

Route::get('deposits', 'DepositController@create')->name('deposit.create');
Route::post('deposits', 'DepositController@store')->name('deposit.store');


Route::get('drafts', 'DraftController@create')->name('draft.create');
Route::post('drafts/currency', 'DraftController@checkCurrencies')->name('draft.currencies');
Route::post('drafts', 'DraftController@store')->name('draft.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
