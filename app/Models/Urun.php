<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'urun';
    const CREATED_AT = 'oluşturulma_tarihi';
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
    protected $guarded=[];
    public function kategoriler()
    {
        return $this->belongsTo('App\Models\Kategori','kategori_urun');
    }
    public function detay(){
        return $this->hasOne('App\Models\UrunDetay');
    }
}
