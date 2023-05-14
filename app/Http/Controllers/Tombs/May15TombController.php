<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
use App\Models\Deceased;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class May15TombController extends Controller
{
    public function index()
    {
        $region = Region::where('name', 'مايو')->firstOrFail();
        $tombs = $region->tombs;
        return view('المقابر.15-مايو.index', compact('region', 'tombs'));
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
            return redirect()->route('15may.index')->with('success', 'تمت تحديث المقبرة بنجاح.');
        }
        return redirect()->route('15may.index')->withErrors($validated);
    }
    public function destroyTomb($id)
    {
        $tomb = Tomb::find($id);
        if ($tomb) {
            $tomb->delete();
            return redirect()->route('15may.index')->with('success', 'تمت حذف المقبرة بنجاح.');
        }
        return redirect()->route('15may.index')->withErrors('خطأ أثناء الحذف');
    }
    public function showRoom($tombId, $roomId)
    {
        $region = Region::where('name', 'مايو')->firstOrFail();
        $tomb = Tomb::findOrFail($tombId);
        $room = Rooms::findOrFail($roomId);
        $deceased = Deceased::where('room', $room->name)->get();
        $tombName = $tomb->name;
        return view('المقابر.مايو.room', compact('region', 'room', 'deceased', 'tombName'));
    }
}
