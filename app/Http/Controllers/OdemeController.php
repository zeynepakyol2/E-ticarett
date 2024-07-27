<?php

namespace App\Http\Controllers;

use App\Models\Siparis;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OdemeController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {

            return redirect()->route('kullanici.oturumac')
                ->with('mesaj-tur','info')
                ->with('mesaj','Ödeme işlemi için oturum açmanız veya kayıt olmanız gerekmektedir.');
        }
        elseif (count(Cart::content()) == 0) {
            return redirect()->route('anasayfa')
                ->with('mesaj-tur','info')
                ->with('mesaj','Ödeme işlemi için sepetinizde ürün bulunmalıdır.');
        }
        $kullanici_detay= auth()->user()->detay;
        return view('odeme',compact('kullanici_detay'));
    }
    public function odemeyap()
    {
        $siparis=request()->all();
        $siparis['sepet_id']=session('aktif_sepet_id');
        $siparis['banka']='Garanti';
        $siparis['taksit_sayisi']=1;
        $siparis['durum']='Siparişiniz Alındı';
        $siparis['sipariş_tutari']=Cart::subtotal();
        Siparis::create($siparis);
        Cart::destroy();
        session()->forget('aktif_sepet_id');
        return redirect()->route('siparisler')
            ->with('mesaj-tur','success')
            ->with('mesaj','Ödemeniz Başarılı Şekilde Gerçekleştirildi');

    }
}
