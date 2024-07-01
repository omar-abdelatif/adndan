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
                                    <a href="{{ route('showall') }}">الكفالة</a>
                                </li>
                                <li class="breadcrumb-item">التقارير</li>
                                <li class="breadcrumb-item active">تقارير البنك</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#withdraw" data-coreui-whatever="@mdo">
                                <b>سحب الى الخزينة</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-decoration-underline" id="exampleModalLabel">سحب الى البنك</h3>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark-gradient">
                    <form action="{{route("bank.deposit")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-2">
                                    <label for="amount" class="text-white"></label>
                                    <input type="text" class="form-control" id="amount" placeholder="المبلغ المسحوب" name="amount" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="img" class="text-white"></label>
                                    <input type="file" class="form-control" id="img" name="proof_img" accept="image/*" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="DonatorsSubmit" class="btn btn-success w-100 mt-3 text-center text-white">تأكيد</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                                    <img width="100" height="100" src="https://img.icons8.com/stickers/100/bank.png" alt="bank"/>
                                </div>
                            </div>
                            <div class="font-Info text-white text-center">
                                <h5 class="mb-0">إجمالي البنك</h5>
                                <h5 class="mb-0 mt-3">{{ $sumBank }} ج.م</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table borderd-table table-striped display align-middle text-center" id="table32" data-order='[[ 0, "asc" ]]' data-page-length='10'>
            <thead class="bg-dark-gradient">
                <tr>
                    <th class="text-white text-center">نوع المعاملة</th>
                    <th class="text-white text-center">تاريخ المعاملة</th>
                    <th class="text-white text-center">إثبات الدفع</th>
                    <th class="text-white text-center">المبلغ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $item)
                    <tr>
                        <td>{{$item->transaction_type}}</td>
                        <td>{{$item->created_at->format('Y-m-d')}}</td>
                        <td>
                            <button class="btn" data-coreui-toggle="modal" data-coreui-target="#img_{{$item->proof_img}}" data-coreui-whatever="@mdo">
                                <img src="{{$item->proof_img ? asset('assets/backend/files/cases/imgs/safe_reports/'.$item->proof_img) : "-"}}" width="50" alt="{{$item->proof_img}}">
                            </button>
                            <div class="fade modal" id="img_{{$item->proof_img}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body bg-dark-gradient p-2 rounded">
                                            <img src="{{asset('assets/backend/files/cases/imgs/safe_reports/'.$item->proof_img)}}" class="w-100" alt="{{$item->proof_img}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{$item->amount}} ج.م</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
