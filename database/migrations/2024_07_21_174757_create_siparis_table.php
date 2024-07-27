<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siparis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sepet_id')->unsigned()->unique();
            $table->string('durum')->nullable();
            $table->string('adsoyad',50)->nullable();
            $table->string('adres',200)->nullable();
            $table->string('telefon',15)->nullable();
            $table->string('ceptelefonu',15)->nullable();


            $table->decimal('sipariş_tutari',0,4);
          $table->string('banka',20)->nullable();
            $table->integer('taksit_sayisi')->nullable();
            $table->timestamp('oluşturulma_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('güncelleme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('silinme_tarihi')->nullable();
            $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siparis');
    }
};
