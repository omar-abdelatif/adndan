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
                    <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
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
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
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
    <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
        <thead>
            <tr>
                <td class="text-center">id</td>
                <td class="text-center">الإسم</td>
                <td class="text-center">رقم التلفون</td>
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
                    <td>{{ $donate->duration }}</td>
                    <td>{{ $donate->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ url('all_donations/' . $donate->id) }}" class="btn btn-success text-white">
                            <b>History</b>
                        </a>

                        <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit_{{ $donate->id }}" data-coreui-whatever="@mdo">
                            <b>تعديل</b>
                        </button>
                        <div class="modal fade" dir="rtl" id="edit_{{ $donate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">بيانات المتبرع كاملة</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('donator.update') }}" method="post">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="inputs">
                                                            <div class="inputs-title mb-2">
                                                                <h3 class="mb-2 bg-primary p-2 rounded text-white">تعديل البيانات الشخصية</h3>
                                                            </div>
                                                            <div class="inputs-body">
                                                                <input type="hidden" name="id" value="{{ $donate->id }}">
                                                                <div class="form-groups d-flex align-items-center mb-2">
                                                                    <label for="name">
                                                                        <b>الإسم الكامل:</b>
                                                                    </label>
                                                                    <input type="text" id="name" name="name" value="{{ $donate->name }}" class="form-control text-center w-50 border border-2 border-dark ms-3" placeholder="إسم المتبرع">
                                                                </div>
                                                                <div class="form-groups d-flex align-items-center mb-2">
                                                                    <label for="phone_number">
                                                                        <b>رقم المحمول:</b>
                                                                    </label>
                                                                    <input type="number" id="phone_number" name="mobile_phone" value="{{ $donate->mobile_phone }}" class="form-control text-center w-50 border border-2 border-dark ms-3" placeholder="رقم المحمول">
                                                                </div>
                                                                <div class="form-groups d-flex align-items-center mb-2">
                                                                    <label for="address">
                                                                        <b>المدة الزمنية:</b>
                                                                    </label>
                                                                    <select name="duration" class="form-control w-50 border border-2 border-dark ms-3">
                                                                        <option selected>إختار المدة</option>
                                                                        <option value="1month" {{ $donate->duration == '1month' ? 'selected' : '' }}>شهري</option>
                                                                        <option value="3month" {{ $donate->duration == '3month' ? 'selected' : '' }}>3 شهور</option>
                                                                        <option value="6month" {{ $donate->duration == '6month' ? 'selected' : '' }}>6 شهور</option>
                                                                        <option value="annually" {{ $donate->duration == 'annually' ? 'selected' : '' }}>سنوي</option>
                                                                        <option value="other" {{ $donate->duration == 'other' ? 'selected' : '' }}>أخرى</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="submit" class="btn btn-success mt-3 d-block w-100 text-white" height="50px" value="إرسال">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <a href="{{ url('delete-donator/' . $donate->id) }}" class="btn btn-danger mt-3 w-100 text-white">
                                            <b>حذف</b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" style="border-radius: 40px" class="btn btn-info text-white" data-coreui-toggle="modal" data-coreui-target="#donation_{{ $donate->id }}" data-coreui-whatever="@mdo">
                            <b>إضافة تبرع</b>
                        </button>
                        <div class="modal fade" dir="rtl" id="donation_{{ $donate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">إضافة تبرع جديد</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <form action="{{ route('donation.store') }}" method="post">
                                            @csrf
                                            <div class="data-info bg-light p-3 rounded">
                                                <div class="data-info-title mt-3">
                                                    <h3 class="text-center text-dark text-decoration-underline">البيانات الشخصية</h3>
                                                </div>
                                                <table class="table borderd-table align-middle text-center text-dark mt-3">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center">الإسم</td>
                                                            <td class="text-center">رقم التلفون</td>
                                                            <td class="text-center">المبلغ</td>
                                                            <td class="text-center">المدة الزمنية</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" id="name" name="name" value="{{ $donate->name }}" class="form-control text-center border border-2 border-dark" placeholder="إسم المتبرع">
                                                            </td>
                                                            <td>
                                                                <input type="number" id="phone_number" name="mobile_phone" value="{{ $donate->mobile_phone }}" class="form-control text-center border border-2 border-dark" placeholder="رقم المحمول">
                                                            </td>
                                                            <td>
                                                                <input type="number" name="amount" class="form-control text-center" placeholder="المبلغ المتبرع">
                                                            </td>
                                                            <td>
                                                                <select name="duration[]" class="form-multi-select" multiple>
                                                                    <option>إختار المدة</option>
                                                                    <option value="1month" {{ $donate->duration == '1month' ? 'selected' : '' }}>شهري</option>
                                                                    <option value="3month" {{ $donate->duration == '3month' ? 'selected' : '' }}>3 شهور</option>
                                                                    <option value="6month" {{ $donate->duration == '6month' ? 'selected' : '' }}>6 شهور</option>
                                                                    <option value="annually" {{ $donate->duration == 'annually' ? 'selected' : '' }}>سنوي</option>
                                                                    <option value="other" {{ $donate->duration == 'other' ? 'selected' : '' }}>أخرى</option>
                                                                </select>
                                                                {{-- <select class="form-multi-select" id="ms1" multiple>
                                                                    <option value="0">Angular</option>
                                                                    <option value="1">Bootstrap</option>
                                                                    <option value="2">React.js</option>
                                                                    <option value="3">Vue.js</option>
                                                                </select> --}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <input type="submit" class="btn btn-primary mt-3 d-block w-100 text-white" value="إرسال">
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
