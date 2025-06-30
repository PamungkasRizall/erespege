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
        Schema::create('profession_assesor', function (Blueprint $table) {
            $table->unsignedSmallInteger('profession_id');
            $table->uuid('assesor_id');

            $table->foreign('profession_id')->references('id')->on('professions');
            $table->foreign('assesor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profession_assesor');
    }
};
