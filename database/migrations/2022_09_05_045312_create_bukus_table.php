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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku');
            $table->string('judul_buku');
            $table->integer('harga');
            $table->integer('stok');
            $table->foreignId('category_id');
            $table->foreignId('author_id');
            $table->foreignId('penerbit_id');
            $table->string('image')->nullable();
            $table->text('sinopsis');
            $table->text('excerpt');
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
        Schema::dropIfExists('bukus');
    }
};
