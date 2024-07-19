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
        Schema::create('program_exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type');
            $table->boolean('is_creative_direction');
            $table->boolean('is_profile_direction');
            $table->integer('priority');
            $table->integer('min_ball');
            $table->integer('max_ball');
            $table->string('form_exam')->nullable();
            $table->string('language')->nullable();
            $table->unsignedBigInteger('educational_program_id')->nullable();
            $table->foreign('educational_program_id')->references('id')->on('educational_programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_exams');
    }
};
