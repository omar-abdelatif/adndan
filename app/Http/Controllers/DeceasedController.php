<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class DeceasedController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('المقابر.deceased.index', compact('regions'));
    }
}
