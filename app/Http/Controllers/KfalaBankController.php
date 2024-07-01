<?php

namespace App\Http\Controllers;

use App\Models\BankTransactions;
use App\Models\KfalaBank;
use Illuminate\Http\Request;
use App\Models\KfalaTransaction;
use App\Models\TotalKfalaSafe;

class KfalaBankController extends Controller
{
    public function index()
    {
        $safe = KfalaBank::where('id', 1)->first();
        $transactions = BankTransactions::get();
        $sumBank = $safe->amount;
        return view('reports.bank', compact('sumBank', 'transactions'));
    }
    public function bankDeposit(Request $request)
    {
        $kfalaSafe = TotalKfalaSafe::findOrFail(1);
        $kfalaBank = KfalaBank::findOrFail(1);
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'proof_img' => 'required|image|mimes:png,jpg,webp,jpeg,|max:2048'
        ]);
        if ($validated['amount'] > $kfalaSafe->amount) {
            return back()->withErrors(['amount' => 'المبلغ الذي أدخلته غير متوفر. الرجاء إدخال مبلغ أقل والمحاولة مرة أخرى.',]);
        } else {
            if ($request->hasFile('proof_img')) {
                $imagefile = $request->file('proof_img');
                $imagename = time() . '.' . $imagefile->getClientOriginalExtension();
                $destinationPath = public_path('assets/backend/files/cases/imgs/safe_reports');
                $imagefile->move($destinationPath, $imagename);
                $store = BankTransactions::create([
                    'proof_img' => $imagename,
                    'amount' => $validated['amount'],
                    'transaction_type' => 'بنك/سحب',
                ]);
                if ($store) {
                    $newBank = $kfalaBank->amount - $validated['amount'];
                    $kfalaBank->update(['amount' => $newBank]);
                    $newAmount = $validated['amount'] + $kfalaSafe->amount;
                    $kfalaSafe->update(['amount' => $newAmount]);
                    $store = KfalaTransaction::create([
                        'proof_img' => $imagename,
                        'amount' => $validated['amount'],
                        'transaction_type' => 'خزينة/ايداع',
                    ]);
                    return back()->withSuccess('تم السحب');
                }
            } else {
                return back()->withErrors(['proof_img' => 'الرجاء اختيار صورة.']);
            }
        }
        return back()->withErrors($validated);
    }
}
