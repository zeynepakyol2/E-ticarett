<?php
namespace Database\Seeders;
use App\Models\Urun;
use App\Models\UrunDetay;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
     Urun::truncate();
     UrunDetay::truncate();
     $faker=Faker::create();
     for($i=0;$i<=30;$i++){
         $urun_adi=$faker->sentence(2);
         $urun=Urun::create([
                'urun_adi'=>$faker->word(),
                'slug'=>Str::slug($urun_adi),
                'urun_aciklama'=>$faker->paragraph(),
                'fiyat'=>$faker->randomFloat(2,0,100)

            ]);
        $detay=$urun->detay()->create([
            'goster_slider'=>rand(0,1),
            'goster_gunun_firsati'=>rand(0,1),
            'goster_one_cikan'=>rand(0,1),
            'goster_cok_satan'=>rand(0,1),
            'goster_indirimli'=>rand(0,1)


        ]);
     }
     DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
