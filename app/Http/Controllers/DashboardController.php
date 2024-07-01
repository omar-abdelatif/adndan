<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tomb;
use App\Models\Report;
use App\Models\Donator;
use App\Models\Deceased;
use App\Models\TableCase;
use App\Models\OldDeceased;
use App\Models\TombDonations;
use App\Models\DonationHistory;
use App\Models\NewTombDonators;

class DashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now();
        $tombs = Tomb::count();
        $count = TableCase::count();
        $totalDonators = Donator::count();
        $totalDeceased = Deceased::count();
        $totalAmount = Report::sum('amount');
        $fullDate = $date->format('l jS F Y');
        $totalOldDeceased = OldDeceased::count();
        $totalTombDonators = NewTombDonators::count();
        $totalDonations = DonationHistory::sum('amount');
        $totalTombDonations = TombDonations::sum('amount');
        return view('home', compact('fullDate', 'count', 'totalAmount', 'totalDeceased', 'totalDonations', 'totalOldDeceased', 'tombs', 'totalTombDonations', 'totalDonators', 'totalTombDonators'));
    }
}
