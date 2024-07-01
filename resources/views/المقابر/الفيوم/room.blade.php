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
                <div class="row align-items-center ">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('region.index') }}">كل المناطق</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('fayum.index') }}">مقابر {{$region->name}}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('fayum.index') }}">{{$tombName}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{$room->name}}</li>
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
            <div class="content-title bg-dark-gradient p-3 mx-auto w-50 rounded mt-5 text-white">
                <h2 class="text-center">{{$room->name}}</h2>
            </div>
            <div class="content-data">
                <div class="row">
                    <div class="col-12">
                        <?php $k = 1 ?>
                        <table class="table borderd-table display align-middle text-center" id="table16" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الإسم</th>
                                    <th class="text-center">مكان الوفاه</th>
                                    <th class="text-center">تاريخ الوفاه</th>
                                    <th class="text-center">تاريخ الدفن</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deceaseds as $deceased)
                                    <tr>
                                        <td class="text-center">{{$k++}}</td>
                                        <td class="text-center">{{$deceased->name}}</td>
                                        <td class="text-center">{{$deceased->death_place}}</td>
                                        <td class="text-center">{{$deceased->death_date}}</td>
                                        <td class="text-center">{{$deceased->burial_date}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
