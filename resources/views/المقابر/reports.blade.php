@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
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
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-12 d-inline-flex align-items-center justify-content-between w-100">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">التقارير</li>
                        </ol>
                        {{-- <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#addtomb" data-coreui-whatever="@mdo">
                            <b>إضافة مقبرة</b>
                        </button> --}}
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="report-wrapper">
                <div class="report-title bg-dark-gradient text-white text-center mt-5 p-3 rounded w-50 mx-auto">
                    <h2>تقارير المقابر</h2>
                </div>
                <div class="report-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-to">
                                <form action="" method="" class="d-flex align-items-center justify-content-evenly">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class="col-form-label">
                                            <b>من تاريخ</b>
                                        </label>
                                        <input type="date" class="form-control" name="from" id="" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-form-label">
                                            <b>الى تاريخ</b>
                                        </label>
                                        <input type="date" class="form-control" name="to" id="" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-form-label">
                                            <b>المنطقة</b>
                                        </label>
                                            <select name="region" id="region" class="form-control">
                                            <option value="0" selected>-- إختار المنطقة --</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->name }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tomb">
                                            <b>إسم المقبرة</b>
                                        </label>
                                        <select name="tomb" id="regionTomb" class="form-control regionTomb">
                                            <option value="0" selected>-- إختار المقبرة --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <b>تصفح</b>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-12">
                            <div class="filter"></div>
                            <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">إسم المتوفي</th>
                                        <th class="text-center">النوع</th>
                                        <th class="text-center">المكان</th>
                                        <th class="text-center">تاريخ الدفن</th>
                                        <th class="text-center">تاريخ الوفاه</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
