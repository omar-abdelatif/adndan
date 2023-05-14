<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
use App\Models\Deceased;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GafeerTombController extends Controller
{
    public function index()
    {
        $region = Region::where('name', 'الغفير')->firstOrFail();
        $tombs = $region->tombs;
        return view('المقابر.الغفير.index', compact('region', 'tombs'));
    }
    public function updateTomb(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'power' => 'required|numeric',
            'type' => 'required|string|in:لحد,عيون',
            'annual_cost' => 'required|numeric',
            'region' => 'required|string|in:أكتوبر,الغفير,القطامية,الفيوم,زينهم,مايو'
        ]);
        $tomb = Tomb::find($request->id);
        if ($tomb) {
            $tomb->update($validated);
            return redirect()->route('gafeer.index')->with('success', 'تمت تحديث المقبرة بنجاح.');
        }
        return redirect()->route('gafeer.index')->withErrors($validated);
    }
    public function destroyTomb($id)
    {
        $tomb = Tomb::find($id);
        if ($tomb) {
            $tomb->delete();
            return redirect()->route('gafeer.index')->with('success', 'تمت حذف المقبرة بنجاح.');
        }
        return redirect()->route('gafeer.index')->withErrors('خطأ أثناء الحذف');
    }
    public function showRoom($tombId, $roomId)
    {
        $region = Region::where('name', 'الغفير')->firstOrFail();
        $tomb = Tomb::findOrFail($tombId);
        $room = Rooms::findOrFail($roomId);
        $deceased = Deceased::where('room', $room->name)->get();
        $tombName = $tomb->name;
        return view('المقابر.الغفير.room', compact('region', 'room', 'deceased', 'tombName'));
    }
}
