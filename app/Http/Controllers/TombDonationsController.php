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
        $validations = $request->validate([]);
        $store = TombDonations::create();
        if ($store) {
            $notificationSuccess = [
                'message' => "تم الإضافة بنجاح",
                'alert-type' => 'success',
            ];
            return redirect()->route('tomb.index')->with($notificationSuccess);
        } else {
            return redirect()->route('tomb.index')->withErrors($validations);
        }
    }
}
