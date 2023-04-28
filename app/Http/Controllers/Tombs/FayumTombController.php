<?php

namespace App\Http\Controllers\Tombs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FayumTombController extends Controller
{
    public function index()
    {
        return view('المقابر.الفيوم.index');
    }
}
