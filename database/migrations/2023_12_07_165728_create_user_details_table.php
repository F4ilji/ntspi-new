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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->string('middleName')->nullable();
            $table->string('photo')->nullable();
            $table->string('academicTitle')->nullable();
            $table->string('administrativePosition')->nullable();
            $table->string('educatorPosition')->nullable();
            $table->string('education')->nullable();
            $table->text('awards')->nullable();
            $table->text('professDisciplines')->nullable();
            $table->text('professionalRetraining')->nullable();
            $table->text('professionalDevelopment')->nullable();
            $table->integer('workExperience')->nullable();
            $table->text('attendedConferences')->nullable();
            $table->text('participationScienceProjects')->nullable();
            $table->text('publications')->nullable();
            $table->text('trainingAids')->nullable();
            $table->string('contactEmail')->nullable();
            $table->string('contactPhone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
