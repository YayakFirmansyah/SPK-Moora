<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\InputExcel;
use App\Http\Controllers\KriteriabobotController;
use App\Http\Controllers\NormalisasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resources([
    'alternatif' => AlternatifController::class,
    'kriteriabobot' => KriteriabobotController::class,
    'decisionmatrix' => DecisionMatrixController::class,

]);
Route::get('normalization', [NormalisasiController::class, 'index']);
Route::get('/ranking', [NormalisasiController::class, 'showRanking']);

Route::post('/uploadExcelKriteria', [InputExcel::class, 'uploadExcelKriteria']);
Route::get('/downloadExcelTemplateKriteria', [InputExcel::class, 'downloadExcelTemplateKriteria']);
