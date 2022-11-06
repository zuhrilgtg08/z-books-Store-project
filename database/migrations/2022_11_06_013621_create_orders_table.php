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
            // $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            // $table->foreignId('province_id')->constrained('provinces')->onDelete('restrict');
            // $table->foreignId('city_id')->constrained('cities')->onDelete('restrict');
            // $table->foreignId('destination_id')->constrained('cities')->onDelete('restrict');
            // $table->string('courier');
            // $table->integer('quantity');
            // $table->float('weight');
            // $table->integer('cost_services');
            // $table->integer('total_belanja');
            $table->integer('total_price');
            $table->enum('payment_status', ['1', '2', '3', '4'])->comment('1=menunggu pembayaran, 2=sudah dibayar, 3=kadaluarsa, 4=batal');
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
