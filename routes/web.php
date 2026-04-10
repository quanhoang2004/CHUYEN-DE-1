<?php
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('courses', CourseController::class);
Route::resource('lessons', LessonController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::get('courses/{id}/restore', [CourseController::class, 'restore'])
    ->name('courses.restore');