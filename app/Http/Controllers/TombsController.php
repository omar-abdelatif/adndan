<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Tomb;
use Illuminate\Http\Request;

class TombsController extends Controller
{
    public function AllTombs()
    {
        $tomb = Tomb::all();
        $region = Region::all();
        return view('المقابر.alltombs', compact('tomb', 'region'));
    }
    public function TombForm()
    {
        $region = Region::all();
        return view('المقابر.addtomb', compact('region'));
    }
    public function addTomb(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'power' => 'required|numeric',
            'type' => 'required|string|in:لحد,عيون',
            'annual_cost' => 'required|numeric',
            'region' => 'required|string|in:6 أكتوبر,الغفير,القطامية,الفيوم,زينهم,15 مايو'
        ]);
        $region = Region::where('name', $validated['region'])->first();
        if ($region) {
            $tomb = new Tomb([
                'name' => $validated['name'],
                'power' => $validated['power'],
                'type' => $validated['type'],
                'annual_cost' => $validated['annual_cost'],
                'region' => $validated['region'],
                'region_id' => $region->id
            ]);
            $region->tombs()->save($tomb);
            return redirect()->route('tombs.all')->with('success', 'تمت إضافة المقبرة بنجاح.');
        }
        return redirect()->route('tombs.all')->withErrors('حدث خطأ أثناء الإضافة');
    }
    public function editTomb(Request $request)
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
            return redirect()->route('tomb.edit')->with('success', 'تمت تحديث المقبرة بنجاح.');
        }
        return redirect()->route('tomb.edit')->withErrors('حدث خطأ أثناء التحديث');
    }
    public function deleteTomb($id)
    {
        $tomb = Tomb::find($id);
        if ($tomb) {
            $tomb->delete();
            return redirect()->route('tombs.all')->with('success', 'تمت حذف المقبرة بنجاح.');
        }
        return redirect()->route('tombs.all')->withErrors('خطأ أثناء الحذف');
    }
}
