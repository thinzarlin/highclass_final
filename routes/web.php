<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CarStaffController;
use App\Http\Controllers\CbRecordController;
use App\Http\Controllers\DailyCarListController;
use App\Http\Controllers\DieselController;
use App\Http\Controllers\HomeCarMainCbController;
use App\Http\Controllers\HomeCarMainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampleHomeCarCbController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('cars', CarController::class);
    Route::resource('car-staffs', CarStaffController::class);

    Route::get('/home-car-mains/in-date-related-info', [HomeCarMainController::class, 'getInDateRelatedInfo'])->name('home_car_mains.in_date_related_info');
    Route::resource('home-car-mains', HomeCarMainController::class);

    Route::get('/home-car-main-cbs/generate-ref-no', [HomeCarMainCbController::class, 'generateRefNo'])->name('home-car-main-cbs.generate_ref_no');
    Route::resource('home-car-main-cbs', HomeCarMainCbController::class);
    Route::get('/home-car-main-cbs/create/{homeCarMain}', [HomeCarMainCbController::class, 'create'])
        ->name('home-car-main-cbs.create');

    Route::resource('sample-home-car-cbs', SampleHomeCarCbController::class);

    Route::get('/daily-car-lists/date-related-info', [DailyCarListController::class, 'getDateRelatedInfo'])->name('daily-car-lists.date_related_info');
    Route::resource('daily-car-lists', DailyCarListController::class);

    Route::get('/diesels/in-date-related-info', [DieselController::class, 'getInDateRelatedInfo'])->name('diesels.in_date_related_info');
    Route::resource('diesels', DieselController::class);

    Route::get('/cb-records/date-related-info', [CbRecordController::class, 'getDateRelatedInfo'])->name('cb-records.date_related_info');
    Route::resource('cb-records', CbRecordController::class);

    Route::get('/cargos/date-related-info', [CargoController::class, 'getDateRelatedInfo'])->name('cargos.date_related_info');
    Route::get('/cargos/gates-by-city', [CargoController::class, 'getGatesByCity'])->name('cargos.gates_by_city');
    Route::post('/cargos/import-excel', [CargoController::class, 'importExcel'])->name('cargos.import_excel');
    Route::resource('cargos', CargoController::class);
});

require __DIR__ . '/auth.php';
