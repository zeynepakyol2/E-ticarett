<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UrunController;
use App\Http\Controllers\SepetController;
use App\Http\Controllers\OdemeController;
use App\Http\Controllers\SiparisController;
use App\Http\Controllers\KullaniciController;
use App\Http\Controllers\Yonetim\YonetimController;
use App\Http\Controllers\Yonetim\YonetimAnaController;


Route::group(['prefix' => 'yonetim', 'namespace' => 'Yonetim'], function () {
    Route::redirect('/', 'yonetim/oturumac');
    Route::get('/oturumukapat', [YonetimController::class, 'oturumukapat'])->name('yonetim.oturumukapat');
    Route::match(['get', 'post'], '/oturumac', [YonetimController::class, 'oturumac'])->name('yonetim.oturumac');
    //kendimiz auth gibi özel bi middlewear tanımladık
    Route::group(['middleware' => ['yonetim']], function () {
        Route::get('/anasayfa', [YonetimAnaController::class, 'index'])->name('yonetim.anasayfa');
        Route::group(['prefix' => 'kullanici'], function () {
            Route::match(['get', 'post'], '/', [YonetimController::class, 'index'])->name('yonetim.kullanici');
            Route::post('/yeni', [YonetimController::class, 'form'])->name('yonetim.kullanici.yeni');
            Route::get('/duzenle/{id}', [YonetimController::class, 'form'])->name('yonetim.kullanici.duzenle');
            Route::post('/kaydet/{id?}', [YonetimController::class, 'kaydet'])->name('yonetim.kullanici.kaydet');
            Route::get('/sil/{id}', [YonetimController::class, 'sil'])->name('yonetim.kullanici.sil');


        });
    });
});
Route::get('/', [AnasayfaController::class, 'index'])->name('anasayfa');
Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
Route::get('/kategori/{slug_kategoriadi}', [KategoriController::class, 'index'])->name('kategori');
Route::get('/urun/{slug_urunadi}', [UrunController::class, 'index'])->name('urun');

Route::get('/odeme', [OdemeController::class, 'index'])->name('odeme');
Route::post('/odeme', [OdemeController::class, 'odemeyap'])->name('odemeyap');

//sadece giriş yapmış kullanıcılar siparişleri görsün istiyoruz bu yüzden middleware yapısını kullandık
Route::group(['middleware' => ['auth']], function () {
    Route::get('/siparisler', [SiparisController::class, 'index'])->name('siparisler');
    Route::get('/siparisler/{id}', [SiparisController::class, 'detay'])->name('siparis');
//bu yöntem ile sadece giriş yapmış kişilerin erişebileceğini belirttik controller içinde __construct methodu ile de bunu yapabilriz

});
Route::group(['prefix' => 'sepet'], function () {
    Route::get('/', [SepetController::class, 'index'])->name('sepet');
    Route::post('/ekle', [SepetController::class, 'ekle'])->name('sepet.ekle');
    Route::delete('/kaldır/{rowId}', [SepetController::class, 'kaldir'])->name('sepet.kaldir');
    Route::delete('/bosalt', [SepetController::class, 'bosalt'])->name('sepet.bosalt');


});

Route::get('/kullanici/oturumac', [KullaniciController::class, 'giris_form'])->name('kullanici.oturumac');
Route::get('/kullanici/kaydol', [KullaniciController::class, 'kaydol_form'])->name('kullanici.kaydol');
Route::get('/kullanici/sifre-form', [KullaniciController::class, 'sifre_form'])->name('kullanici.sifre_form');
Route::post('/ara', [UrunController::class, 'ara'])->name('urun_ara');
Route::post('/kaydol', [KullaniciController::class, 'kaydol'])->name('kul.kaydol');
Route::post('/kullanici/oturumac', [KullaniciController::class, 'giris'])->name('kul.oturumac');
Route::post('/oturumukapat', [KullaniciController::class, 'oturumukapat'])->name('kullanici.oturumukapat');

