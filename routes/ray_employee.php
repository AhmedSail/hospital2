

<?php

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Ray_employee\InvoiceController;

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
Route::middleware('auth:ray_employee')->group(function () {
    Route::get('dashboard/ray_employee', function () {
        return view('Dashboard.RayEmployee.dashboard');
    })->name('dashboard.ray_employee');
});




################resource#######################################################
Route::middleware(['auth:ray_employee'])->group(function () {
    Route::prefix('ray_employee')->group(function(){
        Route::resource('invoice',InvoiceController::class);
        Route::get('complete_invoice',[InvoiceController::class,'complete'])->name('complete_invoice_ray');
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
