<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationHistory;
use Illuminate\Support\Facades\Auth;

class DonationHistoryController extends Controller
{
    public function index()
    {
        $donation = DonationHistory::all();
        return view('donation.index', compact('donation'));
    }
    public function AddNew()
    {
        return view('donation.addnew');
    }
    public function donationstore(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'mobile_phone' => 'required|numeric',
            'amount' => 'required|numeric',
            'duration' => 'required|in:1month,3month,6month,annually,other'
        ]);
        $store = DonationHistory::create([
            'name' => $request->name,
            'mobile_phone' => $request->mobile_phone,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'donator_id' => Auth::id(),
        ]);
        if ($store) {
            return redirect()->route('donation.index')->with('success', 'تم الإضافة بنجاح');
        }
        return redirect()->route('donation.addnew')->withErrors($validator);
    }
}
