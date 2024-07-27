<?php

namespace App\Http\Controllers;

use App\Models\Kullanici;
use App\Models\SepetUrun;
use Dotenv\Util\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Sepet;


class KullaniciController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('oturumukapat');
    }
    public function giris_form()
    {
        return view('kullanici.oturumac');
    }

    public function giris()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'sifre' => 'required'
        ]);


        if (auth()->attempt(['email' => request('email'), 'password' => request('sifre')], request()->has('benihatirla'))) {
            request()->session()->regenerate();

            $aktif_sepet_id=Sepet::firstOrCreate(['kullanici_id'=>auth()->id()])->id;
            session()->put('aktif_sepet_id', $aktif_sepet_id);

            if (Cart::count()>0)
            {
                foreach (Cart::content() as $cartItem)
                {
                    SepetUrun::updateOrCreate(
                        ['sepet_id' => $aktif_sepet_id, 'urun_id' => $cartItem->id],
                        ['adet'=>$cartItem->qty,'fiyat'=>$cartItem->price,'durum'=>'beklemede']
                    );
                }
            }
            Cart::destroy();
            $sepetUrunler= SepetUrun::where('sepet_id',$aktif_sepet_id)->get();
            foreach ($sepetUrunler as $sepetUrun){
                Cart::add($sepetUrun->urun->id,$sepetUrun->urun->urun_adi,$sepetUrun->adet,$sepetUrun->fiyat);
            }
            return redirect()->intended('/');
        } else {
            $errors = 'Hatalı Giriş';
            return back()->withErrors($errors);
        }

    }


    public function kaydol_form()
    {
        return view('kullanici.kaydol');
    }

    public function sifre_form()
    {
        return view('kullanici.sifre_form');
    }

    public function kaydol()
    {
        $this->validate(request(), [
            'adsoyad' => 'required|min:3|max:60',
            'email' => 'required|email|unique:kullanici',
            'sifre' => 'required|confirmed|min:6',
        ]);

        $kullanici = Kullanici::create([
            'adsoyad' => request('adsoyad'),
            'email' => request('email'),
            'sifre' => \Hash::make(request('sifre')),
            'aktivasyon_anahtari' => \Illuminate\Support\Str::random(60),
            'aktif_mi' => 0,
        ]);
        $kullanici->detay()->save(new KullaniciDetay());
        auth()->login($kullanici);
        return redirect()->route('anasayfa');


    }

    public function showRegistrationForm()
    {
        return view('kullanici.kaydol'); // auth/register.blade.php olarak varsayalım
    }
    public function oturumukapat()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }
}
