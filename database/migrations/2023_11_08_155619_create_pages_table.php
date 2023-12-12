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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('slug')->nullable();
            $table->string('path');
            $table->boolean('is_registered')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->integer('code')->default(200);
            $table->unsignedBigInteger('sub_section_id')->nullable();
            $table->foreign('sub_section_id')->references('id')->on('sub_sections');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
