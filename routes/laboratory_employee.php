

<?php

use App\Http\Controllers\Laboratory_employee\LaboratoryEmployeeController;
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
Route::middleware('auth:laboratory_employee')->group(function () {
    Route::get('dashboard/laboratory_employee', function () {
        return view('Dashboard.Laboratory.dashboard');
    })->name('dashboard.laboratory_employee');
});




################resource#######################################################
Route::middleware(['auth:laboratory_employee'])->group(function () {
    Route::prefix('laboratory_employee')->group(function(){
        Route::resource('LaboratoryEmployee', LaboratoryEmployeeController::class);
        Route::get('complete_invoice',[LaboratoryEmployeeController::class,'complete'])->name('complete_invoice');
        Route::get('view_laboratories/{id}', [LaboratoryEmployeeController::class,'show'])->name('show');
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
