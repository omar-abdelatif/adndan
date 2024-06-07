<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VillageController extends Controller
{
    public function index(){
        $region = Region::where('name', 'القرية')->firstOrFail();
        return view('المقابر.village.village', compact('region'));
    }
}
