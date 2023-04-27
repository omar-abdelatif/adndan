<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\TombsController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    //! Home Routes
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    //! Case Routes
    Route::view('addnew', 'الكفالة.addnew')->name('addnew');
    Route::get('showall', [CaseController::class, 'ViewData'])->name('showall');
    Route::post('storecase', [CaseController::class, 'storecase'])->name('storecase');
    Route::get('delete/{id}', [CaseController::class, 'delete'])->name('delete');
    Route::post('update', [CaseController::class, 'updatecase'])->name('update');
    //! Excel Uploader
    Route::post('upload', [CaseController::class, 'importExcel'])->name('import');
    //! Donator Routes
    Route::get('alldonators', [DonatorController::class, 'index', "data"])->name('donator.index');
    Route::get('add_donator', [DonatorController::class, 'AddNew'])->name('donator.addnew');
    Route::post('create-donator', [DonatorController::class, 'store'])->name('donator.store');
    Route::get('delete-donator/{id}', [DonatorController::class, 'destroy'])->name('donator.delete');
    Route::get('edit-donator/{id}', [DonatorController::class, 'edit'])->name('donator.edit');
    Route::post('update-donator', [DonatorController::class, 'update'])->name('donator.update');
    //! Donation History
    Route::get('all_donations/{id}', [DonationHistoryController::class, 'index'])->name('donation.index');
    Route::post('add_donation', [DonationHistoryController::class, 'donationstore'])->name('donation.store');
    Route::get('delete_donation/{id}', [DonationHistoryController::class, 'destroy'])->name('donation.destroy');
    //! Reports
    Route::get('allreports', [ReportController::class, 'index'])->name('reports.index');
    //! Texts
    Route::view('add_text', 'text.sendnew')->name('text.add');
    Route::post('send_sms', [SMSController::class, 'sendSms'])->name('text.send');
    //! Tombs
    Route::get('alltombs', [TombsController::class, 'index'])->name('tomb.index');
});
