<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('date');
        if ($selectedMonth) {
            $reports = Report::whereMonth('created_at', '=', date('m', strtotime($selectedMonth)))->get();
            $count = Report::count();
        } else {
            $reports = Report::all();
            $count = Report::count();
        }
        return view('reports.index', compact('reports', 'count'));
    }
}
