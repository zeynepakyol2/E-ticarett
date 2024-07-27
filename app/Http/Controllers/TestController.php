<?php

namespace App\Http\Controllers;

use App\Models\Kullanici;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index(Request $request)
    {
//        $kategori = Kategori::find(9);

//        $kategori = Kategori::create([
//            'ust_id' => 2,
//            'kategori_adi' => 'Yeni Kategori Adı',
//            'slug' => Str::slug('Yeni Kategori Adı'),
//
//        ]);

//        return $kategori;



        return Str::slug($kategori->slug);
        return $kategori->slug;
    }
}
