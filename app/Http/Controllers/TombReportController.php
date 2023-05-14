<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TombReportController extends Controller
{
    public function index()
    {
        return view('المقابر.reports');
    }
}
