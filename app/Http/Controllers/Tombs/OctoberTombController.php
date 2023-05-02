<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Region;
use App\Models\OctoberTomb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


class OctoberTombController extends Controller
{
    public function index()
    {
        $region = Region::where('name', '6 أكتوبر')->firstOrFail();
        $tombs = $region->tombs;
        return view('المقابر.أكتوبر.index', compact('region', 'tombs'));
    }
}
