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
    return view('quality');
});
Route::post('/', function () {
    return view('quality');
});
Route::get('currency','App\Http\Controllers\CurrencyController@index_ajx');
Route::post('currency','App\Http\Controllers\CurrencyController@index_ajx');
Route::get('sendmail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('sidneidecerqueira@gmail.com')->send(new \App\Mail\SendMail($details));
   
    dd("Email is Sent.");
});

