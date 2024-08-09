<?php

use App\Http\Controllers\ClientAcademicJournalController;
use App\Http\Controllers\ClientAdditionalEducationController;
use App\Http\Controllers\ClientDepartmentController;
use App\Http\Controllers\ClientDivisionController;
use App\Http\Controllers\ClientEventController;
use App\Http\Controllers\ClientExternalVacancyController;
use App\Http\Controllers\ClientFacultyController;
use App\Http\Controllers\ClientLibraryNewsController;
use App\Http\Controllers\ClientPostController;
use App\Http\Controllers\ClientProgramController;
use App\Http\Controllers\ClientScheduleController;
use App\Http\Controllers\ClientVacantPositionController;
use App\Http\Controllers\ClientVirtualExhibitionController;
use App\Http\Controllers\EducationalProgramController;
use App\Http\Controllers\LinkToolController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UpdateEduDataApiController;
use App\Http\Controllers\UpdateViconDataApi;
use Illuminate\Support\Facades\Route;


Route::middleware('access-check')->group(function () {
});
    // Главная страница
    Route::get('/', [MainController::class, 'index'])->name('index');

    // Расписание занятий
    Route::get('/schedule', [ClientScheduleController::class, 'index'])->name('client.schedule');
    Route::get('/schedule/{id}', [ClientScheduleController::class, 'show'])->name('client.schedule.show');

    Route::get('/persons/{id}', [PersonController::class, 'show'])->name('client.person.show');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('client.student.show')->middleware('auth');

    // Новости
    Route::get('/news', [ClientPostController::class, 'index'])->name('client.post.index');
    Route::get('/news/{slug}', [ClientPostController::class, 'show'])->name('client.post.show');

    // Образовательные программы
//    Route::get('/programs/{slug}', [ClientProgramController::class, 'index'])->name('client.program.index');
    Route::get('/program/{educationalProgram}', [ClientProgramController::class, 'show'])->name('client.program.show');

    Route::get('/programs/bakalavriat/', [ClientProgramController::class, 'bakalavriat'])->name('client.program.bakalavriat');
    Route::get('/programs/spo/', [ClientProgramController::class, 'spo'])->name('client.program.spo');
    Route::get('/programs/magistratura/', [ClientProgramController::class, 'magistratura'])->name('client.program.magistratura');


    // Образовательные программы
    Route::get('/additional-education/', [ClientAdditionalEducationController::class, 'index'])->name('client.additionalEducation.index');
    Route::get('/additional-education/{slug}', [ClientAdditionalEducationController::class, 'show'])->name('client.additionalEducation.show');

    // События
    Route::get('/events', [ClientEventController::class, 'index'])->name('client.event.index');
    Route::get('/events/{id}', [ClientEventController::class, 'show'])->name('client.event.show');

    // Заметки библиотеки
    Route::get('/library/news', [ClientLibraryNewsController::class, 'index'])->name('client.library.news.index');
    Route::get('/library/news/{id}', [ClientLibraryNewsController::class, 'show'])->name('client.library.news.show');

    // Виртуальные выставки библиотеки
    Route::get('/library/exhibition', [ClientVirtualExhibitionController::class, 'index'])->name('client.library.exhibition.index');
    Route::get('/library/exhibition/{id}', [ClientVirtualExhibitionController::class, 'show'])->name('client.library.exhibition.show');

    // Вакансии вуза
    Route::get('/vacant/', [ClientVacantPositionController::class, 'index'])->name('client.vacant.index');

    // Вакансии других учереждений
    Route::get('/current-vacancies/', [ClientExternalVacancyController::class, 'index'])->name('client.external.vacant.index');
    Route::get('/current-vacancies/{id}', [ClientExternalVacancyController::class, 'show'])->name('client.external.vacant.show');

    Route::get('/academic-journals/', [ClientAcademicJournalController::class, 'index'])->name('client.academicJournals.index');
    Route::get('/academic-journals/{slug}', [ClientAcademicJournalController::class, 'show'])->name('client.academicJournals.show');

    // Факультеты и кафедры
    Route::get('/faculties', [ClientFacultyController::class, 'index'])->name('client.faculty.index');
    Route::get('/faculties/{slug}', [ClientFacultyController::class, 'show'])->name('client.faculty.show');
    Route::get('/faculties/{facultySlug}/{departmentSlug}', [ClientDepartmentController::class, 'show'])->name('client.department.show');

    // Подразделения института
    Route::get('/divisions', [ClientDivisionController::class, 'index'])->name('client.division.index');
    Route::get('/divisions/{slug}', [ClientDivisionController::class, 'show'])->name('client.division.show');


    Route::get('/get-data', [UpdateEduDataApiController::class, 'index']);

    Route::get('{path}', [PageController::class, 'render'])->where('path', '[0-9,a-z,/,-]+')->name('page.view');



