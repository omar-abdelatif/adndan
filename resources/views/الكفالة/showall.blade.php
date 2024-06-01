@extends('layouts.app')
@section('header')
    <header class="header header-sticky d-block">
        @include('layouts.upper-header')
        <div class="header-divider"></div>
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
        <div class="alert alert-success text-center mt-5 w-50 mx-auto">
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center mt-5 w-50 mx-auto">
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endforeach
    @endif
    <table class="table borderd-table display align-middle text-center" id="table6" data-order='[[ 0, "asc" ]]' data-page-length='10'>
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
                                                                        <option value="معاش" {{ $case->income_type == 'معاش' ? 'selected' : '' }}> معاش</option>
                                                                        <option value="بدون" {{ $case->income_type == 'بدون' ? 'selected' : '' }}> بدون</option>
                                                                        <option value="مصدر_أخر" {{ $case->income_type == 'مصدر_أخر' ? 'selected' : '' }}> مصدر أخر</option>
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
                                                                        <option value="عينية" {{ $case->benefit_type == 'عينية' ? 'selected' : '' }}> عينية</option>
                                                                        <option value="نقدية" {{ $case->benefit_type == 'نقدية' ? 'selected' : '' }}>نقدية</option>
                                                                    </select>
                                                                    <label for="" class="mt-2">
                                                                        <b>إختار مدة الإستفادة</b>
                                                                    </label>
                                                                    <select name="benefit_duration" class="form-control mb-2">
                                                                        <option class="text-center" selected>إختار مدة الإستفادة</option>
                                                                        <option value="شهرية" {{$case->benefit_duration == 'شهرية' ? 'selected' : '' }}>شهرية</option>
                                                                        <option value="موسمية" {{$case->benefit_duration == 'موسمية' ? 'selected' : '' }}>موسمية</option>
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
                                                                        <option value="أعزب" {{ $case->marital_status == 'أعزب' ? 'selected' : '' }}> أعزب</option>
                                                                        <option value="متزوج/ة" {{ $case->marital_status == 'متزوج/ة' ? 'selected' : '' }}> متزوج/ة</option>
                                                                        <option value="أرمل/ة"{{ $case->marital_status == 'أرمل/ة' ? 'selected' : '' }}> أرمل/ة</option>
                                                                        <option value="مطلق/ة"{{ $case->marital_status == 'مطلق/ة' ? 'selected' : '' }}> مطلق/ة</option>
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
                    <form action="{{ 'storecase' }}" method="post" enctype="multipart/form-data" id="CaseTable">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <input type="text" name="fullname" placeholder="إسم الحالة" id="CaseFullName" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]{3,}" class="form-control text-center" required>
                                        <p id="CaseReq" class="required text-danger fw-bold d-none mb-0">هذا الحقل مطلوب</p>
                                        <p id="CaseMsg" class="required text-danger fw-bold d-none mb-0">يجب ان يكون الحقل لا يقل عن 3 أحرف</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="ssn" id="ssn" placeholder="الرقم القومي" maxlength="14" class="form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                        <p id="ssnReq" class="d-none required text-danger fw-bold mb-0">هذا الحقل مطلوب</p>
                                        <p id="ssnMsg" class="d-none required text-danger fw-bold mb-0">يجب ان بكون الرقم القومي 14 رقماً لا غير</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="phone_number" id="mobile_no" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="رقم المحمول" class="form-control text-center" required>
                                        <p id="mobileReq" class="required fw-bold text-danger d-none mb-0">هذا الحقل مطلوب</p>
                                        <p id="mobileMsg" class=" required fw-bold text-danger d-none mb-0">يجب ان بكون رقم المحمول 11 رقماً لا غير</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="address" placeholder="العنوان" id="address" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" class="form-control text-center" required>
                                        <p class="required d-none mb-0 text-danger fw-bold" id="addressReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none mb-0 text-danger fw-bold" id="addressMsg">يجب ان يكون العنوان باللغة العربية ولا يقل عن 5 احرف</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="age" placeholder="سن الحالة" id="age" class="form-control text-center" maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                        <p class="required d-none mb-0 fw-bold text-danger" id="ageReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none mb-0 fw-bold text-danger" id="ageMsg">يجب ان يكون السن مكون من 2 رقم فقط</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="number" name="retire_income" class="form-control text-center" placeholder="دخل المعاش">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="number" name="monthly_income" class="form-control text-center" placeholder="الدخل الشهري">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="number" name="another_source" class="form-control text-center" placeholder="مصدر أخر">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="total_income" type="number" name="total_income" class="form-control text-center" placeholder="إجمالي الدخل" readonly autofocus="none">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <select name="income_type" class="form-control">
                                            <option class="text-center" selected>إختار نوع الدخل</option>
                                            <option value="معاش">معاش</option>
                                            <option value="بدون">بدون</option>
                                            <option value="مصدر_أخر">مصدر أخر</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="benefit_duration" class="form-control">
                                            <option class="text-center" selected>إختار مدة الإستفادة</option>
                                            <option value="شهرية">شهرية</option>
                                            <option value="موسمية">موسمية</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="benefit_type" class="form-control">
                                            <option class="text-center" selected>إختار نوع الإستفادة</option>
                                            <option value="عينية">عينية</option>
                                            <option value="نقدية">نقدية</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="marital_status" class="form-control">
                                            <option class="text-center" selected>إختار الحالة الاجتماعية للحالة</option>
                                            <option value="single">أعزب</option>
                                            <option value="married">متزوج/ة</option>
                                            <option value="widow">أرمل/ة</option>
                                            <option value="divorced">مطلق/ة</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="number" name="sons" class="form-control text-center" placeholder="عدد الأولاد">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="number" name="daughters" class="form-control text-center" placeholder="عدد البنات">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="health_status" class="form-control text-center"placeholder="الحالة الصحية">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="gov" class="form-control text-center" placeholder="المحافظة">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="file" name="files" class="form-control text-center" id="files" accept="image/*">
                                        <p class="required d-none fw-bold text-danger mb-0" id="filesReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none fw-bold text-danger mb-0" id="filesExt">يجب ان يكون امتداد الصورة [ jpg, png, jpeg, webp ]</p>
                                        <p class="required d-none fw-bold text-danger mb-0" id="filesSize">يجب ان يكون حجم الصورة اقل من 2 ميجا</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="submit" id="CaseForm" value="إضافة" class="btn btn-success w-100">
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
