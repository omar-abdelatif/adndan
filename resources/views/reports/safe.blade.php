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
                                <li class="breadcrumb-item active">تقارير الخزنة الشهرية</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="table-responsive">
        <div class="table-title mt-5 mb-3 bg-primary rounded mx-auto w-50 p-2 text-center text-white">
            <h3>تقارير الخزنة الشهرية</h3>
        </div>
        <div class="filter-form w-50 mx-auto">
            <form action="{{route('reports.safe')}}" method="get" class="d-flex">
                @csrf
                <input type="month" name="date" class="form-control">
                <button class="btn btn-success ms-2 px-3 text-white fw-bold" type="submit">بحث</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table borderd-table table-striped display align-middle text-center" id="table32" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="text-center">البند</th>
                        <th class="text-center">التاريخ</th>
                        <th class="text-center">المبلغ</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td class="text-right">
                            <b>الإجمالي</b>
                        </td>
                        <td id="totalmoney">000.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
