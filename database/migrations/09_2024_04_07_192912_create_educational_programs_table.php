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
        Schema::create('educational_programs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->string('inner_code');
            $table->integer('lvl_edu');
            $table->string('status');
            $table->string('lang_stud')->nullable();
            $table->text('learning_forms');
            $table->unsignedBigInteger('direction_study_id')->nullable();
            $table->foreign('direction_study_id')->references('id')->on('direction_studies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_programs');
    }
};
