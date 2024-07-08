<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/','AnasayfaController@index')->name('anasayfa');
Route::get('/merhaba',function (){
    return "merhaba";
});
Route::get('api/v1/merhaba',function(){
    return ['mesaj'=>'merhaba'];
});
Route::get('urun/{urunadi}/{id?}',function ($urunadi,$id=4){
    return "urun adı: $id $urunadi";
})->name('urun_detay'); //name fonksiyonu ile bu route a erişebilriiz
Route::get('/kampanya',function (){
    return redirect()->route('urun_detay',['urunadi'=>'elma','id'=>5]);
});
