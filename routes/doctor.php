

<?php

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\doctor\RayController;
use App\Http\Controllers\doctor\InvoiceController;
use App\Http\Controllers\doctor\DiagnosisController;
use App\Http\Controllers\doctor\LaboratoryController;
use App\Http\Controllers\doctor\PatientDetailController;
use App\Models\Doctor;

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

Route::middleware(['auth:doctor', 'doctor.status'])->group(function () {
    Route::get('dashboard/doctor', function () {
        return view('Dashboard.Doctor.dashboard');
    })->name('dashboard.doctor');
});

// Route for inactive doctors
Route::get('doctor/inactive', function () {
    return view('Dashboard.Doctor.inactive'); // قم بتحديد اسم العرض الذي تريده للدكتور غير المفعل
})->name('doctor.inactive');




################resource#######################################################
Route::middleware(['auth:doctor'])->group(function () {
    Route::prefix('doctor')->group(function(){
        Route::resource('doctor_invoices',InvoiceController::class);
        Route::resource('Diagnosis',DiagnosisController::class);
        Route::get('review_invoices',[InvoiceController::class,'review_invoices'])->name('review_invoices');
        Route::get('complete_invoices',[InvoiceController::class,'complete_invoices'])->name('complete_invoices');
        Route::post('add_review', [DiagnosisController::class,'addReview'])->name('add_review');
        Route::resource('Rays',RayController::class);
        Route::get('Patient_Detail/{id}',[PatientDetailController::class,'index'])->name('Patient_Detail');
        Route::resource('Laboratory',LaboratoryController::class);
        Route::get('show_laboratorie/{id}', [InvoiceController::class,'showLaboratorie'])->name('show.laboratorie');
    });
});


################ end resource##################################################
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin', function () {
    if (auth()->guard('admin')->check()) {
        return redirect('dashboard/admin');
    } elseif (Auth::guard('web')->check()) {
        return redirect('dashboard/user');
    }
})->middleware(['auth:web,admin', 'must_login'])->name('admin');

require __DIR__ . '/auth.php';
