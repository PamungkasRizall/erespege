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
        Schema::create('filings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('letter_no', 50);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->tinyInteger('is_end')->default(0);
            $table->unsignedSmallInteger('category_id');
            $table->uuid('competence_id')->nullable()->after('user_id');
            $table->tinyInteger('status')->default(1)->comment('0: pending; 1: review; 2:done;');
            $table->tinyInteger('origin')->default(0)->comment('0: manual; 1: system');
            $table->timestamps();
            $table->timestamp('end_at')->nullable();
            $table->string('recomendation_code', 20)->nullable();
            $table->date('recomendation_at')->nullable();
            $table->date('cp_at')->nullable();
            $table->dateTime('cp_created_at')->nullable();
            $table->string('str_code', 50)->nullable();
            $table->string('sik_code', 50)->nullable();

            $table->unique(['letter_no', 'category_id']);
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('competence_id')->references('id')->on('competences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filings');
    }
};
