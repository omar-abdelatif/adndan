<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationHistory;

class DonationHistoryController extends Controller
{
    public function index()
    {
        $donator = DonationHistory::all();
        return view('donation.index', compact('donation'));
    }
    public function AddNew()
    {
        return view('donation.addnew');
    }
}
