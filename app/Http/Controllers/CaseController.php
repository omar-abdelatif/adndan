<?php

namespace App\Http\Controllers;

use App\Models\TableCase;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;

class CaseController extends Controller
{
    public function viewData()
    {
        $date = Carbon::now();
        $fullDate = $date->format('l jS F Y');
        $data = TableCase::all();
        $count = TableCase::count();
        return view('home', compact('data', 'count', 'fullDate'));
    }
    public function ShowCase()
    {
        $all = TableCase::all();
        $countall = TableCase::count();
        return view('الكفالة.showall', compact('countall'));
    }
    public function storecase(Request $request)
    {
        //! Validations
        $request->validate([
            'fullname' => 'required|min:3',
            'ssn' => 'required|unique:table_case,ssn',
            'phone_number' => 'required|unique:table_case,phone_number',
            'age' => 'required',
            'address' => 'required',
            'monthly_income' => 'required|numeric',
            'income_type' => 'required|in:retire,without,other',
            'benefit_type' => 'required|in:money,food, monthly, seasonal',
            'marital_status' => 'required|in:single,married,widow,divorced',
            'health_status' => 'required',
            'gov' => 'required',
            'sons' => 'required',
            'daughters' => 'required',
            'files' => 'image|max:2028|mimes:jpg,png,jpeg,webp',
        ]);
        if ($request->hasFile('files')) {
            $upload = $request->file('files');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('build/assets/backend/files');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('files')) {
            $name = 'download.png';
        }
        $store = TableCase::create([
            'fullname' => $request->fullname,
            'ssn' => $request->ssn,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'address' => $request->address,
            'monthly_income' => $request->monthly_income,
            'income_type' => $request->income_type,
            'benefit_type' => $request->benefit_type,
            'marital_status' => $request->marital_status,
            'health_status' => $request->health_status,
            'gov' => $request->gov,
            'sons' => $request->sons,
            'daughters' => $request->daughters,
            'files' => $name,
        ]);
        if ($store) {
            return redirect()->route('home')->with('success', 'تمت الإضافة بنجاح');
        }
        return redirect()->route('addnew')->withErrors($request->validate());
    }
    public function delete($id)
    {
        $case = TableCase::find($id);
        if ($case) {
            if ($case->files !== null) {
                $oldPath = public_path('build/assets/backend/files/' . $case->files);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $case->delete();
            return redirect()->route('home')->with('success', 'تم حذف بيانات المستخدم بنجاح');
        }
        return redirect()->route('home')->withErrors('error', 'خطأ في الخذف');
    }
    public function updatecase(Request $request)
    {
        $case = TableCase::find($request->id);
        //! Delete Old Image
        if ($request->hasFile('files') && $case->files !== null) {
            $oldImagePath = public_path('build/assets/backend/files/' . $case->files);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        //! Insert New Image
        if ($request->hasFile('files') && $request->file('files')->isValid()) {
            $uploadFile = $request->file('files');
            $name = time() . '.' . $uploadFile->getClientOriginalExtension();
            $destinationPath = public_path('build/assets/backend/files');
            $uploadFile->move($destinationPath, $name);
            $case->files = $name;
        }
        //! Update User Data
        $case->fullname = $request->fullname;
        $case->ssn = $request->ssn;
        $case->phone_number = $request->phone_number;
        $case->age = $request->age;
        $case->address = $request->address;
        $case->income_type = $request->income_type;
        $case->benefit_type = $request->benefit_type;
        $case->monthly_income = $request->monthly_income;
        $case->marital_status = $request->marital_status;
        $case->health_status = $request->health_status;
        $case->gov = $request->gov;
        $case->sons = $request->sons;
        $case->daughters = $request->daughters;
        $update = $case->save();
        if ($update) {
            return redirect('home')->with('success', 'تم تعديل الحالة بنجاح');
        }
        return redirect('home')->withErrors('حدث خطأ في المدخلات');
    }
    public function importExcel(Request $request)
    {
        Excel::import(new UserImport, $request->file('excel'));
        return redirect()->route('home')->with('success', 'تم الإسترداد بنجاح');
    }
}
