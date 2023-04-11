<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;

class DonatorController extends Controller
{
    public function index()
    {
        $donator = Donator::all();
        return view('donator.index', compact('donator'));
    }
    public function AddNew()
    {
        return view('donator.addnew');
    }
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'mobile_phone' => 'required|numeric',
            'amount' => 'required|numeric',
            'duration' => 'required|numeric'
        ]);
        $store = Donator::create([
            'name' => $request->name,
            'mobile_phone' => $request->mobile_phone,
            'amount' => $request->amount,
            'duration' => $request->duration
        ]);
    }
}
