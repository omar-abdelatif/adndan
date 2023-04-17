<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TableCase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = TableCase::count();
        $date = Carbon::now();
        $fullDate = $date->format('l jS F Y');
        return view('home', compact('fullDate', 'count'));
    }
}
