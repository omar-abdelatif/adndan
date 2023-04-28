<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use Illuminate\Http\Request;

class TombsController extends Controller
{
    public function index()
    {
        return view('المقابر.index');
    }
}
