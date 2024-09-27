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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengguna');
            $table->date('date_izin');
            $table->string('status');
            $table->string('keterangan');
            $table->string('status_approved');
            $table->string('file');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};