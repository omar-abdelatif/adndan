@extends('layouts.app')
@section('header')
    <header class="header header-sticky mb-5">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="{{ asset('icons/brand.svg#full') }}"></use>
                </svg>
            </a>
            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">لوحة التحكم</a>
                </li>
            </ul>
            <ul class="header-nav ms-auto"></ul>
            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            {{ __('My profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                </svg>
                                {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-primary text-white p-4 me-3">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">{{ $count }}</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small">إجمالي الحالات</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-info text-white p-4 me-3">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">0</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small">إجمالي الحالات المستحقة</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-warning text-white p-4 me-3">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-money') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">$0</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small">إجمالي التحويل هذا الشهر</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-danger text-white p-4 me-3">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-settings') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0">{{ $fullDate }}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small">تاريخ اليوم</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success text-center mt-5">
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            @endif
            <div class="upload-csv mt-5">
                <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal"
                    data-coreui-whatever="@mdo"> Upload User Excel Sheet </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Test</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="file" name="excel" class="form-control">
                                                <input type="submit" class="btn btn-primary mt-3 d-block w-100"
                                                    height="50px" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='25'>
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
                    @if ($count > 0)
                        @foreach ($data as $case)
                            <tr>
                                <td>{{ $case->id }}</td>
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
                                    <div class="modal fade" id="exampleModal{{ $case->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">بيانات الحالة كاملة
                                                    </h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ 'update' }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="inputs">
                                                                        <div class="inputs-title mb-2">
                                                                            <h3
                                                                                class="mb-2 bg-primary p-2 rounded text-white">
                                                                                البيانات الشخصية</h3>
                                                                        </div>
                                                                        <div class="inputs-body">
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $case->id }}">
                                                                            <label for="fullname">
                                                                                <b>الإسم</b>
                                                                            </label>
                                                                            <input type="text" id="fullname"
                                                                                name="fullname"
                                                                                class="form-control mb-2 text-center"
                                                                                value="{{ $case->fullname }}"
                                                                                placeholder="إسم الحالة">
                                                                            <label for="phone_number">
                                                                                <b>رقم المحمول (اذا وجد)</b>
                                                                            </label>
                                                                            <input type="number" id="phone_number"
                                                                                name="phone_number"
                                                                                class="form-control mb-2 text-center"
                                                                                value="{{ $case->phone_number }}"
                                                                                placeholder="رقم المحمول">
                                                                            <label for="age">
                                                                                <b>السن</b>
                                                                            </label>
                                                                            <input type="number" id="age"
                                                                                name="age"
                                                                                class="form-control mb-2 text-center"
                                                                                value="{{ $case->age }}"
                                                                                placeholder="السن">
                                                                            <label for="ssn">
                                                                                <b>الرقم القومي</b>
                                                                            </label>
                                                                            <input type="number" id="ssn"
                                                                                name="ssn"
                                                                                class="form-control mb-2 text-center"
                                                                                value="{{ $case->ssn }}"
                                                                                placeholder="الرقم القومي">
                                                                            <label for="address">
                                                                                <b>العنوان</b>
                                                                            </label>
                                                                            <input type="text" id="address"
                                                                                name="address"
                                                                                class="form-control mb-2 text-center"
                                                                                value="{{ $case->address }}"
                                                                                placeholder="العنوان">
                                                                            <label for="gov">
                                                                                <b>المحافظة</b>
                                                                            </label>
                                                                            <input type="text" id="gov"
                                                                                name="gov"
                                                                                class="form-control mb-2 text-center"
                                                                                value="{{ $case->gov }}"
                                                                                placeholder="المحافظة">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="inputs">
                                                                        <div class="inputs-title">
                                                                            <h3
                                                                                class="mb-2 bg-info p-2 rounded text-white">
                                                                                البيانات المادية</h3>
                                                                        </div>
                                                                        <div class="inputs-body">
                                                                            <label>
                                                                                <b>نوع الدخل</b>
                                                                            </label>
                                                                            <select name="income_type"
                                                                                class="form-control">
                                                                                <option class="text-center" selected>إختار
                                                                                    نوع الدخل للحالة</option>
                                                                                <option value="retire"
                                                                                    {{ $case->income_type == 'retire' ? 'selected' : '' }}>
                                                                                    معاش</option>
                                                                                <option value="without"
                                                                                    {{ $case->income_type == 'without' ? 'selected' : '' }}>
                                                                                    بدون</option>
                                                                            </select>
                                                                            <label class="mt-2">
                                                                                <b>الحالة التأمينية</b>
                                                                            </label>
                                                                            <input type="number" name="monthly_income"
                                                                                class="form-control  text-center"
                                                                                value="{{ $case->monthly_income }}"
                                                                                placeholder="الحالة التأمينية">
                                                                            <label class="mt-2">
                                                                                <b>نوع الإستفادة</b>
                                                                            </label>
                                                                            <select name="benefit_type"
                                                                                class="form-control">
                                                                                <option class="text-center" selected>إختار
                                                                                    نوع الإستفادة للحالة</option>
                                                                                <option value="food"
                                                                                    {{ $case->benefit_type == 'food' ? 'selected' : '' }}>
                                                                                    عينية</option>
                                                                                <option value="money"
                                                                                    {{ $case->benefit_type == 'money' ? 'selected' : '' }}>
                                                                                    مادية</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="inputs mt-3">
                                                                        <div class="inputs-title">
                                                                            <h3
                                                                                class="mb-2 bg-warning p-2 rounded text-white">
                                                                                البيانات الإجتماعية</h3>
                                                                        </div>
                                                                        <div class="inputs-body">
                                                                            <label class="mb-2">
                                                                                <b>الحالة الاجتماعية</b>
                                                                            </label>
                                                                            <select name="marital_status"
                                                                                class="form-control mb-2">
                                                                                <option class="text-center" selected>إختار
                                                                                    الحالة الاجتماعية للحالة</option>
                                                                                <option value="single"
                                                                                    {{ $case->marital_status == 'single' ? 'selected' : '' }}>
                                                                                    أعزب</option>
                                                                                <option value="married"
                                                                                    {{ $case->marital_status == 'married' ? 'selected' : '' }}>
                                                                                    متزوج/ة</option>
                                                                                <option
                                                                                    value="widow"{{ $case->marital_status == 'widow' ? 'selected' : '' }}>
                                                                                    أرمل/ة</option>
                                                                                <option
                                                                                    value="divorced"{{ $case->marital_status == 'divorced' ? 'selected' : '' }}>
                                                                                    مطلق/ة</option>
                                                                            </select>
                                                                            <label class="mb-2">
                                                                                <b>الحالة الصحية</b>
                                                                            </label>
                                                                            <input type="text" name="health_status"
                                                                                class="form-control mb-2 text-center"
                                                                                value="{{ $case->health_status }}"
                                                                                placeholder="الحالة الصحية">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="inputs mt-3">
                                                                        <div class="inputs-title">
                                                                            <h3
                                                                                class="mb-2 bg-success p-2 rounded text-white">
                                                                                العائلة</h3>
                                                                        </div>
                                                                        <div class="inputs-body">
                                                                            <label class="mb-2">
                                                                                <b>عدد الأولاد</b>
                                                                            </label>
                                                                            <input type="number" name="sons"
                                                                                value="{{ $case->sons }}"
                                                                                class="form-control text-center mb-2"
                                                                                placeholder="عدد الأولاد">
                                                                            <label class="mb-2">
                                                                                <b>عدد البنات</b>
                                                                            </label>
                                                                            <input type="number" name="daughters"
                                                                                value="{{ $case->daughters }}"
                                                                                class="form-control text-center"
                                                                                placeholder="عدد البنات">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="inputs mt-3">
                                                                        <div class="inputs-title">
                                                                            <h3
                                                                                class="mb-2 bg-secondary p-2 rounded text-white">
                                                                                ملفات الحالة</h3>
                                                                        </div>
                                                                        <div class="inputs-body">
                                                                            <input type="file" name="files"
                                                                                class="form-control mb-3 text-center"
                                                                                value="{{ $case->files }}"
                                                                                accept="image/*">
                                                                            <div class="files">
                                                                                <img src="{{ asset('build/assets/backend/files/' . $case->files) }}"
                                                                                    class="" width="300"
                                                                                    alt="{{ $case->fullname }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="submit"
                                                                        class="btn btn-primary mt-3 d-block w-100"
                                                                        height="50px" value="Submit">
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
            </table> --}}
        </div>
    </div>
@endsection
