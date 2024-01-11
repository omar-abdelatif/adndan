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
                                    <a href="{{ route('showall') }}">التبرعات</a>
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
    {{-- ! Total Donation Report ! --}}
    <div class="report text-center">
        <div class="report-logo">
            <div class="report-title mt-4 ms-5 d-flex align-items-center justify-content-center">
                <img src="{{asset('icons/download.png')}}" width="90" alt="logo">
                <h1 class="ps-3 d-block">جمعية أدندان الخيرية ( مشروع الكفالة )</h1>
            </div>
            <p class="text-center fw-bold fs-3 text-decoration-underline">تقارير التبرعات</p>
        </div>
        <div class="report-content bg-secondary p-3 rounded w-100 mt-4">
            <div class="sub-logo">
                <h3 class="text-center text-decoration-underline">التبرعات</h3>
            </div>
            <div class="report-info mt-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="date-filter mt-3 mb-1">
                            <div class="date-filter text-center text-white w-50 mx-auto">
                                <form action="{{route('reports.index')}}" method="get" class="d-flex">
                                    @csrf
                                    <input type="month" name="date" class="form-control">
                                    <input type="submit" value="Submit" class="btn btn-primary mr-2">
                                </form>
                            </div>
                        </div>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger mt-3 text-center mx-auto w-50">
                                    <p class="mb-0">{{$error}}</p>
                                </div>
                            @endforeach
                        @endif
                        <table class="table borderd-table table-striped display align-middle text-center" id="table2" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                            <thead>
                                <tr>
                                    {{-- <th class="text-center">#</th> --}}
                                    <th class="text-center">الإسم</th>
                                    <th class="text-center">رقم التلفون</th>
                                    <th class="text-center">نوع التبرع</th>
                                    <th class="text-center">نوع أخر</th>
                                    <th class="text-center">تاريخ التبرع</th>
                                    <th class="text-center">مده التبرع</th>
                                    <th class="text-center">أخرى</th>
                                    <th class="text-center">مبلغ التبرع</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <?php $i = 1 ?> --}}
                                @foreach($donations as $donation)
                                    <tr>
                                        {{-- <td>{{ $i++ }}</td> --}}
                                        <td>{{ $donation->donator->name }}</td>
                                        <td>{{ $donation->donator->mobile_phone }}</td>
                                        @if ($donation->donation_type)
                                            <td>{{$donation->donation_type}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if ($donation->other_type)
                                            <td>{{$donation->other_type}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $donation->donator->duration }}</td>
                                        @if ($donation->donator->other_duration)
                                            <td>{{ $donation->donator->other_duration }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ $donation->amount }}</td>
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
