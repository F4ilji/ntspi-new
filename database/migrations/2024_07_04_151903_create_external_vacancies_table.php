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
        Schema::create('external_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('position');
            $table->integer('salary')->nullable();
            $table->string('conditions')->nullable();
            $table->string('contacts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_vacancies');
    }
};
