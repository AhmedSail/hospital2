

<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleService;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\dashboard\GroupController;
use App\Http\Controllers\dashboard\DoctorController;
use App\Http\Controllers\dashboard\DoctoreController;
use App\Http\Controllers\dashboard\InvoiceController;
use App\Http\Controllers\dashboard\PatientController;
use App\Http\Controllers\dashboard\PaymentController;
use App\Http\Controllers\dashboard\ReceiptController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\dashboard\LaboratoryController;
use App\Http\Controllers\dashboard\AmbulanceController;
use App\Http\Controllers\dashboard\InsuranceController;
use App\Http\Controllers\dashboard\RayEmployeeController;
use App\Http\Controllers\dashboard\GroupInvoicesController;
use App\Http\Controllers\dashboard\SingleServiceController;

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
    return view('welcome');
});

Route::get('dashboard', function () {
    if (auth()->guard('admin')->check()) {

        return redirect()->route('dashboard.admin');
    }
    if (Auth::guard('doctor')->check()) {

        return redirect()->route('dashboard.doctor');
    }
    if (Auth::guard('web')->check()) {

        return redirect()->route('dashboard.user');
    }
    if (Auth::guard('patient')->check()) {
        return redirect()->route('dashboard.patient');
    }
    if (Auth::guard('ray_employee')->check()) {

        return redirect()->route('dashboard.ray_employee');
    }
    if (Auth::guard('laboratory_employee')->check()) {

        return redirect()->route('dashboard.laboratory_employee');
    }
})->middleware(['auth:web,admin,doctor,patient,ray_employee,laboratory_employee'])->name('dashboard');
###########################################end dashboard auth#################

###########################################dashboard user#####################
Route::middleware('auth:web')->group(function () {
    Route::get('dashboard/user', function () {
        return view('Dashboard.User.dashboard');
    })->name('dashboard.user');
});
###########################################end dashboard user#################

###########################################dashboard admin####################
Route::middleware('auth:admin')->group(function () {
    Route::get('dashboard/admin', function () {
        return view('Dashboard.Admin.dashboard');
    })->name('dashboard.admin');
});

###########################################end dashboard admin#################


Route::middleware(['auth:admin'])->group(function () {
    Route::resource('sections', SectionController::class);
});


################ end resource##################################################

################resource#######################################################
Route::middleware(['auth:admin'])->group(function () {
    Route::resource('doctors', DoctorController::class);
    Route::post('update_password/{id}', [DoctorController::class, 'update_password'])->name('update_password');
    Route::post('update_status_doctor/{id}', [DoctorController::class, 'update_status'])->name('update_status_doctor');
    Route::resource('Service',SingleServiceController::class);
    Route::post('update_status/{id}', [SingleServiceController::class, 'update_status'])->name('update_status_service');
    Route::resource('GroupService',GroupController::class);
    Route::resource('Insurances',InsuranceController::class);
    Route::resource('Ambulances',AmbulanceController::class);
    Route::resource('Patients',PatientController::class);
    Route::resource('Invoices',InvoiceController::class);
    Route::resource('Receipts',ReceiptController::class);
    Route::resource('Payment',PaymentController::class);
    Route::resource('GroupInvoices',GroupInvoicesController::class);
    Route::resource('RayEmployee',RayEmployeeController::class);
    Route::resource('Laboratorys',LaboratoryController::class);
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
