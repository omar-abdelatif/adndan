<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Deceased;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        Rooms::updateBurialDates();
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms'));
    }
    public function getRooms(Request $request)
    {
        $tomb = Tomb::where('name', $request->input('name'))->first();
        $rooms = Rooms::select('name')->where('tomb_id', $tomb->id)->get();
        return response()->json($rooms);
    }
}
