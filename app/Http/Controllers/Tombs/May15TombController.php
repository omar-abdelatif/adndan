<?php

namespace App\Http\Controllers\Tombs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class May15TombController extends Controller
{
    public function index()
    {
        return view('المقابر.15-مايو.index');
    }
}
