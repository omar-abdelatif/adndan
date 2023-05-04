<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Tomb;
use Illuminate\Http\Request;
use PHPUnit\Framework\Assert;

class TombsController extends Controller
{
    public function AllTombs()
    {
        $tomb = Tomb::all();
        $region = Region::all();
        $regionCount = Region::count();
        return view('المقابر.alltombs', compact('tomb', 'region', 'regionCount'));
    }
    public function AllRooms()
    {
        $region = Region::all();
        $tomb = Tomb::all();
        return view('المقابر.addtomb', compact('tomb', 'region'));
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
            $tomb = new Tomb;
            $tomb->name = $request->name;
            $tomb->power = $request->power;
            $tomb->region = $request->region;
            $tomb->type = $request->type;
            $tomb->annual_cost = $request->annual_cost;
            $tomb->region_id = $region->id;
            $store = $tomb->save();
        }
        if ($store) {
            $tomb->createRooms();
            $rooms = $tomb->rooms;
            Assert::assertCount($request->power, $rooms);
            return redirect()->route('tombs.all')->with('success', 'تمت الإضافة بنجاح');
        }
        return redirect()->route('tombs.all')->withErrors($validated);
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
            return redirect()->route('tombs.all')->with('success', 'تمت تحديث المقبرة بنجاح.');
        }
        return redirect()->route('tombs.all')->withErrors($validated);
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
