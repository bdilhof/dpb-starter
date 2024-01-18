<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\TicketCategoryController;
use App\Http\Controllers\Evidence\EvidenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tickets\TicketController;

use App\Models\Tickets\TicketEntry;

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

require __DIR__.'/auth.php';

Route::middleware(["auth"])->group(function () {

    // Dashboard
    Route::view('/', 'dashboard')->name('dashboard');

    // Admin
    Route::prefix('admin')->name('admin.')->group(function () {

    });

    // Profile
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});