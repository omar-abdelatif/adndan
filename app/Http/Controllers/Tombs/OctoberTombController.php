<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Region;
use App\Models\OctoberTomb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OctoberTombController extends Controller
{
    public function index()
    {
        return view('المقابر.أكتوبر.index');
    }

    public function addTomb(Request $request)
    {
        //! Validate the request data
        $validated = $request->validate([
            'name' => 'required|string',
            'power' => 'required|numeric',
            'type' => 'required|string|in:لحد,عيون',
            'annual_cost' => 'required|numeric',
            'region' => 'required|string|in:6 أكتوبر,الغفير,القطامية,الفيوم,زينهم,15 مايو'
        ]);

        // Get the region by name
        $region = Region::where('name', $validated['region'])->first();

        // Create a new tomb
        $tomb = new Tomb([
            'name' => $validated['name'],
            'power' => $validated['power'],
            'type' => $validated['type'],
            'annual_cost' => $validated['annual_cost'],
            'region' => $validated['region'],
            'region_id' => $region->id
        ]);

        // Save the tomb to the region
        $region->tombs()->save($tomb);

        // Redirect back with a success message
        return redirect()->route('tomb.add')->with('success', 'تمت إضافة المقبرة بنجاح.');
    }



}
