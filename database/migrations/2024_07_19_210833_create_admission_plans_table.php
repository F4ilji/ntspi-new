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
        Schema::create('admission_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('educational_programs_id')->nullable();
            $table->foreign('educational_programs_id')->references('id')->on('educational_programs');
            $table->unsignedBigInteger('admission_campaigns_id')->nullable();
            $table->foreign('admission_campaigns_id')->references('id')->on('admission_campaigns');
            $table->text('exams');
            $table->text('contests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_plans');
    }
};
