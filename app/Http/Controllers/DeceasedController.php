<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Region;
use App\Models\Deceased;
use App\Models\Tomb;
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
            'gender' => 'required|string',
            'size' => 'required',
            'age' => 'nullable|string',
            'death_place' => 'required|string',
            'death_date' => 'required|date',
            'burial_date' => 'required|date',
            'washer' => 'required|string',
            'carrier' => 'required|string',
            'region' => 'required|string',
            'tomb' => 'required|string',
            'room' => 'required|string',
            'notes' => 'nullable',
            'files' => 'mimes:pdf,png,jpg,jpeg,webp|max:3072',
            'pdf_files' => 'mimes:pdf',
            'burial_cost' => 'required|integer'
        ]);
        $room = Rooms::where('name', $validated['room'])->first();
        $tomb = Tomb::where('id', $room->tomb_id)->first();
        if ($room) {
            $deceased = new Deceased();
            $deceased->name = $validated['name'];
            $deceased->gender = $validated['gender'];
            $deceased->size = $validated['size'];
            $deceased->age = $validated['age'];
            $deceased->death_place = $validated['death_place'];
            $deceased->death_date = $validated['death_date'];
            $deceased->burial_date = $validated['burial_date'];
            $deceased->washer = $validated['washer'];
            $deceased->carrier = $validated['carrier'];
            $deceased->region = $validated['region'];
            $deceased->tomb = $validated['tomb'];
            $deceased->room = $validated['room'];
            $deceased->notes = $validated['notes'];
            $deceased->burial_cost = $validated['burial_cost'];

            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('build/assets/backend/files/tombs/imgs/');
                $file->move($destinationPath, $name);
                $deceased->files = $name;
            }
            if ($request->hasFile('pdf_files')) {
                $files = $request->file('pdf_files');
                $file_name = time() . '.' . $files->getClientOriginalExtension();
                $Path = public_path('build/assets/backend/files/tombs/pdf/');
                $files->move($Path, $file_name);
                $deceased->pdf_files = $file_name;
            }
            $deceased->rooms_id = $room->id;
            $deceased->tombs_id = $tomb->id;
            $room = $deceased->rooms;
            $room->burial_date = $validated['burial_date'];
            if ($tomb) {
                if ($tomb->type === "لحد") {
                    $room->update(['isDisabled' => 1]);
                    $room->save();
                }
            }
            $store = $deceased->save();
            if ($store) {
                return redirect()->back()->with('success', 'تمت الإضافة بنجاح');
            }
        }
        return redirect()->back()->with('error', $validated);
    }
    public function destroy($id)
    {
        $deceased = Deceased::find($id);
        if ($deceased) {
            if ($deceased->files !== null) {
                $oldImagePath = public_path('build/assets/backend/files/tombs/imgs/' . $deceased->files);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            if ($deceased->pdf_files !== null) {
                $oldPdfPath = public_path('build/assets/backend/files/tombs/pdf/' . $deceased->pdf_files);
                if (file_exists($oldPdfPath)) {
                    unlink($oldPdfPath);
                }
            }
            $deceased->delete();
            return redirect()->route('deceased.index')->with('success', 'تم الحذف بنجاح');
        }
        return redirect()->route('deceased.index')->withErrors('حدث خطأ أثناء الحذف');
    }
    public function update(Request $request)
    {
        $deceased = Deceased::find($request->id);
        if ($deceased) {
            if ($request->hasFile('files') && $request->file('files')->isValid()) {
                $img = $request->file('files');
                $name = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = public_path('build/assets/backend/files/tombs/imgs/');
                $img->move($destinationPath, $name);
                $deceased->files = $name;
            }
            if ($request->hasFile('pdf_files') && $request->file('pdf_files')->isValid()) {
                $file = $request->file('pdf_files');
                $pdf = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('build/assets/backend/files/tombs/pdf/');
                $file->move($destinationPath, $pdf);
                $deceased->pdf_files = $pdf;
            }
            $deceased->name = $request->name;
            $deceased->gender = $request->gender;
            $deceased->size = $request->size;
            $deceased->age = $request->age;
            $deceased->death_place = $request->death_place;
            $deceased->death_date = $request->death_date;
            $deceased->burial_date = $request->burial_date;
            $deceased->washer = $request->washer;
            $deceased->carrier = $request->carrier;
            $deceased->region = $request->region;
            $deceased->tomb = $request->tomb;
            $deceased->room = $request->room;
            $deceased->notes = $request->notes;
            $deceased->burial_cost = $request->burial_cost;
            $update = $deceased->save();
            if ($update) {
                return redirect()->route('deceased.index')->with('success', 'تم التعديل بنجاح');
            }
        }
        return redirect()->route('deceased.index')->withErrors('حدث خطأ أثناء التحديث');
    }
    public function getDeceaseds(Request $request)
    {
        $roomName = $request->input('name');
        $room = Rooms::where('name', $roomName)->first();
        if ($room) {
            $sumSize = 0;
            foreach ($room->deceased as $deceased) {
                $sumSize += (int) $deceased->size;
            }
            return response()->json(['sumSize' => $sumSize]);
        } else {
            return response()->json(['sumSize' => 1000]);
        }
    }
}
