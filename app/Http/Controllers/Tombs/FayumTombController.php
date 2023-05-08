<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FayumTombController extends Controller
{
    public function index()
    {
        $region = Region::where('name', 'الفيوم')->firstOrFail();
        $tombs = $region->tombs;
        return view('المقابر.الفيوم.index', compact('region', 'tombs'));
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
            return redirect()->route('fayum.index')->with('success', 'تمت تحديث المقبرة بنجاح.');
        }
        return redirect()->route('fayum.index')->withErrors($validated);
    }
    public function destroyTomb($id)
    {
        $tomb = Tomb::find($id);
        if ($tomb) {
            $tomb->delete();
            return redirect()->route('fayum.index')->with('success', 'تمت حذف المقبرة بنجاح.');
        }
        return redirect()->route('fayum.index')->withErrors('خطأ أثناء الحذف');
    }
}
