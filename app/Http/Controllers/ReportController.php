<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use Illuminate\Http\Request;
use App\Models\DonationHistory;
use App\Models\Donator;
use App\Models\Region;
use App\Models\TableCase;
use App\Models\Tomb;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::all();
        $tombs = Tomb::all();
        $monthly = Donator::where('duration', 'شهري')->get();
        $seasonly = Donator::where('duration', 'أخرى')->get();
        $month = $request->input('date');
        $donators = Donator::with('donationHistory')->get();
        $donations = DonationHistory::with('donator')->get();
        // dd($donations);
        if ($month) {
            $get_all_donations = DonationHistory::whereYear('created_at', '=', date('Y', strtotime($month)))->whereMonth('created_at', '=', date('m', strtotime($month)))->get();
        } else {
            $get_all_donations = DonationHistory::all();
        }
        return view('reports.index', compact('get_all_donations', 'regions', 'tombs', 'monthly', 'seasonly', 'donators', 'donations'));
    }
    public function kfala(Request $request)
    {
        $cases = TableCase::get();
        $money_benefit_count = $cases->where('benefit_type', 'نقدية')->count();
        $food_benefit_count = $cases->where('benefit_type', 'عينية')->count();
        $monthly_benefit_count = $cases->where('benefit_duration', 'شهرية')->count();
        $season_benefit_count = $cases->where('benefit_duration', 'موسمية')->count();
        $monthly_cases = TableCase::where('monthly_income', '!=', null)->get();
        $monthly_sum = $monthly_cases->sum('monthly_income');
        return view('reports.kfala', compact([
            'money_benefit_count',
            'food_benefit_count',
            'monthly_benefit_count',
            'season_benefit_count',
            'monthly_cases',
            'monthly_sum'
        ]));
    }
}
