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
        Schema::create('kullanici_detay', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('kullanici_id')->unsigned();
                $table->string('adres',200)->nullable();
                $table->string('telefon',15)->nullable();
                $table->string('cep_telefonu',20)->nullable();
                $table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');


            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kullanici_detay');
    }
};
