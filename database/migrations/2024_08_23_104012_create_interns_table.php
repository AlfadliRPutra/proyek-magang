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
        Schema::create('interns', function (Blueprint $table) {
            $table->id();

            $table->string('id_pengguna');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('no_phone')->nullable();
            $table->unsignedBigInteger('campus_id')->nullable();
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('users')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('unit_listings')->onDelete('set null');
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
