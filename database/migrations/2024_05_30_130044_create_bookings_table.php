<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('id_keranjang')->constrained('keranjangs')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('status_submission')->default('Pending');
            $table->string('status_payment')->default('Unpaid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};