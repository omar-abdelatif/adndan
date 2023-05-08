<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
use App\Models\OctoberTomb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OctoberTombController extends Controller
{
    public function index(Request $request)
    {
        $region = Region::where('name', 'أكتوبر')->first();
        $tombs = $region->tombs;
        $tombRooms = [];
        foreach ($tombs as $tomb) {
            $rooms = $tomb->rooms;
            $tombRooms[$tomb->id] = $rooms;
        }
        return view('المقابر.أكتوبر.index', compact('region', 'tombs', 'tombRooms'));
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
            return redirect()->route('october.index')->with('success', 'تمت تحديث المقبرة بنجاح.');
        }
        return redirect()->route('october.index')->withErrors($validated);
    }
    public function destroyTomb($id)
    {
        $tomb = Tomb::find($id);
        if ($tomb) {
            $tomb->delete();
            return redirect()->route('october.index')->with('success', 'تمت حذف المقبرة بنجاح.');
        }
        return redirect()->route('october.index')->withErrors('خطأ أثناء الحذف');
    }
    public function showRooms($tombId)
    {
        $tombRoom = Tomb::firstOrFail($tombId);
        $rooms = $tombRoom->rooms;
        return view('المقابر.أكتوبر.index', compact('tombRoom', 'rooms'));
    }
}
