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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('keranjang_id')->constrained('keranjangs')->onDelete('restrict');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('restrict');
            $table->foreignId('destination_id')->constrained('cities')->onDelete('restrict');
            $table->string('courier');
            $table->float('weight');
            $table->integer('harga_ongkir');
            $table->integer('total_belanja');
            $table->string('alamat');
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->date('transaction_time')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('snap_token', 36)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
