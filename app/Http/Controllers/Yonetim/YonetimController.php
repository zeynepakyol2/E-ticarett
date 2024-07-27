<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Kullanici;
use App\Models\KullaniciDetay;
use Illuminate\Http\Request;
use Auth;
use Hash;
class YonetimController extends Controller
{
    public function oturumac()
    {
        //request http isteğinin bilgilerini kontrol eder
        if(request()->isMethod("post")) {
            //validation doğrulama alanıdır
            $this->validate(request(), [
                'email' => 'required|email',
                'sifre' => 'required|min:6',
                //email alanı zorunlu ve email tipinde olmalı şifre alanı zorunlu ve en az 6 karakterlidir

            ]);
            $credentials=[
                'email' => request("email"),
                'password' => request("sifre"),
                'yonetici_mi'=>1
            ];
            if (Auth::guard("yonetim")->attempt($credentials,request()->has('benihatirla'))){
                return redirect()->route("yonetim.anasayfa");
            }
            else{
                return back()->withErrors(['email'=>'Giriş Hatalı']);            }
        }
        return view('yonetim.oturumac');
    }
    public function oturumukapat()
    {
        Auth::guard("yonetim")->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('yonetim.oturumac');
    }
    public function index()
        //orderbydesc ile oluşturulma tarihi sütünündan en yeni olandan en az olana doğru sıralama yaparak çeker
        //index sayfasında list değişkeni her sayfada 8 veri olacak şekilde listelenir
    {
        $list = Kullanici::orderByDesc('oluşturulma_tarihi')->paginate(8);
        return view('yonetim.kullanici.index', compact('list'));
    }

    public function form($id=0)
    {
        $entry=new Kullanici();
        if ($id>0)
        {
         $entry=Kullanici::find($id);
        }
        return view('yonetim.kullanici.form', compact('entry'));
    }
    public function kaydet($id=0)
    {
        $this->validate(request(),[
           'adsoyad' => 'required',
            'email' => 'required|email'
       ]);
        $data=request()->only('adsoyad','email');
//eğer şifre alanı doldurulmuşşsa data içine şifreyi de ekler ve günceller
        if(request()->filled('sifre'))
        {
            $data['sifre']=Hash::make(request('sifre'));
        }
        //has seçilmiş mi anlamında kullanılır
        if (request()->has('aktif_mi'))
            $data['aktif_mi']=1;
        else
            $data['aktif_mi']=0;
        if (request()->has('yonetici_mi'))
            $data['yonetici_mi']=1;
        else
            $data['yonetici_mi']=0;

        if($id >0)
        {
            $entry =Kullanici::where('id',$id)->firstOrFail();
            $entry->update($data);
        }else{
        $entry=Kullanici::create($data);
        }
        KullaniciDetay::updateOrCreate(
          ["kullanici_id"=>$entry->id],
          [
              'adres'=>request('adres'),
              'telefon'=>request('telefon'),
              'cep_telefonu'=>request('cep_telefonu')

          ]
        );
        return redirect()
           ->route('yonetim.kullanici.duzenle',$entry->id)
            ->with('mesaj',($id> 0 ? 'Güncellendi':'Kaydedildi'))
            ->with('mesaj_tur','success');
    }
}

