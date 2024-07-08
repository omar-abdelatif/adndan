<?php

namespace App\Http\Controllers;

use App\Models\TombDonations;
use Illuminate\Http\Request;

class TombDonationsReportsController extends Controller
{
    public function index(Request $request)
    {
        $totalDonations = TombDonations::sum('amount');
        $donationFilter = $this->filter($request);
        return view('reports.tomb_reports', compact('totalDonations', 'donationFilter'));
    }
    public function filter(Request $request)
    {
        $month = $request->input('date');
        $transactions = TombDonations::query();
        if ($month) {
            $transactions->whereYear('created_at', '=', date('Y', strtotime($month)))->whereMonth('created_at', '=', date('m', strtotime($month)));
        }
        return $transactions->get();
    }
}
