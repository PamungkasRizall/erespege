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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('place_of_birth', 30);
            $table->date('date_of_birth');
            $table->tinyInteger('gender')->comment('0: Laki-laki; 1: Perempuan');
            $table->string('doctoral_degree', 10)->nullable();
            $table->string('academic_degree', 20)->nullable();
            $table->string('address');
            $table->string('province', 50);
            $table->string('city', 50);
            $table->string('subdistrict', 50);
            $table->string('district', 50);
            $table->string('phone', 15)->unique();
            $table->string('phone_emergency', 15);
            $table->string('account_socmed')->nullable();

            $table->uuid('user_id')->unique();
            $table->unsignedSmallInteger('profession_id');
            $table->unsignedSmallInteger('functional_position_id');
            $table->unsignedSmallInteger('employee_status_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('profession_id')->references('id')->on('professions');
            $table->foreign('functional_position_id')->references('id')->on('functional_positions');
            $table->foreign('employee_status_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
