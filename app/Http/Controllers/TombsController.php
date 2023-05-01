<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Tomb;
use Illuminate\Http\Request;

class TombsController extends Controller
{
    public function AllTombs()
    {
        // $regionById = Region::find($regionId);
        // $tombHistory = $regionById->regions;
        return view('المقابر.أكتوبر.index', compact('regionId', 'tombHistory'));
    }
    public function TombForm()
    {
        $region = Region::all();
        return view('المقابر.addtomb', compact('region'));
    }
    public function tombStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'power' => 'required|numeric',
            'type' => 'required|in:لحد,عيون',
            'region' => 'required|string'
        ]);
        $region = Region::where('name', $request->name)->first();
        if ($region) {
            $tomb = new Tomb();
            $tomb->name = $request->name;
            $tomb->power = $request->power;
            $tomb->type = $request->type;
            $tomb->region = $request->region;
            $tomb->region_id = $region->id;
            $store = $tomb->save();
        }
        if ($store) {
            return redirect()->route('tomb.add', $region->id)->with('success', 'تمت الإضافة بنجاح');
        }
        return redirect()->route('tomb.add')->withErrors($validate);
    }
}
