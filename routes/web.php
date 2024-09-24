<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\InternProfileController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PresensilamaController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::redirect('/', '/login');
});


Route::middleware(['auth',  'verified'])->group(function () {
    Route::view('home', 'home')->name('home');
    Route::view('password/update', 'auth.passwords.update')->name('passwords.update');
});

// new route
Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('role:super-admin')->prefix('super-admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'InternDashboard'])->name('super-admin.dashboard');
    });

    // Routes for Admin Role
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Route::get('/dashboard', [DashboardController::class, 'dashboardadmin'])->name('admin.dashboard');

        Route::get('/dashboard', [DashboardController::class, 'dashboardadmin'])->name('admin.dashboard');

        Route::get('/export/presensi/{id}', [ExportController::class, 'getInternPresensi'])->name('admin.intern.presensi');

        Route::get('/intern', [DataMasterController::class, 'index'])->name('admin.intern');
        Route::post('/intern/store', [DataMasterController::class, 'store'])->name('admin.intern.store');
        Route::get('/intern/{id}/edit', [DataMasterController::class, 'edit'])->name('admin.intern.edit');
        Route::post('/intern/{id}', [DataMasterController::class, 'update'])->name('admin.intern.update');

        // Route::get('/intern/{id}/delete', [DataMasterController::class, 'destroy'])->name('admin.intern.delete');
        Route::delete('admin/intern/{id}/delete', [DataMasterController::class, 'destroy'])->name('admin.intern.delete');

        Route::get('/chart-aktif', [InternController::class, 'getChartData'])->name('chart.data');
        Route::get('/chart-presensi', [DashboardController::class, 'presensichart'])->name('presensi.chart');
        Route::get('/delay-chart-data', [DashboardController::class, 'getDelayChartData'])->name('keterlambatan.chart');




        Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring'])->name('admin.presensi.monitoring');
        Route::get('/getpresensi', [PresensiController::class, 'getpresensi'])->name('admin.getpresensi');
        Route::get('/presensi/laporan', [PresensilamaController::class, 'laporan'])->name('admin.presensi.report');
        Route::post('/presensi/cetaklaporan', [PresensilamaController::class, 'cetaklaporan'])->name('admin.presensi.report.cetak');
        Route::get('/presensi/rekap', [PresensilamaController::class, 'rekap'])->name('admin.presensi.rekap');
        Route::post('/presensi/cetakrekap', [PresensilamaController::class, 'cetakrekap'])->name('admin.presensi.cetakrekap');

        Route::get('/office', [OfficeController::class, 'index'])->name('admin.office');
        Route::get('/office/setting', [OfficeController::class, 'edit'])->name('admin.office.setting');
        Route::post('/office/setting/store', [OfficeController::class, 'update'])->name('admin.office.setting.store');

        Route::get('/data/absensi', [AbsensiController::class, 'show'])->name('admin.absensi');
        Route::post('/data/absensi/update', [AbsensiController::class, 'update'])->name('admin.absensi.update');
        Route::get('/data/absensi/{id}/hapusizin', [AbsensiController::class, 'batalIzin'])->name('admin.absensi.batal');


        Route::get('presensi/showmap/{id}', [PresensilamaController::class, 'showmap'])->name('admin.presensi.showmap');

        Route::get('/event', [EventController::class, 'index'])->name('admin.event');
        Route::get('/event/create', [EventController::class, 'create'])->name('admin.event.create');
        Route::post('/event/store', [EventController::class, 'store'])->name('admin.event.store');

        Route::get('/surat', [SuratController::class, 'adminIndex'])->name('admin.surat');
        Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('admin.surat.edit');
        Route::put('/surat/update/{id}', [SuratController::class, 'update'])->name('admin.surat.update');

        Route::delete('/surat/delete/{id}', [SuratController::class, 'destroy'])->name('admin.surat.delete');
    });

    // Routes for Intern Role
    Route::middleware('role:intern')->prefix('intern')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'InternDashboard'])->name('intern.dashboard');

        Route::get('/goals', [GoalController::class, 'index'])->name('intern.goals');
        Route::post('/goal/store', [GoalController::class, 'store'])->name('intern.goal.store');
        Route::put('/goals/{id}', [GoalController::class, 'update'])->name('intern.goal.update'); // ID needed



        Route::get('/presensi/create', [PresensiController::class, 'index'])->name('intern.presensi.create');
        Route::post('/presensi/store', [PresensiController::class, 'store'])->name('intern.presensi.store');

        Route::get('/editprofile', [InternProfileController::class, 'edit'])->name('intern.profile.edit');
        Route::put('/updateprofile', [InternProfileController::class, 'update'])->name('intern.profile.update');



        Route::get('/presensi/history', [PresensilamaController::class, 'history'])->name('intern.presensi.history');
        Route::post('/gethistory', [PresensilamaController::class, 'gethistory'])->name('intern.gethistory');

        Route::get('/absensi', [AbsensiController::class, 'index'])->name('intern.absensi');
        Route::get('/absensi/form', [AbsensiController::class, 'create'])->name('intern.absensi.form');
        Route::post('/absensi/form/store', [AbsensiController::class, 'store'])->name('intern.absensi.form.store');

        Route::get('/struktur-organisasi', [OfficeController::class, 'organisasi'])->name('intern.struktur-organisasi');

        Route::get('/unit', [OfficeController::class, 'unit'])->name('intern.unit');

        Route::get('/show/{name}', [OfficeController::class, 'showunit'])->name('intern.show');

        Route::get('/surat', [SuratController::class, 'index'])->name('intern.surat');
        Route::get('/surat/create', [SuratController::class, 'create'])->name('intern.surat.create');
        Route::post('/surat/create/store', [SuratController::class, 'store'])->name('intern.surat.store');
    });
});