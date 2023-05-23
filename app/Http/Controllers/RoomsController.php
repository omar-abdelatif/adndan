<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
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
        $rooms = Rooms::where('tomb_id', $tomb->id)->withCount('deceased')->get();
        return response()->json($rooms);
    }


    // public function isDisabled($room)
    // {
    //     $deceasedcount = Deceased::where('room_id', $room->id)->count();
    //     $true = $deceasedcount == $room->capacity ? 'disabled' : '';
    //     return $true;
    // }
}
