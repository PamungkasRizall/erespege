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
        Schema::create('user_structure', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreignId('structure_id')->constrained('structures')->onDelete('cascade');
            $table->date('start_date')->nullable(); // Tanggal mulai jabatan
            $table->date('end_date')->nullable();   // Tanggal berakhir jabatan (null jika masih menjabat)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_structure');
    }
};
