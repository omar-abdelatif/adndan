<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationHistory;
use App\Models\TableCase;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('date');
        $donations = DonationHistory::with('donator');
        if ($month) {
            $donations = $donations->whereYear('created_at', '=', date('Y', strtotime($month)))->whereMonth('created_at', '=', date('m', strtotime($month)))->get();
        } else {
            $donations = $donations->get();
        }
        return view('reports.index', compact('donations'));
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
        $expenseDetails = $this->expensesDetails();
        return view('reports.kfala', compact([
            'money_benefit_count',
            'food_benefit_count',
            'monthly_benefit_count',
            'season_benefit_count',
            'monthly_cases',
            'monthly_sum',
            'expenseDetails'
        ]));
    }
    public function expensesDetails()
    {
        $cases = TableCase::where('benefit_type', 'نقدية')->get();
        return $cases;
    }
}
