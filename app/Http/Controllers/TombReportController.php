<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use App\Models\Region;
use Illuminate\Http\Request;

class TombReportController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('المقابر.reports', compact('regions'));
    }
}
