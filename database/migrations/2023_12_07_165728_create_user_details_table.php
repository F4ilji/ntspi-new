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
            $table->boolean('is_only_worker');
            $table->string('photo')->nullable(); // Фото
            $table->string('academicTitle')->nullable(); // Ученая степень
            $table->string('AcademicDegree')->nullable(); // Ученое звание
            $table->string('education')->nullable(); // Образование
            $table->text('awards')->nullable(); // Награды
            $table->text('professDisciplines')->nullable(); // Преподаваемые программы
            $table->text('professionalRetraining')->nullable(); // Профессиональная переподготовка
            $table->text('professionalDevelopment')->nullable(); // Повышение квалификации
            $table->integer('workExperience')->nullable(); // Стаж работы
            $table->text('attendedConferences')->nullable(); // Участие в конференциях
            $table->text('participationScienceProjects')->nullable(); // Участие в научных проектах
            $table->text('publications')->nullable(); // Публикации
            $table->string('contactEmail')->nullable();
            $table->string('contactPhone')->nullable();
            $table->text('other')->nullable();
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
