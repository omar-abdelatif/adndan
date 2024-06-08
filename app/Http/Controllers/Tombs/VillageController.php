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
        return view('المقابر.village.village', compact('region'));
    }
    public function create(Request $request)
    {
        $validated = $request->validate([]);
        if ($validated) {
            $store = VillageDeceaseds::create($validated);
            if ($store) {
                return redirect()->back()->withSuccess('تمت الإضافة بنجاح');
            }
            return redirect()->back()->withErrors($validated);
        }
    }
}
