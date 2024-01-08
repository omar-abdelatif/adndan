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
                            <li class="breadcrumb-item active">كل الغرف</li>
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
            <div class="rooms-title text-center bg-info p-3 w-50 mx-auto mt-5 rounded">
                <h1 class="text-white">إجمالي الغرف</h1>
            </div>
            <?php $i = 1 ?>
            @if (session('success'))
                <div class="alert alert-success text-center mt-5">
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-center mt-5">
                        <p class="mb-0">{{ $error }}</p>
                    </div>
                @endforeach
            @endif
            <table class="table borderd-table display align-middle text-center" id="table5" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <th class="text-center">id</th>
                    <th class="text-center">الإسم</th>
                    <th class="text-center">قوة الغرفة</th>
                    <th class="text-center">أخر دفن</th>
                    <th class="text-center">Actions</th>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$room->name}}</td>
                            <td>{{$room->capacity}}</td>
                            <td>تاريخ أخر دفنة</td>
                            <td>
                                <a href="" class="btn btn-primary">إضافة</a>
                                <a href="" class="btn btn-primary">تعديل</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
