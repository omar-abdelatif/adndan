<?php

namespace App\Http\Controllers\Tombs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OctoberTombController extends Controller
{
    public function index()
    {
        // $tomb = Tomb::all();
        return view('المقابر.أكتوبر.index');
    }
    
}
