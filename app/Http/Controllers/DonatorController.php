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
            'amount' => 'required|numeric',
            'duration' => 'required|in:1month,3month,6month,annually,other'
        ]);
        $store = Donator::create([
            'name' => $request->name,
            'mobile_phone' => $request->mobile_phone,
            'amount' => $request->amount,
            'duration' => $request->duration
        ]);
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
    public function history($id)
    {
        $history = Donator::find($id);
        return view('donator.history', compact('history'));
    }
    public function update(Request $request)
    {
        $donator = Donator::find($request->id);
        $donator->name = $request->name;
        $donator->mobile_phone = $request->mobile_phone;
        $donator->amount = $request->amount;
        $donator->duration = $request->duration;
        $update = $donator->save();
        if ($update) {
            return redirect()->route('donator.index')->with('success', 'تم التعديل بنجاح');
        }
        return redirect()->route('donator.index')->withErrors('خطأ أثناء التحديث');
    }
}
