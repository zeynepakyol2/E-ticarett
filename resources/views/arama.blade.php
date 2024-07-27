@extends('layouts.master')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('anasayfa') }}">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
        </ol>
    <div class="products bg-content">
        <div class="row">
            @foreach($urunler as $urun)
                <div class="col-md- product">
                    <a href="{{ route('urun',$urun->slug) }}">
                        <img src="http://lorempixel.com/640/400/food/1"  alt="{{ $urun->urun_adi }}">
                    </a>

                    <p>
                        <a href="{{ route('urun', $urun->slug) }}">
                            {{ $urun->urun_adi }}
                        </a>
                    </p>
                    <p class="price"> {{ $urun->fiyat }}</p>
                </div>

            @endforeach
        </div>
    </div>
    </div>
@endsection
