<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OldDeceasedController extends Controller
{
    public function index()
    {
        return view('المقابر.deceased.old');
    }
}
