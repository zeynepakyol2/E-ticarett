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
        Schema::create('urun_detay', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('urun_id')->unsigned()->unique();
            $table->foreign('urun_id')->references('id')->on('urun')->onDelete('cascade');
            $table->boolean('goster_slider')->default(0);
            $table->boolean('goster_gunun_firsati')->default(0);
            $table->boolean('goster_one_cikan')->default(0);
            $table->boolean('goster_cok_satan')->default(0);
            $table->boolean('goster_indirimli')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urun_detay');
    }
};
