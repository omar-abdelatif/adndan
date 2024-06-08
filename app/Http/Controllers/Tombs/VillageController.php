<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VillageDeceaseds;

class VillageController extends Controller
{
    public function index(){
        $region = Region::where('name', 'القرية')->firstOrFail();
        $village = VillageDeceaseds::all();
        return view('المقابر.village.village', compact('region', 'village'));
    }
    public function createVillageDeceased(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'death_place' => 'required|string',
            'death_date' => 'required',
            'burial_date' => 'required'
        ]);
        if ($validated) {
            $store = VillageDeceaseds::create($validated);
            if ($store) {
                return redirect()->back()->withSuccess('تمت الإضافة بنجاح');
            }
            return redirect()->back()->withErrors($validated);
        }
    }
}
