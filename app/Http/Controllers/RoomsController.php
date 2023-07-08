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
        if ($tomb) {
            $rooms = $tomb->rooms()->get();
            return response()->json($rooms);
        }
        return response()->json([]);
    }
}
