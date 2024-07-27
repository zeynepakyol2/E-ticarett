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
        Schema::create('urun', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug',160);
            $table->string('urun_adi',160);
            $table->text('urun_aciklama');
            $table->decimal('fiyat',6,3);
            $table->timestamp('oluşturulma_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('güncelleme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            // $table->softDeletes();
            $table->timestamp('silinme_tarihi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urun');
    }
};
