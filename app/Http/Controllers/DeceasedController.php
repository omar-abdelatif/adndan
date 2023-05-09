<?php

namespace App\Http\Controllers;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
use App\Models\Deceased;
use Illuminate\Http\Request;

class DeceasedController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        $deceased = Deceased::all();
        return view('المقابر.deceased.index', compact('deceased', 'regions'));
    }
    public function addnew()
    {
        $regions = Region::all();
        return view('المقابر.deceased.addnew', compact('regions'));
    }
    public function storeDeceased(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'death_place' => 'required|string',
            'death_date' => 'required|date',
            'burial_date' => 'required|date',
            'washer' => 'required|string',
            'carrier' => 'required|string',
            'region' => 'required|string',
            'tomb' => 'required|string',
            'room' => 'required|string',
            'notes' => 'nullable',
            'files.*' => 'required|mimes:pdf,png,jpg,jpeg,webp|max:3072',
        ]);
        $room = Rooms::where('name', $validated['room'])->first();
        if ($room) {
            $deceased = new Deceased();
            $deceased->name = $validated['name'];
            $deceased->death_place = $validated['death_place'];
            $deceased->death_date = $validated['death_date'];
            $deceased->burial_date = $validated['burial_date'];
            $deceased->washer = $validated['washer'];
            $deceased->carrier = $validated['carrier'];
            $deceased->region = $validated['region'];
            $deceased->tomb = $validated['tomb'];
            $deceased->room = $validated['room'];
            $deceased->notes = $validated['notes'];
            $names = [];
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('build/assets/backend/files/tombs/imgs/');
                $file->move($destinationPath, $name);
            }
            if ($request->hasFile('pdf_files')) {
                $files = $request->file('pdf_files');
                $file_name = time() . '.' . $files->getClientOriginalExtension();
                $Path = public_path('build/assets/backend/files/tombs/pdf/');
                $files->move($Path, $file_name);
            }
            $deceased->files = $name;
            $deceased->pdf_files = $file_name;
            $deceased->rooms_id = $room->id;
            $store = $deceased->save();
            if ($store) {
                return redirect()->route('deceased.index')->with('success', 'تمت الإضافة بنجاح');
            }
        }
        return redirect()->route('deceased.index')->with('error', $validated);
    }
    public function destroy($id)
    {
        $deceased = Deceased::find($id);
        if ($deceased) {
            $deceased->delete();
            return redirect()->route('deceased.index')->with('success', 'تم الحذف بنجاح');
        }
        return redirect()->route('deceased.index')->withErrors('حدث خطأ أثناء الحذف');
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'death_place' => 'required|string',
            'death_date' => 'required|date',
            'burial_date' => 'required|date',
            'washer' => 'required|string',
            'carrier' => 'required|string',
            'region' => 'required|string',
            'tomb' => 'required|string',
            'room' => 'required|string',
            'notes' => 'nullable',
            'files.*' => 'required|mimes:pdf,png,jpg,jpeg,webp|max:3072',
        ]);
        $deceased = Deceased::find($request->id);
        if ($deceased) {
            if ($request->hasFile('files') && $request->file('files')->isValid()) {
                $uploadFile = $request->file('files');
                $name = time() . '.' . $uploadFile->getClientOriginalExtension();
                $destinationPath = public_path('build/assets/backend/files/tombs/imgs/');
                $uploadFile->move($destinationPath, $name);
            }
            if ($request->hasFile('pdf_files')) {
                $files = $request->file('pdf_files');
                $file_name = time() . '.' . $files->getClientOriginalExtension();
                $Path = public_path('build/assets/backend/files/tombs/pdf/');
                $files->move($Path, $file_name);
            }
            $store = $deceased->update([
                'name' => $validated['name'],
                'death_place' => $validated['death_place'],
                'death_date' => $validated['death_date'],
                'burial_date' => $validated['burial_date'],
                'washer' => $validated['washer'],
                'carrier' => $validated['carrier'],
                'region' => $validated['region'],
                'tomb' => $validated['tomb'],
                'room' => $validated['room'],
                'notes' => $validated['notes'],
                'files' => $name,
                'pdf_files' => $file_name
            ]);
            if ($store) {
                return redirect()->route('deceased.index')->with('success', 'تم التعديل بنجاح');
            }
            return redirect()->route('deceased.index')->withErrors($validated);
        }
    }
}
