<?php

namespace App\Http\Controllers\Tombs;

use App\Models\OctoberTomb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OctoberTombController extends Controller
{
    public function index()
    {
        $octoberTomb = OctoberTomb::all();
        $tombCount = OctoberTomb::count();
        return view('المقابر.أكتوبر.index', compact('octoberTomb', 'tombCount'));
    }
    public function tombStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:لحد,عيون',
            'power' => 'required|in:1,2,3,4,5,6',
            'annually_cost' => 'required|numeric'
        ]);
        $store = OctoberTomb::create([
            'name' => $request->name,
            'type' => $request->type,
            'power' => $request->power,
            'annually_cost' => $request->annually_cost
        ]);
        if ($store) {
            return redirect()->route('october.index')->with('success', 'تمت الإضافة بنجاح');
        }
        return redirect()->route('october.index')->withErrors($validate);
    }
    public function destroyTomb($id)
    {
        $october = OctoberTomb::find($id);
        if ($october) {
            $october->delete();
            return redirect()->route('october.index')->with('success', 'تم حذف البيانات بنجاح');
        }
        return redirect()->route('october.index')->withErrors('حدث خطأ أثناء الحذف');
    }
}
