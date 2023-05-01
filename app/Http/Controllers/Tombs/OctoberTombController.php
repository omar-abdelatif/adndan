<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Region;
use App\Models\OctoberTomb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OctoberTombController extends Controller
{
    public function index($regionId)
    {
        return view('المقابر.أكتوبر.index');
    }
}
