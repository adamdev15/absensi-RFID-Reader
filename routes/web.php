<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Master Data
    Route::resource('participants', App\Http\Controllers\ParticipantController::class);
    Route::resource('utusan', App\Http\Controllers\UtusanController::class)->except(['show']);
    Route::resource('positions', App\Http\Controllers\PositionController::class)->except(['show']);
    Route::resource('mwcnu', App\Http\Controllers\MwcnuController::class)->except(['show']);
    
    // RFID Management
    Route::resource('rfid', App\Http\Controllers\RfidCardController::class)->only(['index', 'store', 'update', 'destroy']);

    // Station Management
    Route::resource('stations', App\Http\Controllers\StationController::class)->except(['create', 'edit', 'show']);
    Route::get('stations/{station}/kiosk', [App\Http\Controllers\StationController::class, 'kiosk'])->name('stations.kiosk');

    // Reports & Logs
    Route::get('logs', [App\Http\Controllers\LogController::class, 'index'])->name('logs.index');
    
    Route::get('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::post('reports/export', [App\Http\Controllers\ReportController::class, 'export'])->name('reports.export');

    // System Settings
    Route::get('settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

    // Backup
    Route::prefix('system-backup')->name('backup.')->group(function () {
        Route::get('/', [App\Http\Controllers\BackupController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\BackupController::class, 'create'])->name('create');
        Route::post('restore/{file}', [App\Http\Controllers\BackupController::class, 'restore'])->name('restore');
        Route::get('download/{file}', [App\Http\Controllers\BackupController::class, 'download'])->name('download');
        Route::delete('delete/{file}', [App\Http\Controllers\BackupController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
