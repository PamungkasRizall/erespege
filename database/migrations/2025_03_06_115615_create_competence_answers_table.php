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
        Schema::create('competence_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competence_detail_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('choice_id')->constrained()->onDelete('cascade');
            $table->uuid('filing_id');
            $table->timestamps();

            $table->uuid('assesor_id')->nullable();
            $table->unsignedBigInteger('ass_choice_id')->nullable();
            $table->float('ass_score')->nullable();
            $table->string('ass_notes')->nullable();

            $table->foreign('filing_id')->references('id')->on('filings');
            $table->foreign('assesor_id')->references('id')->on('users');
            $table->foreign('ass_choice_id')->references('id')->on('choices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_answers');
    }
};
