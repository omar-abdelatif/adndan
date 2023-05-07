<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\Region;
use Illuminate\Http\Request;

class DeceasedController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('المقابر.deceased.addnew', compact('regions'));
    }
    public function storeDeceased(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'death_place' => 'required|string',
            'death_date' => 'required|date',
            'burial_date' => 'required|date',
            'washer' => 'required|string',
            'carrier' => 'required|string',
            'region' => 'required|string',
            'tomb' => 'required|string',
            'room' => 'required|string',
            'notes' => 'nullable',
            'files' => 'required|mimes: pdf, png, jpg, jpeg, webp|max:3072',
        ]);
        $store = Deceased::create($validated);
        if ($store) {
            return redirect()->route('deceased.index')->with('success', 'تمت الإضافة بنجاح');
        }
        return redirect()->route('deceased.index')->withErrors($validated);
    }
}
