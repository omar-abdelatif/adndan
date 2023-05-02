<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Region;
use App\Models\OctoberTomb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


class OctoberTombController extends Controller
{
    public function index()
    {
        $allRegions = Region::all();
        $regionCount = Region::count();
        $region = Region::where('name', '6 أكتوبر')->firstOrFail();
        $tombs = $region->tombs;
        return view('المقابر.أكتوبر.index', compact('region', 'tombs', 'regionCount', 'allRegions'));
    }

    public function updateTomb(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'power' => 'required|numeric',
            'type' => 'required|string|in:لحد,عيون',
            'annual_cost' => 'required|numeric',
            'region' => 'required|string|in:6 أكتوبر,الغفير,القطامية,الفيوم,زينهم,15 مايو'
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
}
