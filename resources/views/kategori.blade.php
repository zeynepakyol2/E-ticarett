@extends('layouts.master')
@section('title','Kategori')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('anasayfa') }}">Anasayfa</a></li>

            <li class="active">{{ $kategori->kategori_adi }}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $kategori->kategori_adi }}</div>
                    <div class="panel-body">
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($alt_kategoriler as $alt_kategori)
                                <a href="{{ route ('kategori',$alt_kategori->slug)}}" class="list-group-item"><i
                                        class="fa fa-television"></i> {{$alt_kategori->kategori_adi }}</a>
                            @endforeach
                        </div>
                        <h3>Fiyat Aralığı</h3>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 100-200
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 200-300
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    Sırala
                    <a href="#" class="btn btn-default">Çok Satanlar</a>
                    <a href="#" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    <div class="row">
                        @foreach( $kategori->urunler as $urun)
                            <div class="col-md-3 product">
                                <a href="{{ route('urun',$urun->slug) }}"><img
                                        src="http://lorempixel.com/400/400/food/1"></a>
                                <p><a href="{{ route('urun',$urun->slug) }}">{{ $urun->urun_adi }}</a></p>
                                <p class="price"> {{ $urun->fiyat }} </p>
                                <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                            </div>
                        @endforeach

                        @forelse($kategori->urunler as $urun)
                            <div class="col-md-3 product">
                                <a href="{{ route('urun',$urun->slug) }}"><img
                                        src="http://lorempixel.com/400/400/food/1"></a>
                                <p><a href="{{ route('urun',$urun->slug) }}">{{ $urun->urun_adi }}</a></p>
                                <p class="price"> {{ $urun->fiyat }} </p>
                                <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                            </div>
                        @empty
                            <p style="text-align: center;">Herhangi bir ürün bulunamadı</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
