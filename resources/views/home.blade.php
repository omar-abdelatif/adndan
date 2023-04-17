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
        </div>
    </div>
@endsection
