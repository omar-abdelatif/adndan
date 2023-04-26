@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
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
        <div class="header-divider"></div>
        <section class="content-header w-100">
            <div class="container-fluid d-flex">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('showall') }}">الكفالة</a>
                                </li>
                                <li class="breadcrumb-item active">إضافة حالة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="form w-100 p-3 rounded mt-4 text-center" style="background-color: #3c4b64">
        <div class="form-title my-3">
            <h3 class="text-decoration-underline text-white">إضافة حالة</h3>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <p class="mb-0">{{ $error }}</p>
                </div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        @endif
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
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="monthly_income" class="form-control mb-3 text-center" placeholder="الدخل الشهري">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="another_source" class="form-control mb-3 text-center" placeholder="مصدر أخر">
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
                            <input type="text" name="health_status" class="form-control mb-3 mt-2 text-center"placeholder="الحالة الصحية">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="number" name="sons" class="form-control text-center mb-3 mt-2" placeholder="عدد الأولاد">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="number" name="daughters" class="form-control text-center mb-3" placeholder="عدد البنات">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="gov" class="form-control mb-3 text-center" placeholder="المحافظة">
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
@endsection
