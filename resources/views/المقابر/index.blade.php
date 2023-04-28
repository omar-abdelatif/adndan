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
                                <li class="breadcrumb-item active">كل المقابر</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">6 أكتوبر</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("october.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">الفيوم</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("fayum.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">الغفير</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("fayum.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
