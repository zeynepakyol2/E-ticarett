<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Urun as UrunModel;

class SepetUrun extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'sepet_urun';
    protected $guarded = [];
    const CREATED_AT = 'oluşturulma_tarihi';
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
    public function urun(){
        return $this->belongsTo(UrunModel::class, 'urun_id'); // 'urun_id' yerine kendi foreign key'inizi belirtin
    }

}
