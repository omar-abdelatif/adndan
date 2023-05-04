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
                <div class="row">
                    <div class="col-lg-12 d-inline-flex align-items-center justify-content-between w-100">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">إضافة مقبرة</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="create_form mt-5 bg-dark-gradient p-3 rounded">
                <div class="title mt-3 mb-5">
                    <h1 class="text-center text-white text-decoration-underline">إضافة مقبرة جديدة</h1>
                </div>
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
                <form action="{{ route('tombs.store') }}" method="post">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="field">
                                    <input type="text" name="name" placeholder="إسم مقبرة" class="form-control mb-3 text-center">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="field">
                                    <select name="power" class="form-control mb-2">
                                        <option class="text-center" selected>قوة المقبرة</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="field">
                                    <select name="type" class="form-control">
                                        <option selected>إختار نوع المقبرة</option>
                                        <option value="لحد">لحد</option>
                                        <option value="عيون">عيون</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="field">
                                    <select name="region" class="form-control">
                                        <option selected>إختار المنطقة</option>
                                        @foreach ($region as $region)
                                            <option value="{{$region->name}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="field">
                                    <input type="number" name="annual_cost" class="form-control mt-3 text-center" placeholder="قيمة الدفع السنوي">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field">
                                    <input type="submit" value='إضافة' class="btn btn-success w-100 mt-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
