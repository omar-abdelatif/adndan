<?php

namespace App\Http\Controllers\Tombs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZenhomTombController extends Controller
{
    public function index()
    {
        return view('المقابر.زينهم.index');
    }
}
