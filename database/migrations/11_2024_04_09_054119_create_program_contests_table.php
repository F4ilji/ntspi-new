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
        Schema::create('program_contests', function (Blueprint $table) {
            $table->id();
            $table->string('inner_code');
            $table->string('form_obuch');
            $table->string('source');
            $table->string('level_budget');
            $table->string('is_show_in_competition_list');
            $table->string('is_additional');
            $table->string('for_foreign_citizens');
            $table->integer('count_places');
            $table->date('start_date_of_dispatch_zajavl')->nullable();
            $table->date('end_date_of_dispatch_zajavl')->nullable();
            $table->date('start_date_of_dispatch_consent')->nullable();
            $table->date('end_date_of_dispatch_consent')->nullable();
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
        Schema::dropIfExists('program_contests');
    }
};
