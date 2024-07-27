<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'siparis';
    protected $fillable = ['sepet_id','sipariş_tutari','adsoyad','adres','telefon','cep_telefonu','banka','taksit_sayisi','durum'];
    const CREATED_AT = 'oluşturulma_tarihi';
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function sepet(){
        return $this->belongsTo('App\Models\Sepet');
    }
}
