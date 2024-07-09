<?php

namespace App\Http\Controllers;

// use Carbon\Carbon;
// use App\Models\Report;
use App\Models\TableCase;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CaseController extends Controller
{
    public function viewData()
    {
        $data = TableCase::all();
        $countall = TableCase::count();
        return view('الكفالة.showall', compact('data', 'countall'));
    }
    public function storecase(Request $request)
    {
        //! Validations
        $validation = $request->validate([
            'fullname'              => 'required|min:3',
            'ssn'                   => 'required|unique:table_case,ssn',
            'phone_number'              => 'unique:table_case,phone_number',
            'age'                   => 'required',
            'address'               => 'required',
            'monthly_income'        => 'required|numeric',
            'another_source'        => 'required|numeric',
            'income_type'           => 'required',
            'benefit_type'          => 'required',
            'benefit_duration'      => 'required',
            'marital_status'        => 'required',
            'retire_income'         => 'required|numeric',
            'total_income'          => 'required|numeric',
            'health_status'         => 'required',
            'gov'                   => 'required',
            'sons'                  => 'required',
            'daughters'             => 'required',
            'imgs'                 => 'image|max:2028|mimes:jpg,png,jpeg,webp',
        ]);
        if ($request->hasFile('imgs')) {
            $upload = $request->file('imgs');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('build/assets/backend/files');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('imgs')) {
            $name = 'download.png';
        }
        $store = TableCase::create([
            'fullname' => $request->fullname,
            'ssn' => $request->ssn,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'address' => $request->address,
            'monthly_income' => $request->monthly_income,
            'another_source' => $request->another_source,
            'income_type' => $request->income_type,
            'benefit_type' => $request->benefit_type,
            'benefit_duration' => $request->benefit_duration,
            'marital_status' => $request->marital_status,
            'retire_income' => $request->retire_income,
            'total_income' => $request->total_income,
            'health_status' => $request->health_status,
            'gov' => $request->gov,
            'sons' => $request->sons,
            'daughters' => $request->daughters,
            'imgs' => $name,
        ]);
        if ($store) {
            return redirect()->route('showall')->with('success', 'تمت الإضافة بنجاح');
        }
        return redirect()->route('showall')->withErrors($validation);
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
            return redirect()->route('showall')->with('success', 'تم حذف بيانات المستخدم بنجاح');
        }
        return redirect()->route('showall')->withErrors('error', 'خطأ في الخذف');
    }
    public function updatecase(Request $request)
    {
        $case = TableCase::find($request->id);
        //! Delete Old Image
        if ($request->hasFile('imgs') && $case->imgs !== null) {
            $oldImagePath = public_path('build/assets/backend/files/' . $case->imgs);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        //! Insert New Image
        if ($request->hasFile('imgs') && $request->file('imgs')->isValid()) {
            $uploadFile = $request->file('imgs');
            $name = time() . '.' . $uploadFile->getClientOriginalExtension();
            $destinationPath = public_path('build/assets/backend/files');
            $uploadFile->move($destinationPath, $name);
            $case->imgs = $name;
        }
        //! Update User Data
        $case->fullname = $request->fullname;
        $case->ssn = $request->ssn;
        $case->phone_number = $request->phone_number;
        $case->age = $request->age;
        $case->address = $request->address;
        $case->income_type = $request->income_type;
        $case->benefit_type = $request->benefit_type;
        $case->benefit_duration = $request->benefit_duration;
        $case->monthly_income = $request->monthly_income;
        $case->another_source = $request->another_source;
        $case->retire_income = $request->retire_income;
        $case->total_income = $request->total_income;
        $case->marital_status = $request->marital_status;
        $case->health_status = $request->health_status;
        $case->gov = $request->gov;
        $case->sons = $request->sons;
        $case->daughters = $request->daughters;
        $update = $case->save();
        if ($update) {
            return redirect()->route('showall')->with('success', 'تم تعديل الحالة بنجاح');
        }
        return redirect()->route('showall')->withErrors('حدث خطأ في المدخلات');
    }
    public function importExcel(Request $request)
    {
        Excel::import(new UserImport, $request->file('excel'));
        return redirect()->route('showall')->with('success', 'تم الإسترداد بنجاح');
    }
}
