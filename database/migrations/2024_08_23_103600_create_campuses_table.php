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
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(); // Name of the campus, nullable
            $table->string('alamat')->nullable(); // Address of the campus, nullable
            $table->string('kota')->nullable(); // City of the campus, nullable
            $table->string('provinsi')->nullable(); // Province of the campus, nullable
            $table->string('kode_pos')->nullable(); // Postal code of the campus, nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campuses');
    }
};
