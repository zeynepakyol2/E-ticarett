<?php

namespace App\Http\Controllers;

use App\Models\Urun;

class UrunController extends Controller
{
    public function index($slug_urunadi)
    {
        $urun = Urun::where('slug', $slug_urunadi)->firstOrFail();
        $kategoriler = $urun->kategoriler()->distinct()->get();
        return view('urun', compact('urun'));
    }

    public function ara()
    {

        $aranan = request()->input('aranan');
        $urunler = Urun::where('urun_adi', 'like', "%$aranan%")
            //->orWhere('urun_aciklama','like',"%$aranan%")
            ->paginate(2);

        return view('arama', compact('urunler'));
    }
}
