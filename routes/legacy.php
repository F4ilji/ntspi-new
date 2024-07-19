<?php

use App\Http\Controllers\ApplicantQuestionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkToolController;
use App\Http\Controllers\MainSectionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubScheduleController;
use App\Http\Controllers\SubSectionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::post('/upload-image', [ImageController::class, 'uploadImage'])->middleware('web');
    Route::post('/upload-file', [FileUploadController::class, 'uploadFile'])->middleware('web');
Route::get('/getInfoForLink', [LinkToolController::class, 'main'])->name('backend.tool.link');


Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return Inertia::render('AdminPanel/Index');
        })->name('admin.index');

        Route::prefix('posts')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
            Route::get('/create', [PostController::class, 'create'])->name('admin.post.create');
            Route::post('/', [PostController::class, 'store'])->name('admin.post.store');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('admin.post.edit');
            Route::patch('/{post}', [PostController::class, 'update'])->name('admin.post.update');
            Route::get('/{slug}', [PostController::class, 'show'])->name('admin.post.show');
            Route::delete('/{post}', [PostController::class, 'destroy'])->name('admin.post.destroy');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::patch('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

        });

        Route::prefix('tags')->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
            Route::get('/create', [TagController::class, 'create'])->name('admin.tag.create');
            Route::post('/', [TagController::class, 'store'])->name('admin.tag.store');
            Route::get('/{category}', [TagController::class, 'show'])->name('admin.tag.show');
        });

        Route::prefix('applicants-questions')->group(function () {
            Route::get('/', [ApplicantQuestionController::class, 'index'])->name('admin.applicantQuestion.index');
            Route::get('/create', [ApplicantQuestionController::class, 'create'])->name('admin.applicantQuestion.create');
            Route::get('/{applicantQuestion}/edit', [ApplicantQuestionController::class, 'edit'])->name('admin.applicantQuestion.edit');
            Route::patch('/{applicantQuestion}', [ApplicantQuestionController::class, 'update'])->name('admin.applicantQuestion.update');
            Route::post('/', [ApplicantQuestionController::class, 'store'])->name('admin.applicantQuestion.store');
            Route::delete('/{applicantQuestion}', [ApplicantQuestionController::class, 'destroy'])->name('admin.applicantQuestion.destroy');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::get('/create/', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::patch('/{user}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        });

        Route::prefix('user-details')->group(function () {
            Route::get('/{user}/create', [UserDetailController::class, 'create'])->name('admin.userDetail.create');
            Route::post('/', [UserDetailController::class, 'store'])->name('admin.userDetail.store');
            Route::get('/{userDetail}/edit', [UserDetailController::class, 'edit'])->name('admin.userDetail.edit');
            Route::patch('/{userDetail}', [UserDetailController::class, 'update'])->name('admin.userDetail.update');
            Route::delete('/{userDetail}', [UserDetailController::class, 'destroy'])->name('admin.userDetail.destroy');
        });

        Route::prefix('pages')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('admin.page.index');
            Route::get('/registered', [PageController::class, 'getRegisteredPages'])->name('admin.registered.page.index');
            Route::get('/create', [PageController::class, 'create'])->name('admin.page.create');
            Route::post('/', [PageController::class, 'store'])->name('admin.page.store');
            Route::get('/{slug}/edit', [PageController::class, 'edit'])->name('admin.page.edit');
            Route::patch('/{page}', [PageController::class, 'update'])->name('admin.page.update');
            Route::get('registered/{id}/edit-registered-page', [PageController::class, 'editRegisteredPage'])->name('admin.registered.page.edit');
            Route::patch('registered/{id}', [PageController::class, 'updateRegisteredPage'])->name('admin.registered.page.update');
            Route::delete('/{page}', [PageController::class, 'destroy'])->name('admin.page.destroy');
        });

        Route::prefix('main-sections')->group(function () {
            Route::get('/', [MainSectionController::class, 'index'])->name('admin.mainSection.index');
            Route::get('/create', [MainSectionController::class, 'create'])->name('admin.mainSection.create');
            Route::post('/', [MainSectionController::class, 'store'])->name('admin.mainSection.store');
            Route::get('/{mainSection}/edit', [MainSectionController::class, 'edit'])->name('admin.mainSection.edit');
            Route::patch('/{mainSection}', [MainSectionController::class, 'update'])->name('admin.mainSection.update');
            Route::delete('/{mainSection}', [MainSectionController::class, 'destroy'])->name('admin.mainSection.destroy');
        });

        Route::prefix('sub-sections')->group(function () {
            Route::get('/', [SubSectionController::class, 'index'])->name('admin.subSection.index');
            Route::get('/create', [SubSectionController::class, 'create'])->name('admin.subSection.create');
            Route::post('/', [SubSectionController::class, 'store'])->name('admin.subSection.store');
            Route::get('/{subSection}/edit', [SubSectionController::class, 'edit'])->name('admin.subSection.edit');
            Route::patch('/{subSection}', [SubSectionController::class, 'update'])->name('admin.subSection.update');
            Route::delete('/{subSection}', [SubSectionController::class, 'destroy'])->name('admin.subSection.destroy');
        });

        Route::prefix('schedules')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('admin.schedule.index');
            Route::get('/create', [ScheduleController::class, 'create'])->name('admin.schedule.create');
            Route::post('/', [ScheduleController::class, 'store'])->name('admin.schedule.store');
            Route::get('/{schedule}', [ScheduleController::class, 'show'])->name('admin.schedule.show');
            Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('admin.schedule.edit');
            Route::patch('/{schedule}', [ScheduleController::class, 'update'])->name('admin.schedule.update');
            Route::delete('/{schedule}', [ScheduleController::class, 'destroy'])->name('admin.schedule.destroy');
        });

        Route::prefix('sub-schedules')->group(function () {
            Route::delete('/{subSchedule}', [SubScheduleController::class, 'destroy'])->name('admin.subSchedule.destroy');
        });

        Route::prefix('faculties')->group(function () {
            Route::get('/', [FacultyController::class, 'index'])->name('admin.faculty.index');
            Route::get('/create', [FacultyController::class, 'create'])->name('admin.faculty.create');
            Route::post('/', [FacultyController::class, 'store'])->name('admin.faculty.store');
            Route::get('/{faculty}', [FacultyController::class, 'show'])->name('admin.faculty.show');
            Route::get('/{faculty}/edit', [FacultyController::class, 'edit'])->name('admin.faculty.edit');
            Route::patch('/{faculty}', [FacultyController::class, 'update'])->name('admin.faculty.update');
            Route::delete('/{faculty}', [FacultyController::class, 'destroy'])->name('admin.faculty.destroy');
        });

        Route::prefix('departments')->group(function () {
            Route::get('/', [DepartmentController::class, 'index'])->name('admin.department.index');
            Route::get('/create', [DepartmentController::class, 'create'])->name('admin.department.create');
            Route::post('/', [DepartmentController::class, 'store'])->name('admin.department.store');
            Route::get('/{department}', [DepartmentController::class, 'show'])->name('admin.department.show');
            Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('admin.department.edit');
            Route::patch('/{department}', [DepartmentController::class, 'update'])->name('admin.department.update');
            Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('admin.department.destroy');
        });

        Route::prefix('divisions')->group(function () {
            Route::get('/', [DivisionController::class, 'index'])->name('admin.division.index');
            Route::get('/create', [DivisionController::class, 'create'])->name('admin.division.create');
            Route::post('/', [DivisionController::class, 'store'])->name('admin.division.store');
            Route::get('/{division}', [DivisionController::class, 'show'])->name('admin.division.show');
            Route::get('/{division}/edit', [DivisionController::class, 'edit'])->name('admin.division.edit');
            Route::patch('/{division}', [DivisionController::class, 'update'])->name('admin.division.update');
            Route::delete('/{division}', [DivisionController::class, 'destroy'])->name('admin.division.destroy');
        });

        Route::prefix('students')->group(function () {
            Route::get('/', [StudentController::class, 'index'])->name('admin.student.index');
            Route::get('/create', [StudentController::class, 'create'])->name('admin.student.create');
            Route::get('/{student}', [StudentController::class, 'show'])->name('admin.student.show');
            Route::post('/', [StudentController::class, 'store'])->name('admin.student.store');
            Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('admin.student.edit');
            Route::patch('/{student}', [StudentController::class, 'update'])->name('admin.student.update');
            Route::delete('/{student}', [StudentController::class, 'destroy'])->name('admin.student.destroy');
        });

        Route::prefix('events')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('admin.event.index');
            Route::get('/create', [EventController::class, 'create'])->name('admin.event.create');
            Route::get('/{event}', [EventController::class, 'show'])->name('admin.event.show');
            Route::post('/', [EventController::class, 'store'])->name('admin.event.store');
            Route::get('/{event}/edit', [EventController::class, 'edit'])->name('admin.event.edit');
            Route::patch('/{event}', [EventController::class, 'update'])->name('admin.event.update');
            Route::delete('/{event}', [EventController::class, 'destroy'])->name('admin.event.destroy');
        });


    });
