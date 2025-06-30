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
        Schema::create('competence_bas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date_at');
            $table->string('location');
            $table->json('filings');
            $table->string('code', 30)->unique();
            $table->string('committee', 20);
            $table->integer('number');
            $table->unsignedSmallInteger('profession_id');
            $table->uuid('assesor_id');
            $table->uuid('sub_committee_id')->nullable();
            $table->timestamps();

            $table->foreign('profession_id')->references('id')->on('professions');
            $table->foreign('assesor_id')->references('id')->on('users');
            $table->foreign('sub_committee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_bas');
    }
};
