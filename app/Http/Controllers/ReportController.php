<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DonationHistory;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('date');
        if ($month) {
            $get_all_donations = DonationHistory::whereDate('created_at', '=', $month)->get();
            if ($get_all_donations->isEmpty()) {
                return redirect()->route('reports.index')->withErrors('لا توجد بيانات في هذا اليوم');
            }
        } else {
            $get_all_donations = DonationHistory::all();
        }
        return view('reports.index', compact('get_all_donations'));
    }
}
