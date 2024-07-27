<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kullanici extends Authenticatable
{
    use HasFactory;
    protected $fillable=[
        'adsoyad','email','sifre','aktivasyon_anahtari','aktif_mi',

    ];
    protected $table = 'kullanici';
    use softDeletes;
    protected $hidden = ['sifre','aktivasyon_anahtari'];
    const CREATED_AT = 'oluşturulma_tarihi';
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
    public function getAuthPassword()
    {
        return $this->sifre;
    }
    public function detay(){
        return $this->hasOne('App\Models\KullaniciDetay');
    }
}
