<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VillageDeceaseds;

class VillageController extends Controller
{
    public function index(){
        $region = Region::where('name', 'القرية')->firstOrFail();
        $village = VillageDeceaseds::all();
        return view('المقابر.village.village', compact('region', 'village'));
    }
    public function createVillageDeceased(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'gender' => 'required',
            'death_place' => 'required|string',
            'death_date' => 'required',
            'burial_date' => 'required'
        ]);
        if ($validated) {
            $store = VillageDeceaseds::create($validated);
            if ($store) {
                return redirect()->back()->withSuccess('تمت الإضافة بنجاح');
            }
            return redirect()->back()->withErrors($validated);
        }
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $village = VillageDeceaseds::find($id);
        if ($village) {
            $update = $village->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'death_place' => $request->death_place,
                'death_date' => $request->death_date,
                'burial_date' => $request->burial_date,
            ]);
            if ($update) {
                return redirect()->back()->withSuccess('تم التحديث بنجاح');
            }
            return redirect()->back()->withErrors("حدث خطأ أثناء التحديث");
        }
    }
    public function delete($id)
    {
        $village = VillageDeceaseds::find($id);
        if ($village) {
            $delete = $village->delete();
            if ($delete) {
                return redirect()->back()->withSuccess("تم الحذف بنجاح");
            }
            return redirect()->back()->withErrors("حدث خطأ أثناء الحذف");
        }
    }
}
