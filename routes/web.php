<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\TombsController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\TombSafeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KfalaBankController;
use App\Http\Controllers\KfalaSafeController;
use App\Http\Controllers\TombReportController;
use App\Http\Controllers\OldDeceasedController;
use App\Http\Controllers\TombDonationsController;
use App\Http\Controllers\Tombs\VillageController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\Tombs\FayumTombController;
use App\Http\Controllers\Tombs\May15TombController;
use App\Http\Controllers\Tombs\GafeerTombController;
use App\Http\Controllers\Tombs\ZenhomTombController;
use App\Http\Controllers\Tombs\KatamyaTombController;
use App\Http\Controllers\Tombs\OctoberTombController;
use App\Http\Controllers\TombDonationsReportsController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
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
    Route::get('repotrs/allreports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/all_kfala_reports', [ReportController::class, 'kfala'])->name('reports.kfala');

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
    Route::get('october/tombs/{tombId}/rooms/{roomId}', [OctoberTombController::class, 'showRoom'])->name('october.rooms');
    Route::get('delete_october_deceased/{id}', [OctoberTombController::class, 'deleteDeceased'])->name('october-deceased.destroy');
    Route::post('update_october_deceased', [OctoberTombController::class, 'updateDeceased'])->name('october-deceased.update');
    //! Fayum Routes
    Route::get('fayum_tombs', [FayumTombController::class, 'index'])->name('fayum.index');
    Route::get('destroy_fayum_tomb/{id}', [FayumTombController::class, 'destroyTomb'])->name('fayum.destroy');
    Route::post('update_fayum_tomb', [FayumTombController::class, 'updateTomb'])->name('fayum.update');
    Route::get('fayum/tombs/{tombId}/rooms/{roomId}', [FayumTombController::class, 'showRoom'])->name('fayum.rooms');
    Route::get('delete_fayum_deceased/{id}', [FayumTombController::class, 'deleteDeceased'])->name('fayum-deceased.destroy');
    Route::post('update_fayum_deceased', [FayumTombController::class, 'updateDeceased'])->name('fayum-deceased.update');
    Route::get('get_deceased/{id}', [FayumTombController::class, 'showDeceased'])->name('fayum.showDeceased');
    //! Gafeer Routes
    Route::get('gafeer_tombs', [GafeerTombController::class, 'index'])->name('gafeer.index');
    Route::get('destroy_gafeer_tomb/{id}', [GafeerTombController::class, 'destroyTomb'])->name('gafeer.destroy');
    Route::post('update_gafeer_tomb', [GafeerTombController::class, 'updateTomb'])->name('gafeer.update');
    Route::get('gafeer/tombs/{tombId}/rooms/{roomId}', [GafeerTombController::class, 'showRoom'])->name('gafeer.rooms');
    Route::get('delete_gafeer_deceased/{id}', [GafeerTombController::class, 'deleteDeceased'])->name('gafeer-deceased.destroy');
    Route::post('update_gafeer_deceased', [GafeerTombController::class, 'updateDeceased'])->name('gafeer-deceased.update');
    //! Zenhom Routes
    Route::get('zenhom_tombs', [ZenhomTombController::class, 'index'])->name('zenhom.index');
    Route::get('destroy_zenhom_tomb/{id}', [ZenhomTombController::class, 'destroyTomb'])->name('zenhom.destroy');
    Route::post('update_zenhom_tomb', [ZenhomTombController::class, 'updateTomb'])->name('zenhom.update');
    Route::get('zenhom/tombs/{tombId}/rooms/{roomId}', [ZenhomTombController::class, 'showRoom'])->name('zenhom.rooms');
    Route::get('delete_zenhom_deceased/{id}', [ZenhomTombController::class, 'deleteDeceased'])->name('zenhom-deceased.destroy');
    Route::post('update_zenhom_deceased', [ZenhomTombController::class, 'updateDeceased'])->name('zenhom-deceased.update');
    //! Katamya Routes
    Route::get('katamya_tombs', [KatamyaTombController::class, 'index'])->name('katamya.index');
    Route::get('destroy_katamya_tomb/{id}', [KatamyaTombController::class, 'destroyTomb'])->name('katamya.destroy');
    Route::post('update_katamya_tomb', [KatamyaTombController::class, 'updateTomb'])->name('katamya.update');
    Route::get('katamya/tombs/{tombId}/rooms/{roomId}', [KatamyaTombController::class, 'showRoom'])->name('katamya.rooms');
    Route::get('delete_katamya_deceased/{id}', [KatamyaTombController::class, 'deleteDeceased'])->name('katamya-deceased.destroy');
    Route::post('update_katamya_deceased', [KatamyaTombController::class, 'updateDeceased'])->name('katamya-deceased.update');
    //! 15 May Routes
    Route::get('15may_tombs', [May15TombController::class, 'index'])->name('15may.index');
    Route::get('destroy_15may_tomb/{id}', [May15TombController::class, 'destroyTomb'])->name('15may.destroy');
    Route::post('update_15may_tomb', [May15TombController::class, 'updateTomb'])->name('15may.update');
    Route::get('15may/tombs/{tombId}/rooms/{roomId}', [May15TombController::class, 'showRoom'])->name('15may.rooms');
    Route::get('delete_15may_deceased/{id}', [May15TombController::class, 'deleteDeceased'])->name('15may-deceased.destroy');
    Route::post('update_15may_deceased', [May15TombController::class, 'updateDeceased'])->name('15may-deceased.update');
    //! Village Routes
    Route::controller(VillageController::class)->group(function () {
        Route::get('tombs/village/deceaseds/all', 'index')->name('village.all');
        Route::post("tombs/village/deceaseds/store", 'createVillageDeceased')->name("village.deceaseds.store");
        Route::post('tombs/village/deceaseds/update', 'update')->name('village.deceaseds.update');
        Route::get("tombs/village/deceaseds/delete/{id}", 'delete')->name('village.deceaseds.delete');
    });
    //! Rooms Routes
    Route::get('all_rooms', [RoomsController::class, 'index'])->name('rooms.all');
    Route::get('/get-rooms', [RoomsController::class, 'getRooms'])->name('getRooms');
    Route::get('get-rooms-by-tomb-id/{id}', [RoomsController::class, 'getRoomsByTombId']);
    Route::post('move_to_old_deceased/{roomId}', [RoomsController::class, 'moveToOldDeceased'])->name('rooms.oldDeceased');
    //! Deceased Routes
    Route::get('all_deceased', [DeceasedController::class, 'index'])->name('deceased.index');
    Route::get('new_deceased', [DeceasedController::class, 'addnew'])->name('deceased.addnew');
    Route::post('store_deceased', [DeceasedController::class, 'storeDeceased'])->name('deceased.store');
    Route::get('delete_deceased/{id}', [DeceasedController::class, 'destroy'])->name('deceased.delete');
    Route::post('update_deceased', [DeceasedController::class, 'update'])->name('deceased.update');
    Route::get('/get-deceased-sum', [DeceasedController::class, 'getDeceaseds'])->name('getDeceaseds');
    //! Old Deceased Routes
    Route::get('all_old_deceased', [OldDeceasedController::class, 'index'])->name('old.index');
    Route::post('create_old_deceased', [OldDeceasedController::class, 'importDeceased'])->name('old.import');
    Route::post('store_old_deceased', [OldDeceasedController::class, 'store'])->name('old.store');
    Route::get('delete_old_deceased/{id}', [OldDeceasedController::class, 'destroy'])->name('old.delete');
    Route::post('update_old_deceased', [OldDeceasedController::class, 'edit'])->name('old.update');
    //! Tombs Reports Routes
    Route::get('tombs_reports', [TombReportController::class, 'index'])->name('tombs.report');
    //! New Tomb Donators Routes
    Route::controller(TombDonationsController::class)->group(function () {
        Route::get('new-tombs/donators', 'index')->name('tomb.index');
        Route::post('new-tombs/donators/store', 'storeDonators')->name("new.tomb.donator.store");
        Route::post('new-tombs/donators/update', 'updateDonators')->name('new.tomb.donator.update');
        Route::get("new-totmbs/donator/destroy/{id}", 'deleteDonators')->name('new.tomb.donator.destroy');
        Route::get('new-tombs/donators/donations/history/{id}', 'tombDonatorHistory')->name('new.tomb.donator.donation.history');
        Route::post('new-tombs/donators/donations/store', 'donationStore')->name("new.tomb.donation.store");
        Route::post("new-tombs/donators/donations/update", 'donationUpdate')->name("new.tomb.donation.update");
        Route::get("new-tombs/donators/donations/destroy/{id}", 'donationDelete')->name("new.tomb.donation.delete");
    });
    //! Kfala Bank & Safe Routes
    Route::prefix('kfala')->group(function () {
        //! Kfala Bank Reports
        Route::prefix('bank')->group(function () {
            Route::controller(KfalaBankController::class)->group(function () {
                Route::get('view', 'index')->name('bank.view');
                Route::post('deposit', 'bankDeposit')->name("bank.deposit");
            });
        });
        //! Kfala Safe Reports
        Route::controller(KfalaSafeController::class)->group(function () {
            Route::get('safe/view', 'index')->name('safe.view');
            Route::post('bank/withdraw', 'bankWithDraw')->name("bank.withdraw");
            Route::get('reports/safe_reports', 'safeReports')->name('reports.safe');
        });
    });
    Route::prefix('tomb')->group(function () {
        Route::prefix('reports')->group(function () {
            Route::controller(TombSafeController::class)->group(function () {
                Route::get("safe", "index")->name("tomb.safe.view");
                Route::get("filter", 'filter')->name('tomb.filter');
            });
        });
        Route::prefix('tombs_donations_reports')->group(function () {
            Route::controller(TombDonationsReportsController::class)->group(function () {
                Route::get('all', 'index')->name('tomb.reports.donations.index');
                Route::get('filter', 'filter')->name('tomb.reports.donations.filter');
            });
        });
    });
});
