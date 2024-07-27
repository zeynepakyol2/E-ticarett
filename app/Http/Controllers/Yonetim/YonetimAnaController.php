<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YonetimAnaController extends Controller
{
    public function index(){
        return view('yonetim.anasayfa');
    }
}
