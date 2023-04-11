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
            <div class="container-fluid d-flex align-items-center">
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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('donator.index') }}">كل المتبرعين</a>
                                </li>
                                <li class="breadcrumb-item active">تعديل متبرع</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center mt-5">
                <p class="mb-0">{{$error}}</p>
            </div>
        @endforeach
    @endif
    <div class="inputs w-50 p-3 mx-auto bg-secondary rounded mt-5">
        <div class="donator-title">
            <h1 class="text-center mt-2 mb-4 text-white text-decoration-underline">تعديل متبرع</h1>
        </div>
        <div class="donator-content text-center">
            <form action="{{route('donator.update')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$donate->id}}">
                <input type="text" name="name" value="{{$donate->name}}" class="form-control mb-2 text-center" placeholder="إسم المتبرع">
                <input type="number" name="mobile_phone" value="{{$donate->mobile_phone}}" class="form-control mb-2 text-center" placeholder="رقم المحمول">
                <input type="number" name="amount" value="{{$donate->amount}}" class="form-control mb-2 text-center" placeholder="المبلغ">
                <select name="duration" class="form-control">
                    <option selected>إختار المدة</option>
                    <option value="1month" {{ $donate->duration == '1month' ? 'selected' : '' }}>شهري</option>
                    <option value="3month" {{ $donate->duration == '3month' ? 'selected' : '' }}>3 شهور</option>
                    <option value="6month" {{ $donate->duration == '6month' ? 'selected' : '' }}>6 شهور</option>
                    <option value="annually" {{ $donate->duration == 'annually' ? 'selected' : '' }}>سنوي</option>
                    <option value="other" {{ $donate->duration == 'other' ? 'selected' : '' }}>أخرى</option>
                </select>
                <button type="submit" class="btn btn-success w-100 mt-3 text-center text-white">إرسال</button>
            </form>
        </div>
    </div>
@endsection

