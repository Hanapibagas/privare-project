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
        Schema::create('details_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('order_date');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('transaksi_id')->constrained('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_barang')->nullable();
            $table->integer('selling_price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('purchase_price')->nullable();
            $table->integer('profit')->nullable();
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
        Schema::dropIfExists('details_transaksis');
    }
};
