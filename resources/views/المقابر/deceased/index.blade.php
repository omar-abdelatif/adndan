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
            <div class="container-fluid d-flex">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('region.index') }}">كل المقابر</a>
                                </li>
                                <li class="breadcrumb-item active">إضافة متوفي</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="deceased">
                <div class="deceased-title bg-info-gradient p-3 w-50 mx-auto rounded mt-5">
                    <h2 class="text-center text-white">إضافة متوفي</h2>
                </div>
                <div class="deceased-content mt-4 bg-dark-gradient p-4 rounded">
                    <form action="{{route('deceased.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    <label for="name" class="text-white">
                                        <b>إسم المتوفي</b>
                                    </label>
                                    <input type="text" id="name" class="form-control text-center" name="name" placeholder="إسم المتوفي">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="death_place" class="text-white">
                                        <b>مكان الوفاة</b>
                                    </label>
                                    <input type="text" id="death_place" class="form-control text-center" name="death_place" placeholder="مكان الوفاة">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="death_date" class="text-white">
                                        <b>تاريخ الوفاة</b>
                                    </label>
                                    <input type="date" id="death_date" class="form-control text-center" name="death_date" placeholder="تاريخ الوفاة">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="burial_date" class="text-white">
                                        <b>تاريخ الدفن</b>
                                    </label>
                                    <input type="date" id="burial_date" class="form-control text-center" name="burial_date" placeholder="تاريخ الدفن">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="files" class="text-white">
                                        <b>ملفات</b>
                                    </label>
                                    <input type="file" id="files" class="form-control text-center" name="files">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    <label for="the_washer" class="text-white">
                                        <b>القائم بالغسل</b>
                                    </label>
                                    <input type="text" id="the_washer" class="form-control text-center" name="the_washer" placeholder="القائم بالغسل">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="the_carrier" class="text-white">
                                        <b>القائم بالنقل</b>
                                    </label>
                                    <input type="text" id="the_carrier" class="form-control text-center" name="the_carrier" placeholder="القائم بالنقل">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="region" class="text-white">
                                        <b>المنطقة</b>
                                    </label>
                                    <select name="region" id="region" class="form-control">
                                        <option value="0" selected>-- إختار المنطقة --</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="tomb" class="text-white">
                                        <b>إسم المقبرة</b>
                                    </label>
                                    <select name="tomb" id="regionTomb" class="form-control regionTomb">
                                        <option value="0" selected>-- إختار المقبرة --</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="room" class="text-white">
                                        <b>رقم الغرفة</b>
                                    </label>
                                    <select name="room" id="room" class="form-control">
                                        <option value="">-- إختار الغرفة --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="textarea mt-4">
                                    <label for="notes" class="text-white">
                                        <b>ملاحظـــــــات</b>
                                    </label>
                                    <textarea id="notes" class="form-control text-center" name="notes" rows="5" placeholder="ملاحظـــــــات"></textarea>
                                </div>
                                <div class="field mt-3">
                                    <button type="submit" class="btn btn-success w-100 text-white">
                                        <b>إضافة المتوفي</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
