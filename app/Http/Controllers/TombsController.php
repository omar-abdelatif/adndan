<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
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
            'power' => 'required',
            'type' => 'required|string|in:لحد,عيون',
            'tomb_specifices' => 'required',
            'other_tomb_power' => 'numeric',
            'annual_cost' => 'required|numeric',
            'region' => 'required|string'
        ]);
        $region = Region::where('name', $validated['region'])->first();
        if ($region) {
            $tomb = new Tomb;
            $tomb->name = $request->name;
            $tomb->power = (int) $request->power;
            if ($tomb->power === 0) {
                $tomb->power = 0;
            } else {
                $tomb->power = (int) $request->power;
            }
            $tomb->other_tomb_power = $request->other_tomb_power;
            $tomb->region = $request->region;
            $tomb->type = $request->type;
            $tomb->tomb_specifices = $request->tomb_specifices;
            $tomb->annual_cost = (int) $request->annual_cost;
            $tomb->region_id = $region->id;
            $store = $tomb->save();
        }
        if ($store) {
            $tomb->createRooms();
            $tomb->refresh();
            $rooms = $tomb->rooms;
            $expectedRoomCount = $tomb->type === "لحد" ? $tomb->other_tomb_power : $tomb->power;
            if ($rooms->count() == $expectedRoomCount) {
                return redirect()->back()->withSuccess('تمت الإضافة بنجاح');
            } else {
                return redirect()->back()->withErrors($validated);
            }
        }
        return redirect()->back()->withErrors($validated);
    }
    public function updateTomb(Request $request)
    {
        $tomb = Tomb::findOrFail($request->id);
        $tomb->update($request->all());
        return redirect()->route('tombs.all')->withSuccess('تمت تحديث المقبرة بنجاح.');
    }
    public function deleteTomb($id)
    {
        $tomb = Tomb::find($id);
        if ($tomb) {
            $rooms = Rooms::where('tomb_id', $tomb->id)->get();
            foreach ($rooms as $room) {
                Deceased::where('rooms_id', $room->id)->delete();
                $room->delete();
            }
            $tomb->delete();
            return redirect()->back()->with('success', 'تمت حذف المقبرة بنجاح.');
        }
        return redirect()->back()->withErrors('خطأ أثناء الحذف');
    }
    public function getTombs(Request $request)
    {
        $region = Region::where('name', $request->input('name'))->first();
        $tombs = Tomb::where('region_id', $region->id)->get();
        return response()->json($tombs);
    }
}
