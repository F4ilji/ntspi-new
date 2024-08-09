<?php

use App\Models\AcademicJournal;
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
        Schema::create('journal_issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('path_file');
            $table->integer('year_publication');
            $table->boolean('is_active');
            $table->boolean('sort')->nullable();
            $table->unsignedBigInteger('academic_journal_id');
            $table->foreign('academic_journal_id')->references('id')->on('academic_journals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_issues');
    }
};
