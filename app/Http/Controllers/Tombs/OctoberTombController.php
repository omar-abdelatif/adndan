<?php

namespace App\Http\Controllers\Tombs;

use App\Models\Tomb;
use App\Models\Rooms;
use App\Models\Region;
use App\Models\Deceased;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OctoberTombController extends Controller
{
    public function index(Request $request)
    {
        $region = Region::where('name', 'أكتوبر')->first();
        $tombs = $region->tombs;
        $tombRooms = [];
        foreach ($tombs as $tomb) {
            $rooms = $tomb->rooms;
            $tombRooms[$tomb->id] = $rooms;
        }
        return view('المقابر.أكتوبر.index', compact('region', 'tombs', 'tombRooms', 'rooms'));
    }
    public function updateTomb(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'power' => 'required|numeric',
            'type' => 'required|string|in:لحد,عيون',
            'annual_cost' => 'required|numeric',
            'region' => 'required|string|in:أكتوبر,الغفير,القطامية,الفيوم,زينهم,مايو'
        ]);
        $tomb = Tomb::find($request->id);
        if ($tomb) {
            $tomb->update($validated);
            return redirect()->route('october.index')->with('success', 'تمت تحديث المقبرة بنجاح.');
        }
        return redirect()->route('october.index')->withErrors($validated);
    }
    public function destroyTomb($id)
    {
        $tomb = Tomb::find($id);
        if ($tomb) {
            $tomb->delete();
            return redirect()->route('october.index')->with('success', 'تمت حذف المقبرة بنجاح.');
        }
        return redirect()->route('october.index')->withErrors('خطأ أثناء الحذف');
    }
    public function deleteDeceased($id)
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
            return redirect()->route('october.index')->with('تم الحذف بنجاح');
        }
        return redirect()->route('october.index')->withErrors('خطأ أثناء الحذف');
    }
    public function showRoom($tombId, $roomId)
    {
        $region = Region::where('name', 'أكتوبر')->firstOrFail();
        $tomb = Tomb::findOrFail($tombId);
        $room = Rooms::findOrFail($roomId);
        $deceased = Deceased::where('room', $room->name)->get();
        $tombName = $tomb->name;
        return view('المقابر.أكتوبر.room', compact('region', 'room', 'deceased', 'tombName'));
    }
    public function updateDeceased(Request $request)
    {
        $deceased = Deceased::find($request->id);
        $room = Rooms::where('name', $request->room)->first();
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
            $deceased->death_place = $request->death_place;
            $deceased->death_date = $request->death_date;
            $deceased->burial_date = $request->burial_date;
            $deceased->washer = $request->washer;
            $deceased->carrier = $request->carrier;
            $deceased->region = $request->region;
            $deceased->tomb = $request->tomb;
            $deceased->notes = $request->notes;
            $deceased->rooms_id = $room->id;
            $update = $deceased->save();
            if ($update) {
                return redirect()->route('october.index')->with('success', 'تم التعديل بنجاح');
            }
        }
        return redirect()->route('october.index')->withErrors('حدث خطأ أثناء التحديث');
    }
}
