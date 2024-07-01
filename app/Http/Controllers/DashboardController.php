<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\Donator;
use App\Models\NewTombDonators;
use App\Models\OldDeceased;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\TableCase;
use App\Models\Tomb;
use App\Models\TombDonations;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDeceased = Deceased::count();
        $totalOldDeceased = OldDeceased::count();
        $tombs = Tomb::count();
        $totalTombDonations = TombDonations::sum('amount');
        $totalDonators = Donator::count();
        $totalTombDonators = NewTombDonators::count();
        $totalAmount = Report::sum('amount');
        $count = TableCase::count();
        $date = Carbon::now();
        $fullDate = $date->format('l jS F Y');
        return view('home', compact('fullDate', 'count', 'totalAmount', 'totalDeceased', 'totalOldDeceased', 'tombs', 'totalTombDonations', 'totalDonators', 'totalTombDonators'));
    }
}
