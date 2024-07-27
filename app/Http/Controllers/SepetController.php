<?php

namespace App\Http\Controllers;

use App\Models\SepetUrun;
use App\Models\Urun;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Sepet;

class SepetController extends Controller
{
    public function index()
    {
        return view('sepet');
    }

    public function ekle()
    {
        $urun = Urun::find(request('id'));
        $cartItem = Cart::add($urun->id, $urun->urun_adi, 1, $urun->fiyat);
        if (auth()->check()) {
             $aktif_sepet_id = session('aktif_sepet_id2');
            if (!isset($aktif_sepet_id)) {
                $aktif_sepet = Sepet::create([
                    'kullanici_id' => auth()->id(),
                ]);
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id2', $aktif_sepet->id);
            } else {
                $aktif_sepet = Sepet::findorfail($aktif_sepet_id);
            }


            SepetUrun::updateOrCreate(
                [
                    'sepet_id' => $aktif_sepet->id,
                    'urun_id' => $urun->id
                ],
                [
                    'adet' => $cartItem->qty,
                    'fiyat' => $cartItem->price,
                    'durum' => 'beklemede',
                    'urun_id'=>$urun->id
                ]
            );

        }

        return redirect()->route('sepet')
            ->with('mesaj_tur', 'success')
            ->with('mesaj', 'Ürün Sepete Eklendi');
    }

    public function kaldir($rowId)
    {
        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowId);
            SepetUrun::where('sepet_id', $aktif_sepet_id)->where('urun_id', $cartItem->id)->delete();
        }
        Cart::remove($rowId);
        return redirect()->route('sepet')
            ->with('mesaj_tur', 'succes')
            ->with('mesaj', 'Ürün Sepetten Kaldırıldı');
    }

    public function bosalt()
    {
        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');

            SepetUrun::where('sepet_id', $aktif_sepet_id)->delete();
        }
        Cart::destroy();
        return redirect()->route('sepet')
            ->with('mesaj_tur', 'succes')
            ->with('mesaj', 'Sepetiniz Boşaltıldı');
    }
}
