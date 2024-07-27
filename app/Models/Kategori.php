<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;
    use softDeletes;


    protected $table = 'kategori';
   // protected $fillable=['kategori_adi','slug'];
    protected $guarded=[];
    //fillable eklenebilir kolon için kullanılır guarded ise ekleme yapılamayacak kolonlar için kullanılır
    const CREATED_AT = 'oluşturulma_tarihi';
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function urunler()
    {
        return $this->belongsToMany(Urun::class,'kategori_urun', 'kategori_id', 'urun_id');
    }


}
