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
        <button type="button" class="btn btn-primary fw-bold" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"> رفع حالات بالجملة </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة مجموعة حالات</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-dark-gradient">
                        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="file" name="excel" class="form-control">
                                        <input type="submit" class="btn btn-primary fw-bold mt-3 d-block w-100" height="50px" value="تأكيد">
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
                                        <div class="modal-body bg-dark-gradient">
                                            <form action="{{ 'update' }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $case->id }}">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="inputs">
                                                                <div class="inputs-title mb-2">
                                                                    <h3 class="mb-2 bg-primary p-2 rounded text-white"> البيانات الشخصية</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <div class="form-group mb-2">
                                                                        <label for="fullname" class="form-label text-white fw-bold">
                                                                            <b>الإسم</b>
                                                                        </label>
                                                                        <input type="text" id="fullname" name="fullname" class="form-control mb-2 text-center" value="{{ $case->fullname }}" placeholder="إسم الحالة">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="phone_number" class="form-label text-white fw-bold">
                                                                            <b>رقم المحمول</b>
                                                                        </label>
                                                                        <input type="number" id="phone_number" name="phone_number" class="form-control mb-2 text-center" value="{{ $case->phone_number }}" placeholder="رقم المحمول">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="" class="form-label text-white fw-bold">رقم المحمول الأخر</label>
                                                                        <input type="number" name="another_phone_number" class="form-control mb-2 text-center" value="{{ $case->another_phone_number }}" placeholder="رقم المحمول">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="age" class="form-label text-white fw-bold">
                                                                            <b>السن</b>
                                                                        </label>
                                                                        <input type="number" id="caseAge" name="age" class="form-control mb-2 text-center" value="{{ $case->age }}" placeholder="السن">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="ssn" class="form-label text-white fw-bold">
                                                                            <b>الرقم القومي</b>
                                                                        </label>
                                                                        <input type="number" id="caseSsn" name="ssn" class="form-control mb-2 text-center" value="{{ $case->ssn }}" placeholder="الرقم القومي">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="address" class="form-label text-white fw-bold">
                                                                            <b>العنوان</b>
                                                                        </label>
                                                                        <input type="text" id="caseAddress" name="address" class="form-control mb-2 text-center" value="{{ $case->address }}" placeholder="العنوان">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="gov" class="form-label text-white fw-bold">
                                                                            <b>المحافظة</b>
                                                                        </label>
                                                                        <input type="text" id="gov" name="gov" class="form-control text-center" value="{{ $case->gov }}" placeholder="المحافظة">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-info p-2 rounded text-white"> البيانات المادية</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>نوع الدخل</b>
                                                                        </label>
                                                                        <select name="income_type" class="form-control">
                                                                            <option class="text-center" selected>إختار نوع الدخل للحالة</option>
                                                                            <option value="معاش" {{ $case->income_type == 'معاش' ? 'selected' : '' }}> معاش</option>
                                                                            <option value="بدون" {{ $case->income_type == 'بدون' ? 'selected' : '' }}> بدون</option>
                                                                            <option value="مصدر_أخر" {{ $case->income_type == 'مصدر_أخر' ? 'selected' : '' }}> مصدر أخر</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>دخل المعاش</b>
                                                                        </label>
                                                                        <input type="number" name="retire_income" value="{{$case->retire_income}}" class="form-control text-center" placeholder="دخل المعاش">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>مصدر أخر</b>
                                                                        </label>
                                                                        <input type="number" name="another_source" value="{{$case->another_source}}" class="form-control text-center" placeholder="مصدر أخر">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>نوع الإستفادة</b>
                                                                        </label>
                                                                        <select name="benefit_type" class="form-control">
                                                                            <option class="text-center" selected>إختار نوع الإستفادة للحالة</option>
                                                                            <option value="عينية" {{ $case->benefit_type == 'عينية' ? 'selected' : '' }}> عينية</option>
                                                                            <option value="نقدية" {{ $case->benefit_type == 'نقدية' ? 'selected' : '' }}>نقدية</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="" class="form-label text-white fw-bold">
                                                                            <b>إختار مدة الإستفادة</b>
                                                                        </label>
                                                                        <select name="benefit_duration" class="form-control mb-2">
                                                                            <option class="text-center" selected>إختار مدة الإستفادة</option>
                                                                            <option value="شهرية" {{$case->benefit_duration == 'شهرية' ? 'selected' : '' }}>شهرية</option>
                                                                            <option value="موسمية" {{$case->benefit_duration == 'موسمية' ? 'selected' : '' }}>موسمية</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>الدخل الشهري</b>
                                                                        </label>
                                                                        <input type="number" name="monthly_income" class="form-control text-center" value="{{ $case->monthly_income }}" placeholder="الدخل الشهري">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>إجمالي الدخل</b>
                                                                        </label>
                                                                        <input type="number" name="total_income" class="form-control text-center bg-secondary text-white" value="{{$case->total_income}}" placeholder="إجمالي الدخل">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs mt-3">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-warning p-2 rounded text-white"> البيانات الإجتماعية</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>الحالة الاجتماعية</b>
                                                                        </label>
                                                                        <select name="marital_status" class="form-control mb-2">
                                                                            <option class="text-center" selected>إختار الحالة الاجتماعية للحالة</option>
                                                                            <option value="أعزب" {{ $case->marital_status == 'أعزب' ? 'selected' : '' }}> أعزب</option>
                                                                            <option value="متزوج/ة" {{ $case->marital_status == 'متزوج/ة' ? 'selected' : '' }}> متزوج/ة</option>
                                                                            <option value="أرمل/ة"{{ $case->marital_status == 'أرمل/ة' ? 'selected' : '' }}> أرمل/ة</option>
                                                                            <option value="مطلق/ة"{{ $case->marital_status == 'مطلق/ة' ? 'selected' : '' }}> مطلق/ة</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>الحالة الصحية</b>
                                                                        </label>
                                                                        <input type="text" name="health_status" class="form-control text-center" value="{{ $case->health_status }}" placeholder="الحالة الصحية">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs mt-3">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-success p-2 rounded text-white"> العائلة</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>عدد الأولاد</b>
                                                                        </label>
                                                                        <input type="number" name="sons" value="{{ $case->sons }}" class="form-control text-center mb-2" placeholder="عدد الأولاد">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label class="form-label text-white fw-bold">
                                                                            <b>عدد البنات</b>
                                                                        </label>
                                                                        <input type="number" name="daughters" value="{{ $case->daughters }}" class="form-control text-center" placeholder="عدد البنات">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputs mt-3">
                                                                <div class="inputs-title">
                                                                    <h3 class="mb-2 bg-secondary p-2 rounded text-white"> ملفات الحالة</h3>
                                                                </div>
                                                                <div class="inputs-body">
                                                                    <div class="form-group mb-2">
                                                                        <label for="" class="form-label text-white fw-bold">الصور</label>
                                                                        <input type="file" name="imgs" class="form-control mb-3 text-center" value="{{ $case->imgs }}" accept="image/*">
                                                                        <div class="files">
                                                                            <img src="{{ asset('build/assets/backend/files/' . $case->imgs) }}" class="" width="300" alt="{{ $case->fullname }}">
                                                                        </div>
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
                <div class="modal-body bg-dark-gradient">
                    <form action="{{ 'storecase' }}" method="post" enctype="multipart/form-data" id="CaseTable">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">إسم الحالة</label>
                                        <input type="text" name="fullname" placeholder="إسم الحالة" id="CaseFullName" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s\/\-_()\[\]]/g, '')" pattern="[\u0600-\u06FF\s\/\-_()\[\]]{3,}" class="form-control text-center" required>
                                        <p id="CaseReq" class="required text-danger fw-bold d-none mb-0">هذا الحقل مطلوب</p>
                                        <p id="CaseMsg" class="required text-danger fw-bold d-none mb-0">يجب ان يكون الحقل لا يقل عن 3 أحرف</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">الرقم القومي</label>
                                        <input type="text" name="ssn" id="ssn" placeholder="الرقم القومي" maxlength="14" class="form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                        <p id="ssnReq" class="d-none required text-danger fw-bold mb-0">هذا الحقل مطلوب</p>
                                        <p id="ssnMsg" class="d-none required text-danger fw-bold mb-0">يجب ان بكون الرقم القومي 14 رقماً لا غير</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">رقم المحمول</label>
                                        <input type="text" name="phone_number" id="mobile_no" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="رقم المحمول" class="form-control text-center" required>
                                        <p id="mobileReq" class="required fw-bold text-danger d-none mb-0">هذا الحقل مطلوب</p>
                                        <p id="mobileMsg" class=" required fw-bold text-danger d-none mb-0">يجب ان بكون رقم المحمول 11 رقماً لا غير</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">رقم المحمول الأخر</label>
                                        <input type="text" name="another_phone_number" id="another_phone_number" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="رقم المحمول الأخر" class="form-control text-center">
                                        <p id="otherMobileReq" class="required fw-bold text-danger d-none mb-0">هذا الحقل مطلوب</p>
                                        <p id="otherMobileMsg" class=" required fw-bold text-danger d-none mb-0">يجب ان بكون رقم المحمول 11 رقماً لا غير</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">العنوان</label>
                                        <input type="text" name="address" placeholder="العنوان" id="address" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s\d\/\-_()\[\]]/g, '')" class="form-control text-center" required>
                                        <p class="required d-none mb-0 text-danger fw-bold" id="addressReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none mb-0 text-danger fw-bold" id="addressMsg">يجب ان يكون العنوان باللغة العربية ولا يقل عن 5 احرف</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">سن الحالة</label>
                                        <input type="text" name="age" placeholder="سن الحالة" id="age" class="form-control text-center" maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                        <p class="required d-none mb-0 fw-bold text-danger" id="ageReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none mb-0 fw-bold text-danger" id="ageMsg">يجب ان يكون السن مكون من 2 رقم فقط</p>
                                    </div>
                                    <div class="case">
                                        <div class="form-group mb-2">
                                            <label for="" class="form-label text-white fw-bold">دخل المعاش</label>
                                            <input type="number" name="retire_income" class="form-control text-center" placeholder="دخل المعاش">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="" class="form-label text-white fw-bold">الدخل الشهري</label>
                                            <input type="number" name="monthly_income" class="form-control text-center" placeholder="الدخل الشهري">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="" class="form-label text-white fw-bold">مصدر أخر</label>
                                            <input type="number" name="another_source" class="form-control text-center" placeholder="مصدر أخر">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="" class="form-label text-white fw-bold">إجمالي الدخل</label>
                                            <input id="total_income" type="number" name="total_income" class="form-control text-center" placeholder="إجمالي الدخل" readonly autofocus="none">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">نوع الدخل</label>
                                        <select name="income_type" class="form-control">
                                            <option class="text-center" selected>إختار نوع الدخل</option>
                                            <option value="معاش">معاش</option>
                                            <option value="بدون">بدون</option>
                                            <option value="مصدر_أخر">مصدر أخر</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">مدة الإستفادة</label>
                                        <select name="benefit_duration" class="form-control">
                                            <option class="text-center" selected>إختار مدة الإستفادة</option>
                                            <option value="شهرية">شهرية</option>
                                            <option value="موسمية">موسمية</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">نوع الإستفادة</label>
                                        <select name="benefit_type" class="form-control">
                                            <option class="text-center" selected>إختار نوع الإستفادة</option>
                                            <option value="عينية">عينية</option>
                                            <option value="نقدية">نقدية</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">الحالة الاجتماعية</label>
                                        <select name="marital_status" class="form-control">
                                            <option class="text-center" selected>إختار الحالة الاجتماعية للحالة</option>
                                            <option value="single">أعزب</option>
                                            <option value="married">متزوج/ة</option>
                                            <option value="widow">أرمل/ة</option>
                                            <option value="divorced">مطلق/ة</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">عدد الأولاد</label>
                                        <input type="number" name="sons" class="form-control text-center" placeholder="عدد الأولاد">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">عدد البنات</label>
                                        <input type="number" name="daughters" class="form-control text-center" placeholder="عدد البنات">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">الحالة الصحية</label>
                                        <input type="text" name="health_status" class="form-control text-center"placeholder="الحالة الصحية">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label text-white fw-bold">المحافظة</label>
                                        <input type="text" name="gov" class="form-control text-center" placeholder="المحافظة">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="imgs" class="form-label text-white fw-bold">الصور</label>
                                        <input type="file" name="imgs" class="form-control text-center" id="imgs" accept="image/*">
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
