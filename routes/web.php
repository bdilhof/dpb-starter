<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Exports\UsersExport;

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

Route::get("excel", function () {
    return Excel::download(new UsersExport, 'users.xlsx');
});

Route::get("word", function () {

    // Get user data
    $user = [
        "name" => "BRUNO DILHOF",
        "address" => "Turčianska 3, 821 09 Bratislava",
        "personalNumber" => 17085,
        "phone" => "+421 944 353 185",
        "email" => "brunodilhof@gmail.com",
    ];

    // Load template
    $templatePath = base_path("public/payroll_template.docx");

    // Fill template with values
    $templateProcessor = new TemplateProcessor($templatePath);
    $templateProcessor->setValue("name", $user["name"]);
    $templateProcessor->setValue("address", $user["address"]);
    $templateProcessor->setValue("personalNumber", $user["personalNumber"]);
    $templateProcessor->setValue("phone", $user["phone"]);
    $templateProcessor->setValue("email", $user["email"]);
    $templateProcessor->setValue('date', now()->format("d.m.Y"));

    // Make file name
    $fileName = "{$user['personalNumber']}_dohoda_o_zasielani_vyplatnej_pasky_v_elektronickej_podobe.docx";

    // Store created file
    $newTemplatePath = storage_path("app/{$fileName}");
    $templateProcessor->saveAs($newTemplatePath);

    // Return download response and delete temp file
    return response()
        ->download($newTemplatePath)
        ->deleteFileAfterSend(true);
});