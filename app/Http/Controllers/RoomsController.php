<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Tomb;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms'));
    }
}
