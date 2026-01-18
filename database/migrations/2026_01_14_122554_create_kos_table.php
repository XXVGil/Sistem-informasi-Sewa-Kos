<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained()->cascadeOnDelete();

            $table->string('nama_kos');
            $table->string('kota');
            $table->string('daerah');
            $table->string('kelas_kos');
            $table->text('alamat');

            $table->integer('harga_perbulan');
            $table->enum('jenis_kos', ['putra','putri','campur']);
            $table->text('fasilitas');
            $table->text('deskripsi')->nullable();

            $table->enum('status', ['tersedia','disewa','perbaikan'])
                  ->default('tersedia');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
