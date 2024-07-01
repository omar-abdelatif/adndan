<?php

namespace App\Http\Controllers;

use App\Models\TombSafe;
use App\Models\TombTotalSafe;
use Illuminate\Http\Request;

class TombSafeController extends Controller
{
    public function index(Request $request)
    {
        $response = $this->filter($request);
        $totalSafe = TombTotalSafe::findOrFail(1);
        $sumSafe = $totalSafe->amount;
        return view('reports.tomb_safe', compact('response', 'sumSafe'));
    }
    public function filter(Request $request)
    {
        $month = $request->input('date');
        $transactions = TombSafe::query();
        if ($month) {
            $transactions->whereYear('created_at', '=', date('Y', strtotime($month)))->whereMonth('created_at', '=', date('m', strtotime($month)));
        }
        return $transactions->get();
    }
}
