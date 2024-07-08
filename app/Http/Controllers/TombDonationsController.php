<?php

namespace App\Http\Controllers;

use App\Models\TombSafe;
use Illuminate\Http\Request;
use App\Models\TombDonations;
use App\Models\TombTotalSafe;
use App\Models\NewTombDonators;

class TombDonationsController extends Controller
{
    public function index(){
        $tombDonators = NewTombDonators::all();
        return view('المقابر.donations.index', compact('tombDonators'));
    }
    public function storeDonators(Request $request){
        $validations = $request->validate([
            'name' => 'required|string',
            'mobile_number' => 'required|numeric',
            'donator_type' => 'required',
            'donator_duration' => 'nullable'
        ]);
        $store = NewTombDonators::create($validations);
        if ($store) {
            return redirect()->back()->withSuccess('تم التسجيل بنجاح');
        } else {
            return redirect()->back()->withErrors($validations);
        }
    }
    public function updateDonators(Request $request){
        $id = $request->id;
        $donator = NewTombDonators::find($id);
        if($donator){
            $update = $donator->update([
                'name' => $request->name,
                'mobile_number' => $request->mobile_number,
                'donator_type' => $request->donator_type,
                'donator_duration' => $request->donator_duration,
            ]);
            if($update){
                return redirect()->back()->withSuccess('تم التحديث بنجاح');
            }
            return redirect()->back()->withErrors("حدث خطأ أثناء التحديث");
        }
    }
    public function deleteDonators($id){
        $donator = NewTombDonators::find($id);
        if($donator){
            $delete = $donator->delete();
            if($delete){
                return back()->withSuccess("تم الحذف بنجاح");
            }
        }
    }
    public function tombDonatorHistory($id){
        $donator = NewTombDonators::find($id);
        $donations = $donator->tombdonations;
        return view('المقابر.donations.donation_history', compact('donator', 'donations'));
    }
    public function donationStore(Request $request)
    {
        $tombSafe = TombTotalSafe::findOrFail(1);
        $validations = $request->validate([
            'name' => 'required',
            'mobile_no' => 'required',
            'donation_type' => 'required',
            'amount' => 'required',
            'invoice_no' => 'required',
        ]);
        $donator = NewTombDonators::where("mobile_number", $request->mobile_no)->first();
        $store = TombDonations::create([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'donation_type' => $request->donation_type,
            'donation_duration' => $request->donation_duration,
            'amount' => $request->amount,
            'invoice_no' => $request->invoice_no,
            'new_tomb_donators_id' => $donator->id,
        ]);
        if ($store) {
            TombSafe::create([
                'transaction_type' => $request->donation_type,
                'amount' => $validations['amount'],
                'proof_img' => $request->invoice_no
            ]);
            $newAmount = $tombSafe->amount + $validations['amount'];
            $tombSafe->update(['amount' => $newAmount]);
            return redirect()->back()->withSuccess('تم التسجيل بنجاح');
        }
        return redirect()->back()->withErrors($validations);
    }
    public function donationUpdate(Request $request)
    {
        $id = $request->id;
        $donation = TombDonations::find($id);
        if ($donation) {
            $update = $donation->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'donation_type' => $request->donation_type,
                'donation_duration' => $request->donation_duration,
                'amount' => $request->amount,
                'invoice_no' => $request->invoice_no,
            ]);
            if ($update) {
                return redirect()->back()->withSuccess('تم التعديل بنجاح');
            }
            return redirect()->back()->withErrors('حدث خطأ جرب مره أخرى');
        }
    }
    public function donationDelete($id)
    {
        $donation = TombDonations::find($id);
        if ($donation) {
            $delete = $donation->delete();
            if ($delete) {
                return redirect()->back()->withSuccess('تم الحذف بنجاح');
            }
            return redirect()->back()->withErrors('حدث خطأ جرب مره أخرى');
        }
    }
}
