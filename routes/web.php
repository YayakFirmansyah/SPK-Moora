<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\InputExcel;
use App\Http\Controllers\KriteriabobotController;
use App\Http\Controllers\NormalisasiController;
use App\Models\AlternatifModel;
use App\Models\KriteriaBobotModel;
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

]);

//make middleware that checking bobot of criteria model for normalization and ranking route
Route::middleware(['checkBobot'])->group(function () {
    Route::get('decisionmatrix', [DecisionMatrixController::class, 'index']);
    Route::get('normalization', [NormalisasiController::class, 'index']);
    Route::get('/ranking', [NormalisasiController::class, 'showRanking']);
});

// Route::get('normalization', [NormalisasiController::class, 'index']);
// Route::get('/ranking', [NormalisasiController::class, 'showRanking']);

Route::post('/uploadExcelKriteria', [InputExcel::class, 'uploadExcelKriteria']);
Route::get('/downloadExcelTemplateKriteria', [InputExcel::class, 'downloadExcelTemplateKriteria']);

Route::get('/downloadExcelTemplateAlternatif', [InputExcel::class, 'downloadExcelTemplateAlternatif']);
Route::post('/uploadExcelAlternatif', [InputExcel::class, 'uploadExcelAlternatif']);
Route::post('/resetData', function () {
    AlternatifModel::query()->delete();
    KriteriaBobotModel::query()->delete();
    return redirect('/')->with('success', 'Semua data berhasil dihapus');
});
