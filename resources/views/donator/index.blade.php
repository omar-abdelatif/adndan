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
                                <a href="{{route('donator.addnew')}}" class="btn btn-success">إضافة متبرع</a>
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
        <p class="m-0">{{session('success')}}</p>
    </div>
@endif
@endsection
