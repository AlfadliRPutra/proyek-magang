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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();

            $table->string('pengirim_id');

            $table->string('nama');
            $table->string('jenis');
            $table->string('file');
            $table->string('status');
            $table->string('hasil_file')->nullable();

            $table->timestamps();


            $table->foreign('pengirim_id')->references('id_pengguna')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
