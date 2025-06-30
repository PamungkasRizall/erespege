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
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('sequence');
            $table->boolean('is_correct')->default(false);
            $table->float('score')->default(0);
            $table->uuid('competence_id');

            $table->foreign('competence_id')->references('id')->on('competences');
            $table->unique(['name', 'competence_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
