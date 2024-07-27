<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB ::table('kategori')->truncate();
        $id= DB::table('kategori')->insertGetId(['kategori_adi'=>'Elektronik','slug'=>'elektronik']);
        DB::table('kategori')->insert(['kategori_adi'=>'Telefon','slug'=>'telefon','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'TV ve Ses sitemleri','slug'=>'TV ve Ses sitemleri','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Kamera','slug'=>'kamera','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Bilgisayar/Tablet','slug'=>'bilgisayar/tablet','ust_id'=>$id]);

       $id= DB::table('kategori')->insertGetId(['kategori_adi'=>'kitap','slug'=>'kitap']);
        DB::table('kategori')->insert(['kategori_adi'=>'Edebiyat','slug'=>'edebiyat','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Çocuk','slug'=>'çocuk','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Sınavlara Hazırlık','slug'=>'Sınavlara Hazırlık','ust_id'=>$id]);

        DB::table('kategori')->insert(['kategori_adi'=>'dergi','slug'=>'dergi']);
        DB::table('kategori')->insert(['kategori_adi'=>'mobilya','slug'=>'mobilya']);
        DB::table('kategori')->insert(['kategori_adi'=>'dekorasyon','slug'=>'dekorasyon']);
        DB::table('kategori')->insert(['kategori_adi'=>'kozmetik','slug'=>'kozmetik']);
        DB::table('kategori')->insert(['kategori_adi'=>'kişisel bakım','slug'=>'kişisel bakım']);
        DB::table('kategori')->insert(['kategori_adi'=>'giyim ve moda','slug'=>'giyim ve moda']);
        DB::table('kategori')->insert(['kategori_adi'=>'anne ve çocuk','slug'=>'anne ve çocuk']);

    }
}
