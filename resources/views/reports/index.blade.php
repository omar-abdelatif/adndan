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
            <div class="container-fluid d-flex">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div>
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('showall') }}">الكفالة</a>
                                </li>
                                <li class="breadcrumb-item active">كل التقارير</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
<div class="report text-center">
    <div class="report-content bg-secondary p-3 rounded w-100 mt-4">
        <div class="report-logo mt-4 ms-5 d-flex align-items-center justify-content-center">
            <img src="{{asset('icons/download.png')}}" width="90" alt="logo">
            <h1 class="ps-3">جمعية أدندان الخيرية</h1>
        </div>
        <div class="sub-logo">
            <h3 class="text-center text-decoration-underline">مشروع الكفالة</h3>
        </div>
        <div class="report-info mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="date-filter mt-3 mb-3">
                        <div class="date-filter text-center text-white w-50 mx-auto">
                            <form action="{{route('reports.index')}}" method="get" class="d-flex">
                                @csrf
                                <input type="month" name="date" class="form-control">
                                <input type="submit" value="Submit" class="btn btn-primary mr-2">
                            </form>
                        </div>
                    </div>
                    <table class="table borderd-table table-striped display align-middle text-center mt-2" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                        <thead>
                            <tr>
                                <td class="text-center">id</td>
                                <td class="text-center">الإسم</td>
                                <td class="text-center">رقم التلفون</td>
                                <td class="text-center">تاريخ التبرع</td>
                                <td class="text-center">مبلغ التبرع</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            @foreach ($donations as $report)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$report->name}}</td>
                                    <td>{{$report->mobile_phone}}</td>
                                    <td>{{$report->created_at}}</td>
                                    <td>{{$report->amount}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right">
                                    <b>الإجمالي</b>
                                </td>
                                <td id="totalAmount"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
