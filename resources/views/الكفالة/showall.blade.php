@extends('layouts.app')
@section('header')
    <header class="header header-sticky d-block">
        <section class="content-header w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('showall') }}">الكفالة</a>
                                </li>
                                <li class="breadcrumb-item active">كل الحالات</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#addcase" data-coreui-whatever="@mdo">
                                <b>إضافة حالة</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="cases-title bg-info-gradient mt-5 p-3 rounded w-50 mx-auto text-center">
        <h1 class="text-white">إجمالي الحالات</h1>
    </div>
    <div class="upload-csv mt-5">
        <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"> Upload User Excel Sheet </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة مجموعة حالات</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="file" name="excel" class="form-control">
                                        <input type="submit" class="btn btn-primary mt-3 d-block w-100" height="50px" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success text-center mt-5">
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    @endif
    <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
        <thead>
            <tr>
                <td class="text-center">id</td>
                <td class="text-center">الإسم</td>
                <td class="text-center">رقم التلفون</td>
                <td class="text-center">تاريخ التسجيل</td>
                <td class="text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @if ($countall > 0)
                @foreach ($data as $case)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $case->fullname }}</td>
                        <td>{{ $case->phone_number }}</td>
                        <td>{{ $case->created_at->format('Y-m-d') }}</td>
                        <td>
                            {{-- <button type="button" style="border-radius: 40px" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#history{{$case->id}}" data-coreui-whatever="@mdo">
                                <b>History</b>
                            </button>
                            <div class="modal fade" id="history{{$case->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">بيانات الحالة كاملة</h5>
                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                                                <thead>
                                                    <tr>
                                                        <td class="text-center">id</td>
                                                        <td class="text-center">الإسم</td>
                                                        <td class="text-center">رقم التلفون</td>
                                                        <td class="text-center">تاريخ التسجيل</td>
                                                        <td class="text-center">Actions</td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <a class="btn btn-danger" style="border-radius: 40px" href='{{ url("delete/$case->id") }}'>
                                <b>حذف</b>
                            </a>
                            <button type="button" style="border-radius: 40px" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $case->id }}" data-coreui-whatever="@mdo">
                                <b>عرض</b>
                            </button>
                            <div class="modal fade" id="exampleModal{{ $case->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">بيانات الحالة كاملة</h5>
                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ 'update' }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="inputs">
                                                                <div class="inputs-title mb-2">
                                                                    <h3 class="mb-2 bg-primary p-2 rounded text-white"> البيانات الشخصية</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <input type="hidden" name="id" value="{{ $case->id }}">
                                                                    <label for="fullname">
                                                                        <b>الإسم</b>
                                                                    </label>
                                                                    <input type="text" id="fullname" name="fullname" class="form-control mb-2 text-center" value="{{ $case->fullname }}" placeholder="إسم الحالة">
                                                                    <label for="phone_number">
                                                                        <b>رقم المحمول (اذا وجد)</b>
                                                                    </label>
                                                                    <input type="number" id="phone_number" name="phone_number" class="form-control mb-2 text-center" value="{{ $case->phone_number }}" placeholder="رقم المحمول">
                                                                    <label for="age">
                                                                        <b>السن</b>
                                                                    </label>
                                                                    <input type="number" id="age" name="age" class="form-control mb-2 text-center" value="{{ $case->age }}" placeholder="السن">
                                                                    <label for="ssn">
                                                                        <b>الرقم القومي</b>
                                                                    </label>
                                                                    <input type="number" id="ssn" name="ssn" class="form-control mb-2 text-center" value="{{ $case->ssn }}" placeholder="الرقم القومي">
                                                                    <label for="address">
                                                                        <b>العنوان</b>
                                                                    </label>
                                                                    <input type="text" id="address" name="address" class="form-control mb-2 text-center" value="{{ $case->address }}" placeholder="العنوان">
                                                                    <label for="gov">
                                                                        <b>المحافظة</b>
                                                                    </label>
                                                                    <input type="text" id="gov" name="gov" class="form-control text-center" value="{{ $case->gov }}" placeholder="المحافظة">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-info p-2 rounded text-white"> البيانات المادية</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <label>
                                                                        <b>نوع الدخل</b>
                                                                    </label>
                                                                    <select name="income_type" class="form-control">
                                                                        <option class="text-center" selected>إختار نوع الدخل للحالة</option>
                                                                        <option value="retire" {{ $case->income_type == 'retire' ? 'selected' : '' }}> معاش</option>
                                                                        <option value="without" {{ $case->income_type == 'without' ? 'selected' : '' }}> بدون</option>
                                                                        <option value="other" {{ $case->income_type == 'other' ? 'selected' : '' }}> مصدر أخر</option>
                                                                    </select>
                                                                    <label class="mt-2">
                                                                        <b>دخل المعاش</b>
                                                                    </label>
                                                                    <input type="number" name="retire_income" value="{{$case->retire_income}}" class="form-control text-center" placeholder="دخل المعاش">
                                                                    <label class="mt-2">
                                                                        <b>مصدر أخر</b>
                                                                    </label>
                                                                    <input type="number" name="another_source" value="{{$case->another_source}}" class="form-control text-center" placeholder="مصدر أخر">
                                                                    <label class="mt-2">
                                                                        <b>نوع الإستفادة</b>
                                                                    </label>
                                                                    <select name="benefit_type" class="form-control">
                                                                        <option class="text-center" selected>إختار نوع الإستفادة للحالة</option>
                                                                        <option value="food" {{ $case->benefit_type == 'food' ? 'selected' : '' }}> عينية</option>
                                                                        <option value="money" {{ $case->benefit_type == 'money' ? 'selected' : '' }}>نقدية</option>
                                                                        <option value="monthly" {{ $case->benefit_type == 'monthly' ? 'selected' : '' }}>شهري</option>
                                                                        <option value="seasonal" {{ $case->benefit_type == 'seasonal' ? 'selected' : '' }}>موسمي</option>
                                                                    </select>
                                                                    <label class="mt-2">
                                                                        <b>الدخل الشهري</b>
                                                                    </label>
                                                                    <input type="number" name="monthly_income" class="form-control text-center" value="{{ $case->monthly_income }}" placeholder="الدخل الشهري">
                                                                    <label class="mt-2">
                                                                        <b>إجمالي الدخل</b>
                                                                    </label>
                                                                    <input type="number" name="total_income" class="form-control text-center bg-secondary text-white" value="{{$case->total_income}}" placeholder="إجمالي الدخل">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs mt-3">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-warning p-2 rounded text-white"> البيانات الإجتماعية</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <label class="mb-2">
                                                                        <b>الحالة الاجتماعية</b>
                                                                    </label>
                                                                    <select name="marital_status" class="form-control mb-2">
                                                                        <option class="text-center" selected>إختار الحالة الاجتماعية للحالة</option>
                                                                        <option value="single" {{ $case->marital_status == 'single' ? 'selected' : '' }}> أعزب</option>
                                                                        <option value="married" {{ $case->marital_status == 'married' ? 'selected' : '' }}> متزوج/ة</option>
                                                                        <option value="widow"{{ $case->marital_status == 'widow' ? 'selected' : '' }}> أرمل/ة</option>
                                                                        <option value="divorced"{{ $case->marital_status == 'divorced' ? 'selected' : '' }}> مطلق/ة</option>
                                                                    </select>
                                                                    <label class="mb-2">
                                                                        <b>الحالة الصحية</b>
                                                                    </label>
                                                                    <input type="text" name="health_status" class="form-control text-center" value="{{ $case->health_status }}" placeholder="الحالة الصحية">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs mt-3">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-success p-2 rounded text-white"> العائلة</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <label class="mb-2">
                                                                        <b>عدد الأولاد</b>
                                                                    </label>
                                                                    <input type="number" name="sons" value="{{ $case->sons }}" class="form-control text-center mb-2" placeholder="عدد الأولاد">
                                                                    <label class="mb-2">
                                                                        <b>عدد البنات</b>
                                                                    </label>
                                                                    <input type="number" name="daughters" value="{{ $case->daughters }}" class="form-control text-center" placeholder="عدد البنات">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs mt-3">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-secondary p-2 rounded text-white"> ملفات الحالة</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <input type="file" name="files" class="form-control mb-3 text-center" value="{{ $case->files }}" accept="image/*">
                                                                    <div class="files">
                                                                        <img src="{{ asset('build/assets/backend/files/' . $case->files) }}" class="" width="300" alt="{{ $case->fullname }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary mt-3 d-block w-100" height="50px" value="Submit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <h1 class="text-center mb-0 mt-5">لا توجد حالات</h1>
            @endif
        </tbody>
    </table>
    <div class="modal fade" id="addcase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة حالة جديدة</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ 'storecase' }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="text" name="fullname" placeholder="إسم الحالة" class="form-control mb-3 text-center">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="ssn" placeholder="الرقم القومي" class="form-control mb-3 text-center">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="phone_number" placeholder="رقم المحمول" class="form-control mb-3 text-center">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="age" placeholder="سن الحالة" class="form-control mb-3 text-center">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="text" name="address" placeholder="العنوان" class="form-control mb-3 text-center">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <select name="income_type" class="form-control mb-3">
                                            <option class="text-center" selected>إختار نوع الدخل</option>
                                            <option value="retire">معاش</option>
                                            <option value="without">بدون</option>
                                            <option value="other">مصدر أخر</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="another_source" class="form-control mb-3 text-center" placeholder="مصدر أخر">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="retire_income" class="form-control mb-3 text-center" placeholder="دخل المعاش">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <select name="benefit_type" class="form-control mb-2">
                                            <option class="text-center" selected>إختار نوع الإستفادة</option>
                                            <option value="food">عينية</option>
                                            <option value="money">نقدية</option>
                                            <option value="monthly">شهري</option>
                                            <option value="seasonal">موسمي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="monthly_income" class="form-control mb-3 text-center" placeholder="الدخل الشهري">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <select name="marital_status" class="form-control mb-2">
                                            <option class="text-center" selected>إختار الحالة الاجتماعية للحالة</option>
                                            <option value="single">أعزب</option>
                                            <option value="married">متزوج/ة</option>
                                            <option value="widow">أرمل/ة</option>
                                            <option value="divorced">مطلق/ة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="sons" class="form-control text-center mb-3" placeholder="عدد الأولاد">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="daughters" class="form-control text-center mb-3" placeholder="عدد البنات">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="text" name="health_status" class="form-control mb-3 text-center"placeholder="الحالة الصحية">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="text" name="gov" class="form-control mb-3 text-center" placeholder="المحافظة">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input id="total_income" type="number" name="total_income" class="form-control mb-3 text-center" placeholder="إجمالي الدخل" readonly autofocus="none">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="file" name="files" class="form-control mb-3 text-center" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field">
                                        <input type="submit" value="إضافة" class="btn btn-success w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
