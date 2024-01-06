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
    public function AddNew()
    {
        return view('donator.addnew');
    }
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'mobile_phone' => 'required|numeric',
            'duration' => 'required|string',
            'other_duration' => 'string'
        ]);
        $store = Donator::create($validator);
        if ($store) {
            return redirect()->route('donator.index')->with('success', 'تم الإضافة بنجاح');
        }
        return redirect()->route('donator.addnew')->withErrors($validator);
    }
    public function destroy($id)
    {
        $donator = Donator::find($id);
        if ($donator) {
            $donator->delete();
            return redirect()->route('donator.index')->with('success', 'تم الحذف بنجاح');
        }
        return redirect()->route('donator.index')->withErrors('حدث خطأ أثناء الحذف');
    }
    public function edit($id)
    {
        $donate = Donator::find($id);
        if ($donate) {
            return view('donator.edit', compact('donate'));
        }
    }
    public function update(Request $request)
    {
        $donator = Donator::find($request->id);
        if ($donator) {
            $update = $donator->update($request->all());
            if ($update) {
                return redirect()->route('donator.index')->with('success', 'تم التعديل بنجاح');
            }
        }
        return redirect()->route('donator.index')->withErrors('خطأ أثناء التحديث');
    }
}
