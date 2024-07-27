@extends('yonetim.layouts.master')
@section('title','Kullanici Yönetimi')
@section('content')
    <h1 class="page-header">Kullanıcı Yönetimi</h1>

    <form method="post" action="{{ route('yonetim.kullanici.kaydet',$entry->id) }}">
        {{ csrf_field() }}
        <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{ @$entry->id > 0 ? "Güncelle" : "Kaydet" }}
        </button>
        </div>
        <h2 class="sub-header">Kullanıcı {{ @$entry->id > 0 ? "Düzenle" : "Ekle" }}</h2>
       @include('layouts.partials.alert')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputAdsoyad1">Ad Soyad</label>
                    <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad Soyad" value="{{ $entry->adsoyad }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email" value="{{ $entry->email}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputPassword1">Şifre</label>
                    <input type="password" class="form-control" id="exampleInputPassword1"  name="sifre" placeholder="Şifre">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Adres</label><!--optional null da olsa çalıştır demek --!>
                    <input type="text" class="form-control" id="exampleInputaddress1" placeholder="Adres"  name="adres" value="{{ optional($entry->detay)->adres }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Telefon</label>
                    <input type="text" class="form-control" id="telefon" placeholder="Telefon" name="telefon" value="{{ optional($entry->detay)->telefon }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Cep Telefonu</label>
                    <input type="text" class="form-control" id="cep_telefonu" placeholder="Cep Telefonu" name="cep_telefonu" value="{{ optional($entry->detay)->cep_telefonu}}">
                </div>
            </div>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="aktif_mi" value="1" {{ $entry->aktif_mi ?'checked':'' }}> Aktif mi
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="yonetici_mi" value="1" value="1" {{ $entry->yonetici_mi ?'checked':'' }}> Yönetici mi
            </label>
        </div>

    </form>
@endsection
