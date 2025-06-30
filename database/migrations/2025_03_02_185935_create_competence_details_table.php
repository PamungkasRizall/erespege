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
        Schema::create('competence_details', function (Blueprint $table) {
            $table->id();
            $table->string('full_code', '25');
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('type')->comment('0: group; 1: unit; 2: element');
            $table->smallInteger('serial_number')->nullable();
            $table->uuid('competence_id');

            $table->foreign('competence_id')->references(columns: 'id')->on('competences');
            $table->unique(['full_code', 'competence_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_details');
    }
};
