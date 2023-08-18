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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('kode_pemesanan')->nullable();

            $table->integer('discount')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('grand_total')->nullable();;

            $table->string('foto')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telpn')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('transactions');
    }
};
