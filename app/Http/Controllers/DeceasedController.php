<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
use App\Models\Deceased;
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
        // $validated = $request->validate([
        //     'name' => 'required|string',
        //     'death_place' => 'required|string',
        //     'death_date' => 'required|date',
        //     'burial_date' => 'required|date',
        //     'washer' => 'required|string',
        //     'carrier' => 'required|string',
        //     'region' => 'required|string',
        //     'tomb' => 'required|string',
        //     'room' => 'required|string',
        //     'notes' => 'nullable',
        //     'files.*' => 'required|mimes:pdf,png,jpg,jpeg,webp|max:3072',
        // ]);
        $room = Rooms::where('id', $request->id)->first();

        if ($room) {
            echo "yes";
            // $deceased = new Deceased();
            // $deceased->name = $validated['name'];
            // $deceased->death_place = $validated['death_place'];
            // $deceased->death_date = $validated['death_date'];
            // $deceased->burial_date = $validated['burial_date'];
            // $deceased->washer = $validated['washer'];
            // $deceased->carrier = $validated['carrier'];
            // $deceased->region = $validated['region'];
            // $deceased->tomb = $validated['tomb'];
            // $deceased->room = $validated['room'];
            // $deceased->notes = $validated['notes'];
            // $names = [];
            // if ($request->hasFile('files')) {
            //     foreach ($request->file('files') as $file) {
            //         $name = time() . '.' . $file->getClientOriginalExtension();
            //         $destinationPath = public_path('build/assets/backend/files');
            //         $file->move($destinationPath, $name);
            //         $names[] = $name;
            //     }
            // }
            // $deceased->files = implode(',', $names);
            // $deceased->region_id = $region->id;
            // $deceased->tomb_id = $tomb->id;
            // $deceased->room_id = $room->id;
            // $store = $deceased->save();
            // if ($store) {
            //     return redirect()->route('deceased.index')->with('success', 'تمت الإضافة بنجاح');
            // }
        }
        echo "no thing happen";
        // return redirect()->route('deceased.index')->with('error', $validated);
    }
}
