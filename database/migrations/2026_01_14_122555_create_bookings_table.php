<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kos_id')->constrained()->cascadeOnDelete();

            $table->integer('lama_sewa');
            $table->enum('metode_pembayaran', ['tunai','e_wallet','transfer_bank']);
            $table->string('bukti_pembayaran')->nullable();

            $table->enum('status', ['pending','diterima','ditolak'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
