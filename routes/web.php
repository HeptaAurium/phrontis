<?php

use App\Http\Controllers\BranchesController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\ExamTypesController;
use App\Http\Controllers\FormClassController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\StreamsController;
use App\Http\Controllers\StudentsController;
use App\Models\FormClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/classes', FormClassController::class);
    Route::resource('/streams', StreamsController::class);
    Route::resource('/students', StudentsController::class);
    Route::resource('/exam-types', ExamTypesController::class);
    Route::resource('/exams', ExamsController::class)->except(['index', 'show']);
    Route::resource('/branches', BranchesController::class);
    Route::get('/examination/results/{student}', [ExamsController::class, 'show']);
    Route::post('/exams/get-exam-list', [ExamsController::class, 'get_exam_list']);
    Route::get('/examination/results', [ExamsController::class, 'index'])->name('results');
    Route::get('/examination/reports', [ExamsController::class, 'reports'])->name('reports');
    Route::post('/examination/generate', [ExamsController::class, 'generate_batch']);
    Route::post('/examinations/reports/student', [PdfController::class, 'student_report']);
});
