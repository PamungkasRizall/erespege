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
        Schema::create('approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('approvalable');
            $table->tinyInteger('status_id')->default(0)->comment('0: Reject; 1: Done');
            $table->string('notes')->nullable();
            $table->timestamp('created_at');
            $table->uuid('created_by');

            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
