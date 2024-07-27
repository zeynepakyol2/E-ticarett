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
        Schema::create('sepet_urun', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sepet_id');
            $table->unsignedInteger('urun_id');
            $table->integer('adet');
            $table->decimal('fiyat',5,2);
            $table->string('durum',30);
            $table->timestamp('oluşturulma_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('güncelleme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('silinme_tarihi')->nullable();
            $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete('cascade');
            $table->foreign('urun_id')->references('id')->on('urun')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepet_urun');
    }
};
