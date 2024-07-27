<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

class AnasayfaController extends Controller
{
    public function index()
    {
        $kategoriler = Kategori::whereRaw('ust_id is null')->take(8)->get();



        return view('anasayfa', compact('kategoriler', ));
    }
}
