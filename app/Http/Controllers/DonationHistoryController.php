<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;
use App\Models\DonationHistory;
use App\Models\KfalaBank;
use App\Models\KfalaSafe;
use App\Models\KfalaTransaction;
use App\Models\TotalKfalaSafe;

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
        $kfalaTotalSafe = TotalKfalaSafe::findOrFail(1);
        $validator = $request->validate([
            'name' => 'required|string',
            'mobile_phone' => 'required|numeric',
            'amount' => 'required|numeric',
            'duration' => 'required|in:يناير,فبراير,مارس,إبريل,مايو,يونيه,يوليو,أغسطس,سبتمبر,أكتوبر,نوفمبر,ديسمبر|array',
            'duration.*' => 'required|string|distinct|max:255',
            'donation_type' => 'required',
            'invoice_no' => 'required'
        ]);
        $donator = Donator::where('mobile_phone', $request->mobile_phone)->first();
        $duration = implode(',', $request->input('duration'));
        if ($donator) {
            $donation = new DonationHistory();
            $donation->name = $request->name;
            $donation->mobile_phone = $request->mobile_phone;
            $donation->amount = $request->amount;
            $donation->duration = $duration;
            $donation->invoice_no = $request->invoice_no;
            $donation->donation_type = $request->donation_type;
            $donation->other_type = $request->other_type;
            $donation->money_type = $request->money_type;
            $donation->donator_id = $donator->id;
            $store = $donation->save();
        }
        if ($store) {
            KfalaTransaction::create([
                'transaction_type' => 'تبرعات',
                'donation_type' => $donation->donation_type,
                'other_type' => $donation->other_type,
                'money_type' => $donation->money_type,
                'amount' => $donation->amount,
                'invoice_no' => $donation->invoice_no,
            ]);
            $newSafeAmount = $kfalaTotalSafe->amount + $request->amount;
            $kfalaTotalSafe->update(['amount' => $newSafeAmount]);
            return redirect()->route('donation.index', ['id' => $donator->id])->with('success', 'تم الإضافة بنجاح');
        }
        return redirect()->back()->withErrors($validator);
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
