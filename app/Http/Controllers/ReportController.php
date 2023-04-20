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
            $reports = Report::whereMonth('date', '=', date('m', strtotime($selectedMonth)))->get();
            if ($reports->isEmpty()) {
                echo "لا يوجد بيانات في هذا الشهر";
            }
        } else {
            $reports = Report::all();
        }
        return view('reports.index', compact('reports'));
    }
}
