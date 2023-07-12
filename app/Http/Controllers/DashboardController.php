<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use App\Models\TableCase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAmount = Report::sum('amount');
        $count = TableCase::count();
        $date = Carbon::now();
        $fullDate = $date->format('l jS F Y');
        return view('home', compact('fullDate', 'count', 'totalAmount'));
    }
}
