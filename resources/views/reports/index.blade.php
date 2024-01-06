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
        <div class="report-logo mt-4 ms-5 d-flex align-items-center justify-content-center">
            <img src="{{asset('icons/download.png')}}" width="90" alt="logo">
            <h1 class="ps-3">جمعية أدندان الخيرية ( التقارير )</h1>
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
                                    <input type="date" name="date" class="form-control">
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
                        <table class="table borderd-table table-striped display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
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
                                @if ($get_all_donations->count() === 0)
                                    <tr>
                                        <td colspan="5">No records found for the selected month.</td>
                                    </tr>
                                @else
                                    <?php $i = 1 ?>
                                    @foreach($get_all_donations as $donation)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $donation->name }}</td>
                                            <td>{{ $donation->mobile_phone }}</td>
                                            <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $donation->amount }}</td>
                                        </tr>
                                    @endforeach
                                @endif
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
    {{-- ! Monthly Donators ! --}}
    <section class="donator-report p-3 rounded bg-secondary mt-5">
        <div class="section-title mb-5">
            <h3 class="text-center text-decoration-underline">المتبرعيين الشهريين</h3>
        </div>
        <div class="section-content">
            <table class="table borderd-table table-striped display align-middle text-center" id="table0" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="text-center">إسم المتبرع</th>
                        <th class="text-center">رقم التلفون</th>
                        <th class="text-center">نوع المتبرع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monthly as $donator)
                        <tr>
                            <td>{{$donator->name}}</td>
                            <td>{{$donator->mobile_phone}}</td>
                            <td>{{$donator->duration}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    {{-- ! Seasonly Donators ! --}}
    <section class="donator-report p-3 rounded bg-secondary mt-5">
        <div class="section-title mb-5">
            <h3 class="text-center text-decoration-underline">المتبرعيين الموسميين</h3>
        </div>
        <div class="section-content">
            <table class="table borderd-table table-striped display align-middle text-center" id="table1" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="text-center">إسم المتبرع</th>
                        <th class="text-center">رقم التلفون</th>
                        <th class="text-center">نوع المتبرع</th>
                        <th class="text-center">أخرى</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seasonly as $donator)
                        <tr>
                            <td>{{$donator->name}}</td>
                            <td>{{$donator->mobile_phone}}</td>
                            <td>{{$donator->duration}}</td>
                            <td>{{$donator->other_duration}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
