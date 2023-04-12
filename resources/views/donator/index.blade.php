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
                                <li class="breadcrumb-item active">كل المتبرعين</li>
                            </ol>
                            <a href="{{ route('donator.addnew') }}" class="btn btn-success">إضافة متبرع</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center mt-5">
            <p class="m-0">{{ session('success') }}</p>
        </div>
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center mt-5">
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endforeach
    @endif
    <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]'
        data-page-length='10'>
        <thead>
            <tr>
                <td class="text-center">id</td>
                <td class="text-center">الإسم</td>
                <td class="text-center">رقم التلفون</td>
                <td class="text-center">المبلغ</td>
                <td class="text-center">المدة الزمنية</td>
                <td class="text-center">تاريخ التسجيل</td>
                <td class="text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($donator as $donate)
                <tr class="text-center">
                    <td>{{ $donate->id }}</td>
                    <td>{{ $donate->name }}</td>
                    <td>{{ $donate->mobile_phone }}</td>
                    <td>{{ $donate->amount }}</td>
                    <td>{{ $donate->duration }}</td>
                    <td>{{ $donate->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ url('history/' . $donate->id) }}" class="btn btn-success text-white">History</a>
                        <a href="{{ url('edit-donator/' . $donate->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url('delete-donator/' . $donate->id) }}" class="btn btn-danger">Delete</a>
                        <button type="button" style="border-radius: 40px" class="btn btn-info text-white"
                            data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo">
                            <b>إضافة تبرع</b>
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">بيانات الحالة كاملة
                                        </h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ 'update' }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="inputs">
                                                            <div class="inputs-title mb-2">
                                                                <h3 class="mb-2 bg-primary p-2 rounded text-white">البيانات
                                                                    الشخصية</h3>
                                                            </div>
                                                            <div class="inputs-body">
                                                                <input type="hidden" name="id">
                                                                <label for="fullname">
                                                                    <b>الإسم</b>
                                                                </label>
                                                                <input type="text" id="fullname" name="fullname"
                                                                    class="form-control mb-2 text-center"
                                                                    placeholder="إسم الحالة">
                                                                <label for="phone_number">
                                                                    <b>رقم المحمول (اذا وجد)</b>
                                                                </label>
                                                                <input type="number" id="phone_number"
                                                                    name="phone_number"
                                                                    class="form-control mb-2 text-center"
                                                                    placeholder="رقم المحمول">
                                                                <label for="age">
                                                                    <b>السن</b>
                                                                </label>
                                                                <input type="number"
                                                                    id="age"name="age"class="form-control mb-2 text-center"placeholder="السن">
                                                                <label for="ssn">
                                                                    <b>الرقم القومي</b>
                                                                </label>
                                                                <input type="number" id="ssn" name="ssn"
                                                                    class="form-control mb-2 text-center"
                                                                    placeholder="الرقم القومي">
                                                                <label for="address">
                                                                    <b>العنوان</b>
                                                                </label>
                                                                <input type="text" id="address" name="address"
                                                                    class="form-control mb-2 text-center"
                                                                    placeholder="العنوان">
                                                                <label for="gov">
                                                                    <b>المحافظة</b>
                                                                </label>
                                                                <input type="text" id="gov" name="gov"
                                                                    class="form-control mb-2 text-center"
                                                                    placeholder="المحافظة">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="inputs">
                                                            <div class="inputs-title">
                                                                <h3 class="mb-2 bg-info p-2 rounded text-white">البيانات
                                                                    المادية</h3>
                                                            </div>
                                                            <div class="inputs-body">
                                                                <label>
                                                                    <b>نوع الدخل</b>
                                                                </label>
                                                                <select name="income_type" class="form-control">
                                                                    <option class="text-center" selected>إختار
                                                                        نوع الدخل للحالة</option>
                                                                    <option value="retire">
                                                                        معاش</option>
                                                                    <option value="without">
                                                                        بدون</option>
                                                                </select>
                                                                <label class="mt-2">
                                                                    <b>الحالة التأمينية</b>
                                                                </label>
                                                                <input type="number" name="monthly_income"
                                                                    class="form-control  text-center"
                                                                    placeholder="الحالة التأمينية">
                                                                <label class="mt-2">
                                                                    <b>نوع الإستفادة</b>
                                                                </label>
                                                                <select name="benefit_type" class="form-control">
                                                                    <option class="text-center" selected>إختار
                                                                        نوع الإستفادة للحالة</option>
                                                                    <option value="food">
                                                                        عينية</option>
                                                                    <option value="money">
                                                                        مادية</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="inputs mt-3">
                                                            <div class="inputs-title">
                                                                <h3 class="mb-2 bg-warning p-2 rounded text-white">
                                                                    البيانات الإجتماعية</h3>
                                                            </div>
                                                            <div class="inputs-body">
                                                                <label class="mb-2">
                                                                    <b>الحالة الاجتماعية</b>
                                                                </label>
                                                                <select name="marital_status" class="form-control mb-2">
                                                                    <option class="text-center" selected>إختار
                                                                        الحالة الاجتماعية للحالة</option>
                                                                    <option value="single">
                                                                        أعزب</option>
                                                                    <option value="married">
                                                                        متزوج/ة</option>
                                                                    <option value="widow">
                                                                        أرمل/ة</option>
                                                                    <option value="divorced">
                                                                        مطلق/ة</option>
                                                                </select>
                                                                <label class="mb-2">
                                                                    <b>الحالة الصحية</b>
                                                                </label>
                                                                <input type="text" name="health_status"
                                                                    class="form-control mb-2 text-center"
                                                                    placeholder="الحالة الصحية">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="inputs mt-3">
                                                            <div class="inputs-title">
                                                                <h3 class="mb-2 bg-success p-2 rounded text-white">
                                                                    العائلة</h3>
                                                            </div>
                                                            <div class="inputs-body">
                                                                <label class="mb-2">
                                                                    <b>عدد الأولاد</b>
                                                                </label>
                                                                <input type="number" name="sons"
                                                                    class="form-control text-center mb-2"
                                                                    placeholder="عدد الأولاد">
                                                                <label class="mb-2">
                                                                    <b>عدد البنات</b>
                                                                </label>
                                                                <input type="number" name="daughters"
                                                                    class="form-control text-center"
                                                                    placeholder="عدد البنات">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
