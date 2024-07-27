<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sepet extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sepet';
    protected $guarded = [];
    const CREATED_AT = 'oluşturulma_tarihi';
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
    public function siparis(){
        return $this->hasOne('App\Models\Siparis');
    }
}
