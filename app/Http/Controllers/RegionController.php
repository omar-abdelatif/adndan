<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return view('المقابر.index');
    }
    public function regionStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|numeric'
        ]);
        $store = Region::create($validate);
        if ($store) {
            return redirect()->route('region.index')->with('success', 'تمت الإضافة بنجاح');
        }
        return redirect()->route('region.index')->withErrors($validate);
    }
}
