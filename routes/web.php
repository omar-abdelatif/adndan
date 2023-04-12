<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\DonatorController;
use App\Models\DonationHistory;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::view('addnew', 'الكفالة.addnew')->name('addnew');
    Route::view('showall','الكفالة.showall')->name('showall');
    Route::post('storecase', [CaseController::class, 'storecase'])->name('storecase');
    Route::get('home', [CaseController::class, 'ViewData'])->name('home');
    Route::get('delete/{id}', [CaseController::class, 'delete'])->name('delete');
    Route::post('update', [CaseController::class, 'updatecase'])->name('update');
    //! Excel Uploader
    Route::post('upload', [CaseController::class, 'importExcel'])->name('import');
    //! Donator Routes
    Route::get('alldonators', [DonatorController::class, 'index'])->name('donator.index');
    Route::get('add_donator', [DonatorController::class, 'AddNew'])->name('donator.addnew');
    Route::post('create-donator', [DonatorController::class, 'store'])->name('donator.store');
    Route::get('delete-donator/{id}', [DonatorController::class, 'destroy'])->name('donator.delete');
    Route::get('edit-donator/{id}', [DonatorController::class, 'edit'])->name('donator.edit');
    Route::post('update-donator', [DonatorController::class, 'update'])->name('donator.update');
    Route::get('history/{id}', [DonatorController::class, 'history'])->name('donator.history');
    //! Donation History
    Route::get('all_donations', [DonationHistoryController::class, 'index'])->name('donation.index');
    Route::post('add_donation', [DonationHistoryController::class, 'donationstore'])->name('donation.store');
    //! Reports
    Route::view('allreports', 'reports.index')->name('reports.index');
});
