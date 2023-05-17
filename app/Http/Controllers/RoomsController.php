<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
// use App\Models\Deceased;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index($roomId)
    {
        $room = Rooms::find($roomId);
        dd($room->updateTombsRoomsBurialDates());
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms', 'room'));
    }
    public function getRooms(Request $request)
    {
        $tomb = Tomb::where('name', $request->input('name'))->first();
        $rooms = Rooms::select('name')->where('tomb_id', $tomb->id)->get();
        return response()->json($rooms);
    }
}
