<?php

namespace App\Http\Controllers;

use App\Models\BankTransactions;
use App\Models\KfalaBank;
use App\Models\KfalaSafe;
use Illuminate\Http\Request;
use App\Models\KfalaTransaction;
use App\Models\TotalKfalaSafe;

class KfalaSafeController extends Controller
{
    public function bankWithDraw(Request $request)
    {
        $kfalaTotalSafe = TotalKfalaSafe::findOrFail(1);
        $kfalaBank = KfalaBank::findOrFail(1);
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'proof_img' => 'required|image|mimes:png,jpg,webp,jpeg,|max:2048'
        ]);
        if ($validated['amount'] > $kfalaTotalSafe->amount) {
            return back()->withErrors(['amount' => 'المبلغ الذي أدخلته غير متوفر. الرجاء إدخال مبلغ أقل والمحاولة مرة أخرى.',]);
        } else {
            if ($request->hasFile('proof_img')) {
                $imagefile = $request->file('proof_img');
                $imagename = time() . '.' . $imagefile->getClientOriginalExtension();
                $destinationPath = public_path('assets/backend/files/cases/imgs/safe_reports');
                $imagefile->move($destinationPath, $imagename);
                $store = KfalaTransaction::create([
                    'proof_img' => $imagename,
                    'amount' => $validated['amount'],
                    'transaction_type' => 'خزينة/سحب',
                    'donation_type' => null
                ]);
                if ($store) {
                    BankTransactions::create([
                        'transaction_type' => 'بنك/إيداع',
                        'amount' => $validated['amount'],
                        'proof_img' => $imagename,
                    ]);
                    $newSafe = $kfalaTotalSafe->amount - $validated['amount'];
                    $kfalaTotalSafe->update(['amount' => $newSafe]);
                    $newBank = $kfalaBank->amount + $validated['amount'];
                    $kfalaBank->update(['amount' => $newBank]);
                    return back()->withSuccess('تم السحب');
                }
            } else {
                return back()->withErrors(['proof_img' => 'الرجاء اختيار صورة.']);
            }
        }
        return back()->withErrors($validated);
    }

    public function index(Request $request)
    {
        $response = $this->safeReports($request);
        $totalSafe = TotalKfalaSafe::findOrFail(1);
        $sumSafe = $totalSafe->amount;
        return view("reports.safe", compact('response', 'sumSafe'));
    }

    public function safeReports(Request $request)
    {
        $month = $request->input('date');
        $transactions = KfalaTransaction::query();
        if ($month) {
            $transactions->whereYear('created_at', '=', date('Y', strtotime($month)))->whereMonth('created_at', '=', date('m', strtotime($month)));
        }
        return $transactions->get();
    }
}
