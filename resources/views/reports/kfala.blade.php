@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
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
                                <li class="breadcrumb-item">التقارير</li>
                                <li class="breadcrumb-item active">الكفالة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    {{-- ! إجمالي الحالات لكل نوع إستفادة ! --}}
    <div class="cards-reports mt-5">
        <div class="card-title mt-4 mb-4 bg-info p-3 rounded text-white mx-auto w-50">
            <h2 class="text-center">عدد الحالات لكل نوع إستفادة و مدتها</h2>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-lg-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">{{$food_benefit_count}}</div>
                        <h3 class="text-uppercase text-white fw-semibold">الحالات العينية</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">{{$money_benefit_count}}</div>
                        <h3 class="text-uppercase text-white fw-semibold">الحالات النقدية</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">{{$monthly_benefit_count}}</div>
                        <h3 class="text-uppercase text-white fw-semibold">الحالات الشهرية</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="fs-4 fw-semibold">{{$season_benefit_count}}</div>
                        <h3 class="text-uppercase text-white fw-semibold">الحالات الموسمية</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-secondary mt-5 p-1"></div>
    {{-- ! إجمالي التبرعات لكل شهر ! --}}
    <div class="table-responsive">
        <div class="table-title mt-5 mb-3 bg-primary rounded mx-auto w-50 p-2 text-center text-white">
            <h3>إجمالي مصروفات الكفالة الشهرية ( النقدية )</h3>
        </div>
        <div class="table-responsive">
            <table class="table borderd-table display align-middle text-center" id="table30" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="text-center">الأسم</th>
                        <th class="text-center">رقم المحمول</th>
                        <th class="text-center">الرقم القومي</th>
                        <th class="text-center">المبلغ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monthly_cases as $case)
                        <tr>
                            <td class="text-center">{{$case->fullname}}</td>
                            <td class="text-center">{{$case->phone_number}}</td>
                            <td class="text-center">{{$case->ssn}}</td>
                            <td class="text-center">{{$case->monthly_income}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center">
                            <b>الإجمالي</b>
                        </td>
                        <td class="text-end pe-5" colspan="3" id="kfalaTotal"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    {{-- ! تفاصيل المصروفات لكل حالة ! --}}
    {{-- <div class="table-responsive">
        <div class="table-title mt-5 mb-3 bg-primary rounded mx-auto w-50 p-2 text-center text-white">
            <h3>تفاصيل المصروفات لكل حالة</h3>
        </div>
        <table class="table borderd-table display align-middle text-center" id="table31" data-order='[[ 0, "asc" ]]' data-page-length='10'>
            <thead>
                <tr>
                    <th class="text-center">الإسم</th>
                    <th class="text-center">الرقم القومي</th>
                    <th class="text-center">رقم المحمول</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenseDetails as $item)
                    <tr>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->ssn}}</td>
                        <td>{{$item->phone_number}}</td>
                        <td>
                            <button class="btn btn-outline-success" data-coreui-toggle="modal" data-coreui-target="#showDetails" data-coreui-whatever="@mdo">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                            <div class="modal fade" id="showDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">تفاصيل {{$item->fullname}}</h1>
                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body"></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
@endsection
