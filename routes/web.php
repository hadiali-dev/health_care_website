<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController; // <-- Import this
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController; 
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboards
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/patients/{patient}/status', [DashboardController::class, 'updateHealthStatus'])->name('patients.update_status');
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
  Route::post('/nearby-patients', [MapController::class, 'getNearby'])->name('map.nearby');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';