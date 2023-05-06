<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoomsController;
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
    Route::get('add_text', [SMSController::class, 'index'])->name('text.add');
    Route::post('send_sms', [SMSController::class, 'sendSms'])->name('api.send');
    //! Region  Routes
    Route::get('allregions', [RegionController::class, 'index'])->name('region.index');
    Route::post('store_region', [RegionController::class, 'regionStore'])->name('region.store');
    //! Tombs Routes
    Route::get('all_tombs', [TombsController::class, 'AllTombs'])->name('tombs.all');
    Route::get('add_tombs', [TombsController::class, 'TombForm'])->name('tomb.add');
    Route::post('create_tombs', [TombsController::class, 'addTomb'])->name('tombs.store');
    Route::get('destroy_tomb/{id}', [TombsController::class, 'deleteTomb'])->name('tomb.destroy');
    Route::post('update_tomb', [TombsController::class, 'updateTomb'])->name('tomb.update');
    Route::get('/get-tombs', [TombsController::class, 'getTombs'])->name('getTombs');
    //! October Tombs Routes
    Route::get('october_tombs', [OctoberTombController::class, 'index'])->name('october.index');
    Route::get('destroy_october_tomb/{id}', [OctoberTombController::class, 'destroyTomb'])->name('october.destroy');
    Route::post('update_october_tomb', [OctoberTombController::class, 'updateTomb'])->name('october.update');
    //! Fayum Routes
    Route::get('fayum_tombs', [FayumTombController::class, 'index'])->name('fayum.index');
    Route::get('destroy_fayum_tomb/{id}', [FayumTombController::class, 'destroyTomb'])->name('fayum.destroy');
    Route::post('update_fayum_tomb', [FayumTombController::class, 'updateTomb'])->name('fayum.update');
    //! Gafeer Routes
    Route::get('gafeer_tombs', [GafeerTombController::class, 'index'])->name('gafeer.index');
    Route::get('destroy_gafeer_tomb/{id}', [GafeerTombController::class, 'destroyTomb'])->name('gafeer.destroy');
    Route::post('update_gafeer_tomb', [GafeerTombController::class, 'updateTomb'])->name('gafeer.update');
    //! Zenhom Routes
    Route::get('zenhom_tombs', [ZenhomTombController::class, 'index'])->name('zenhom.index');
    Route::get('destroy_zenhom_tomb/{id}', [ZenhomTombController::class, 'destroyTomb'])->name('zenhom.destroy');
    Route::post('update_zenhom_tomb', [ZenhomTombController::class, 'updateTomb'])->name('zenhom.update');
    //! Katamya Routes
    Route::get('katamya_tombs', [KatamyaTombController::class, 'index'])->name('katamya.index');
    Route::get('destroy_katamya_tomb/{id}', [KatamyaTombController::class, 'destroyTomb'])->name('katamya.destroy');
    Route::post('update_katamya_tomb', [KatamyaTombController::class, 'updateTomb'])->name('katamya.update');
    //! 15 May Routes
    Route::get('15may_tombs', [May15TombController::class, 'index'])->name('15may.index');
    Route::get('destroy_15may_tomb/{id}', [May15TombController::class, 'destroyTomb'])->name('15may.destroy');
    Route::post('update_15may_tomb', [May15TombController::class, 'updateTomb'])->name('15may.update');
    //! Rooms Routes
    Route::get('all_rooms', [RoomsController::class, 'index'])->name('rooms.all');
    Route::get('/get-rooms', [RoomsController::class, 'getRooms'])->name('getRooms');
    // Route::post('/tomb/create-rooms', [TombsController::class, 'addTomb'])->name('room.create');
    //! Deceased Routes
    Route::get('all_deceased', [DeceasedController::class, 'index'])->name('deceased.index');
    Route::post('store_deceased', [DeceasedController::class, ''])->name('deceased.store');
});
