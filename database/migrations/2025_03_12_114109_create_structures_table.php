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
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_unique')->default(false);
            $table->foreignId('parent_id')->nullable()->constrained('structures')->onDelete('cascade');
            $table->unsignedSmallInteger('department_id')->nullable();
            $table->tinyInteger('is_main')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
