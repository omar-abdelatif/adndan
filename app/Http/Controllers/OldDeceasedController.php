<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\OldDeceasedImport;
use App\Models\OldDeceased;
use App\Models\Region;
use Maatwebsite\Excel\Facades\Excel;

class OldDeceasedController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        $oldDeceased = OldDeceased::all();
        return view('المقابر.deceased.old', compact('oldDeceased', 'regions'));
    }
    public function importDeceased(Request $request)
    {
        Excel::import(new OldDeceasedImport, $request->file('excel'));
        return redirect()->route('old.index')->with('success', 'تم الإسترداد بنجاح');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'burial_date' => 'required|date',
            'death_date' => 'required|date',
            'region' => 'required|string',
            'tomb' => 'required|string'
        ]);
        $oldDeceased = OldDeceased::create($validated);
        if ($oldDeceased) {
            return redirect()->route('old.index')->with('success', 'تم الإضافة بنجاح');
        }
        return redirect()->route('old.index')->withErrors($validated);
    }
}
