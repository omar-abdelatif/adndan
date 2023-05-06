<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use App\Models\Rooms;
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
        $rooms = Rooms::select('name', 'id')->where('tomb_id', $request->id)->take(100)->get();
        return response()->json($rooms);
    }
}
