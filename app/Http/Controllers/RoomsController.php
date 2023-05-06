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
    public function getRooms(Request $request, $tomb)
    {
        $rooms = Rooms::where('tomb_id', $tomb)->pluck('name', 'id');
        return response()->json($rooms);
    }
}
