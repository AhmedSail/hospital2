

<?php

use App\Http\Controllers\patient_dashboard\PatientDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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



###########################################dashboard doctor####################

Route::middleware('auth:patient')->group(function () {
    Route::get('dashboard/patient', function () {
        return view('Dashboard.Patients.dashboard');
    })->name('dashboard.patient');
});





################resource#######################################################
Route::middleware(['auth:patient'])->group(function () {
    Route::prefix('patient')->group(function(){
        Route::resource('Patient', PatientDashboardController::class);
        Route::get('View_Rays',[PatientDashboardController::class,'ray'])->name('View_Rays');
        Route::get('View_Rays/{id}',[PatientDashboardController::class,'show_ray'])->name('show_ray');
        Route::get('View_Laboratory',[PatientDashboardController::class,'laboratory'])->name('View_Laboratory');
        Route::get('View_Laboratory/{id}',[PatientDashboardController::class,'show_test'])->name('show_test');
    });
});


################ end resource##################################################
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
