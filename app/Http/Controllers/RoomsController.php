<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\OldDeceased;
use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms'));
    }
    public function getRooms(Request $request)
    {
        $tomb = Tomb::where('name', $request->input('name'))->first();
        if ($tomb) {
            $rooms = $tomb->rooms()->get();
            return response()->json($rooms);
        }
        return response()->json([]);
    }
    public function getRoomsByTombId($id)
    {
        $rooms = Rooms::where('tomb_id', $id)->get();
        foreach ($rooms as $room) {
            $sumSize = 0;
            foreach ($room->deceased as $deceased) {
                $sumSize += (int) $deceased->size;
            }
            $room->disabled = ($sumSize === $room->capacity);
        }
        return response()->json([
            'rooms' => $rooms,
        ]);
    }
    public function getSumOfDisabledRooms(Request $request)
    {
        $tombName = $request->input('name');
        $tomb = Tomb::where('name', $tombName)->get();
        if ($tomb) {
            $sumTotal = 0;
            foreach ($tomb->rooms as $tombRoom) {
                $sumTotal += $tombRoom->power;
            }
            return response()->json($sumTotal);
        } else {
            return response()->json([]);
        }
    }
    public function moveToOldDeceased($roomId)
    {
        $room = Rooms::findOrFail($roomId);
        if ($room && $room->deceased) {
            foreach ($room->deceased as $deceased) {
                $deceasedData = [
                    'name' => $deceased->name,
                    'death_date' => $deceased->death_date,
                    'region' => $deceased->region,
                    'tomb' => $deceased->tomb,
                    'burial_date' => $deceased->burial_date,
                ];
                OldDeceased::create($deceasedData);
                $deceased->delete();
            }
            $room->update([
                'isDisabled' => 0,
                'burial_date' => null
            ]);
            return redirect()->back()->withSuccess('تم التطهير بنجاح');
        }
        return redirect()->back()->withErrors('حدث خطأ أثناء التطهير');
    }

    public function countDeceaseds()
    {
        $tombs = Tomb::all();
        $rooms = $tombs->rooms;
        $deceased = $rooms->deceased;
        $male = $deceased->where('gender', 'ذكر')->count();
        $female = $deceased->where('gender', 'أنثى')->count();
        return view("", compact('male', 'female'));
    }
}
