@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
        <div class="header-divider"></div>
        <section class="content-header w-100">
                <div class="container-fluid d-flex">
                    <div class="row align-items-center justify-content-between w-100">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('region.index') }}">كل المقابر</a>
                                    </li>
                                    <li class="breadcrumb-item">التقارير</li>
                                    <li class="breadcrumb-item active">تقارير التبرعات</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </header>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center mt-5 w-50 mx-auto">
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center mt-5 w-50 mx-auto">
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endforeach
    @endif
    <div class="cards mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body align-items-center bg-dark-gradient rounded d-flex justify-content-between">
                            <div class="widget-content d-flex align-items-center justify-content-between">
                                <div class="bg-round">
                                    <img width="75" height="75" src="https://img.icons8.com/external-those-icons-lineal-color-those-icons/75/external-donate-money-currency-those-icons-lineal-color-those-icons-1.png" alt="external-donate-money-currency-those-icons-lineal-color-those-icons-1"/>
                                </div>
                            </div>
                            <div class="font-Info text-white text-center">
                                <h5 class="mb-0">إجمالي التبرعات</h5>
                                <h5 class="mb-0 mt-3">{{$totalDonations}} ج.م</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-title mt-5 mb-3 bg-primary rounded mx-auto w-50 py-3 text-center text-white">
        <h3>تقارير التبرعات الشهرية</h3>
    </div>
    <div class="filter-form w-50 mx-auto">
        <form action="{{route('tomb.reports.donations.filter')}}" method="get" class="d-flex">
            @csrf
            <input type="month" name="date" class="form-control">
            <button class="btn btn-success ms-2 px-3 text-white fw-bold" type="submit">بحث</button>
        </form>
    </div>
    <table class="table borderd-table table-striped display align-middle text-center" id="table32" data-order='[[ 0, "asc" ]]' data-page-length='10'>
        <thead>
            <tr>
                <th class="text-center">إسم المتبرع</th>
                <th class="text-center">البند</th>
                <th class="text-center">نوع التبرع</th>
                <th class="text-center">رقم الإيصال</th>
                <th class="text-center">التاريخ</th>
                <th class="text-center">المبلغ</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
@endsection
