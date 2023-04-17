<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;
use App\Models\DonationHistory;

class DonationHistoryController extends Controller
{
    public function index($donatorId)
    {
        $donator = Donator::find($donatorId);
        $donationHistory = $donator->donationHistory;
        return view('donation.index', compact('donator', 'donationHistory'));
    }
    public function AddNew()
    {
        return view('donation.addnew');
    }
    public function donationstore(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'mobile_phone' => 'required|numeric',
            'amount' => 'required|numeric',
            'duration' => 'required|in:يناير,فبراير,مارس,إبريل,مايو,يونيه,يوليو,أغسطس,سبتمبر,أكتوبر,نوفمبر,ديسمبر|array',
            'duration.*' => 'required|string|distinct|max:255',
        ]);
        $donator = Donator::where('mobile_phone', $request->mobile_phone)->first();
        $duration = implode(',', $request->input('duration'));
        if ($donator) {
            $donation = new DonationHistory();
            $donation->name = $request->name;
            $donation->mobile_phone = $request->mobile_phone;
            $donation->amount = $request->amount;
            $donation->duration = $duration;
            $donation->donator_id = $donator->id;
            $store = $donation->save();
        }
        if ($store) {
            return redirect()->route('donation.index', ['id' => $donator->id])->with('success', 'تم الإضافة بنجاح');
        }
        return redirect()->route('donation.addnew')->withErrors($validator);
    }
    public function destroy($id)
    {
        $donation = DonationHistory::find($id);
        if ($donation) {
            $donation->delete();
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        }
        return redirect()->back()->with('error', 'لم يتم العثور على التبرع');
    }
}
