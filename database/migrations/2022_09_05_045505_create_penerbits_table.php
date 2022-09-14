<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbits', function (Blueprint $table) {
            $table->id();
            $table->string('kode_terbit');
            $table->string('nama_penerbit');
            $table->string('slug')->unique();
            $table->integer('tahun_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penerbits');
    }
};
