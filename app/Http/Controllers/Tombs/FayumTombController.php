<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FayumTombController extends Controller
{
    public function index()
    {
        $region = Region::where('name', 'الفيوم')->firstOrFail();
        $tombs = $region->tombs;
        return view('المقابر.الفيوم.index', compact('region', 'tombs'));
    }
}
