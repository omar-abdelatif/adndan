@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
        <div class="header-divider"></div>
        <section class="content-header w-100">
            <div class="container-fluid d-flex">
                <div class="row align-items-center">
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
                                    <a href="{{ route('donator.index', ['id' => $donator->id]) }}">كل المتبرعين</a>
                                </li>
                                <li class="breadcrumb-item active">التبرعات السابقة</li>
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
        <div class="alert alert-success text-center mt-5">
            <p class="m-0">{{ session('success') }}</p>
        </div>
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center mt-5">
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endforeach
    @endif
    <h1 class="text-center pt-4">التبرعات السابقة ل{{ $donator->name }}</h1>
    <table class="table borderd-table display align-middle text-center" id="table0" data-order='[[ 0, "asc" ]]' data-page-length='10'>
        <thead>
            <tr>
                <td class="text-center">id</td>
                <td class="text-center">الإسم</td>
                <td class="text-center">رقم التلفون</td>
                <td class="text-center">المبلغ</td>
                <td class="text-center">رقم الإيصال</td>
                <td class="text-center">المدة الزمنية</td>
                <td class="text-center">تاريخ التسجيل</td>
                <td class="text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php $i=1 ?>
            @foreach ($donationHistory as $history)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $history->name }}</td>
                    <td>{{$history->mobile_phone}}</td>
                    <td>{{ $history->amount }}</td>
                    <td>{{ $history->invoice_no }}</td>
                    <td>{{ $history->duration }}</td>
                    <td>{{ $history->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{url('delete_donation/' . $history->id)}}" class="btn btn-danger text-white">
                            <b>حذف</b>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
