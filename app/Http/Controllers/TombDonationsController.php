<?php

namespace App\Http\Controllers;

use App\Models\TombDonations;
use Illuminate\Http\Request;

class TombDonationsController extends Controller
{
    public function index()
    {
        return view('المقابر.donations.index');
    }
    public function storeDonators(Request $request)
    {
        $validations = $request->validate([
            
        ]);
        $store = TombDonations::create($validations);
        if ($store) {
            return redirect()->route('tomb.index')->withSuccess('تم التسجيل بنجاح');
        } else {
            return redirect()->route('tomb.index')->withErrors($validations);
        }
    }
}
