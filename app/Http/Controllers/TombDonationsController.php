<?php

namespace App\Http\Controllers;

use App\Models\NewTombDonators;
use Illuminate\Http\Request;

class TombDonationsController extends Controller
{
    public function index(){
        $tombDonators = NewTombDonators::all();
        return view('المقابر.donations.index', compact('tombDonators'));
    }
    public function storeDonators(Request $request){
        $validations = $request->validate([
            'name' => 'required|string',
            'mobile_number' => 'required|integer',
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
        return view('المقابر.donations.donation_history',compact('donator'));
    }
    public function donationStore(Request $request){}
}
