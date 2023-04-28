<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\Tombs\FayumTombController;
use App\Http\Controllers\Tombs\GafeerTombController;
use App\Http\Controllers\Tombs\KatamyaTombController;
use App\Http\Controllers\Tombs\May15TombController;
use App\Http\Controllers\Tombs\OctoberTombController;
use App\Http\Controllers\Tombs\ZenhomTombController;
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
    //! Excel Uploader Routes
    Route::post('upload', [CaseController::class, 'importExcel'])->name('import');
    //! Donator Routes
    Route::get('alldonators', [DonatorController::class, 'index', "data"])->name('donator.index');
    Route::get('add_donator', [DonatorController::class, 'AddNew'])->name('donator.addnew');
    Route::post('create-donator', [DonatorController::class, 'store'])->name('donator.store');
    Route::get('delete-donator/{id}', [DonatorController::class, 'destroy'])->name('donator.delete');
    Route::get('edit-donator/{id}', [DonatorController::class, 'edit'])->name('donator.edit');
    Route::post('update-donator', [DonatorController::class, 'update'])->name('donator.update');
    //! Donation History Routes
    Route::get('all_donations/{id}', [DonationHistoryController::class, 'index'])->name('donation.index');
    Route::post('add_donation', [DonationHistoryController::class, 'donationstore'])->name('donation.store');
    Route::get('delete_donation/{id}', [DonationHistoryController::class, 'destroy'])->name('donation.destroy');
    //! Reports Routes
    Route::get('allreports', [ReportController::class, 'index'])->name('reports.index');
    //! Texts Routes
    Route::view('add_text', 'text.sendnew')->name('text.add');
    Route::post('send_sms', [SMSController::class, 'sendSms'])->name('text.send');
    //! Tombs  Routes
    Route::get('alltombs', [TombsController::class, 'index'])->name('tombs.index');
    //! October Tombs Routes
    Route::get('october_tombs', [OctoberTombController::class, 'index'])->name('october.index');
    //! Fayum Routes
    Route::get('fayum_tombs', [FayumTombController::class, 'index'])->name('fayum.index');
    //! Gafeer Routes
    Route::get('gafeer_tombs', [GafeerTombController::class, 'index'])->name('gafeer.index');
    //! Zenhom Routes
    Route::get('zenhom_tombs', [ZenhomTombController::class, 'index'])->name('zenhom.index');
    //! Katamya Routes
    Route::get('katamya_tombs', [KatamyaTombController::class, 'index'])->name('katamya.index');
    //! 15 May Routes
    Route::get('15may_tombs', [May15TombController::class, 'index'])->name('15may.index');
});
