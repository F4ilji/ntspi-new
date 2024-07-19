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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('days');
            $table->string('type');
            $table->boolean('is_zaoch');
            $table->unsignedBigInteger('educational_group_id');
            $table->foreign('educational_group_id')->references('id')->on('educational_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
        });
        Schema::dropIfExists('schedules');
    }
};
