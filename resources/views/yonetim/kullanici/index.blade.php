@extends('yonetim.layouts.master')
@section('title','Kullanici Yönetimi')
@section('content')
    <h1 class="page-header">Kullanıcı Yönetimi</h1>
    <h1 class="sub-header">
        <div class="btn-group pull-right" >
            <a href="{{ route('yonetim.kullanici.yeni') }}" class=" btn btn-primary">Yeni</a>
        </div>
        Kullanıcı Listesi
    </h1>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Ad Soyad</th>
                <th>Email</th>
                <th>Aktif mi</th>
                <th>Yönetici mi</th>
                <th>Kayıt Tarihi</th>
            </tr>
            </thead>
            <tbody>
            <!-- yonetimcontrollerdan aldığımız list değişkenini kullanacağız --!>
            @foreach( $list as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                <td>{{ $entry->adsoyad}}</td>
                <td>{{ $entry->email }}</td>
                <td>
                    @if($entry->aktif_mi)
                        <span class="label label-success">Aktif</span>
                    @else
                        <span class="label label-warning">Pasif</span>
                    @endif
                </td>
                <td>
                    @if($entry->yonetici_mi)
                        <span class="label label-success">Yönetici</span>
                    @else
                        <span class="label label-warning">Müşteri</span>
                    @endif
                </td>
                <td>{{ $entry->oluşturulma_tarihi }}</td>
                <td style="width: 100px">
                    <a href="{{ route('yonetim.kullanici.duzenle',$entry->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
