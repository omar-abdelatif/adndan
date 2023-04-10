<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;

class DonatorController extends Controller
{
    public function index()
    {
        $donator = Donator::all();
        return view('donator.index', compact('donator'));
    }
}
