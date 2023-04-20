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
            if ($reports->isEmpty()) {
                return redirect()->route('reports.index')->withErrors("لا يوجد بيانات في هذا الشهر");
            }
        } else {
            $reports = Report::all();
        }
        return view('reports.index', compact('reports'));
    }
}
