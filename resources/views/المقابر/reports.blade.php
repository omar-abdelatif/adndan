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
                            <div class="all-regions mt-5">
                                @foreach ($regions as $region)
                                    <div class="card card-shadow rounded position-relative border-2 border-secondary p-4 mt-5">
                                        <div class="card-header position-absolute bg-secondary rounded-pill w-25" style="margin-top: -55px; margin-right: 15px">
                                            <h5 class="text-center p-2">
                                                <b>{{$region->name}}</b>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table borderd-table display align-middle text-center" id="table{{$region->id}}" data-order='[[ 4, "asc" ]]' data-page-length='10'>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">إسم المقبره</th>
                                                            <th class="text-center">القوه</th>
                                                            <th class="text-center">المتاح رجال</th>
                                                            <th class="text-center">المتاح سيدات</th>
                                                            <th class="text-center">تاريخ أخر دفنه</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($region->tombs as $tomb)
                                                            <tr>
                                                                <td>{{$tomb->name}}</td>
                                                                <td>
                                                                    @if ($tomb->type === 'لحد')
                                                                        {{$tomb->other_tomb_power}} - لحد
                                                                    @else
                                                                        {{$tomb->power}} - غرفة
                                                                    @endif
                                                                </td>
                                                                @if ($tomb->tomb_specifices === "0" && $tomb->type === 'لحد')
                                                                    <td>{{ $tomb->getAvailablePlaces()['lahd'] }}</td>
                                                                    <td>{{ $tomb->getAvailablePlaces()['lahd'] }}</td>
                                                                @elseif ($tomb->tomb_specifices === "0")
                                                                    <td>{{$tomb->mixTombs()['male']}}</td>
                                                                    <td>{{$tomb->mixTombs()['female']}}</td>
                                                                @elseif ($tomb->tomb_specifices === "1")
                                                                    <td>{{ $tomb->getAvailablePlaces()['MaleFemale'] }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-square-xmark text-danger fs-3"></i>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <i class="fa-solid fa-square-xmark text-danger fs-3"></i>
                                                                    </td>
                                                                    <td>{{ $tomb->getAvailablePlaces()['FemaleMale'] }}</td>
                                                                @endif
                                                                <td>{{$tomb->burial_date}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
