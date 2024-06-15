@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
        <div class="header-divider"></div>
        <section class="content-header w-100">
                <div class="container-fluid d-flex">
                    <div class="row align-items-center justify-content-between w-100">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between w-100 align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item">المقابر</li>
                                    <li class="breadcrumb-item active">
                                        <a href="{{route("tomb.index")}}">كل التبرعات</a>
                                    </li>
                                    <li class="breadcrumb-item active">التبرعات السابقة</li>
                                </ol>
                                <button type="button" class="btn btn-primary mt-1 fw-bold" data-coreui-toggle="modal" data-coreui-target="#addnew_{{$donator->id}}" data-coreui-whatever="@mdo"> إضافة تبرع جديد</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </header>
    <div class="modal fade" id="addnew_{{$donator->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة تبرع جديد</h4>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark-gradient">
                    <form action="{{route("new.tomb.donator.donation.history", $donator->id)}}" method="post" id="TombDonatorForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="tombDonatorName" class="form-label text-white fw-bold">إسم المتبرع</label>
                                    <input type="text" id="tombDonatorName" name="name" class="form-control" value="{{$donator->name}}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tombDonatorMob" class="form-label text-white fw-bold">رقم المحمول</label>
                                    <input type="text" maxlength="12" id="tombDonatorMob" name="mobile_no" class="form-control" value="{{$donator->mobile_number}}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tombDonatorDonationType" class="form-label text-white fw-bold">نوع التبرع</label>
                                    <input type="text" id="tombDonatorDonationType" class="form-control" name="donation_type" value="مقابر جديدة" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="tombDonatorDonationDuration" class="form-label text-white fw-bold">مدة التبرع</label>
                                    <input type="text" id="tombDonatorDonationDuration" class="form-control" name="donation_duration" placeholder="مدة التبرع" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tombDonatorAmount" class="form-label text-white fw-bold">المبلغ</label>
                                    <input type="text" id="tombDonatorAmount" class="form-control" name="amount" placeholder="مبلغ التبرع" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tombDonatorDonationInvoice" class="form-label text-white fw-bold">رقم الايصال</label>
                                    <input type="text" id="tombDonatorDonationInvoice" class="form-control" name="invoice_no" placeholder="رقم الايصال" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" role="button" class="btn btn-primary fw-bold">تأكيد</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="donators-section-title mt-5 text-center bg-dark-gradient text-white p-3 w-50 mx-auto rounded">
                <h2 class="mb-0">التبرعات السابقة للمتبرع {{$donator->name}}</h2>
            </div>
            <div class="donator-body">
                @if (session('success'))
                    <div class="alert alert-success text-center mt-5">
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                @elseif ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger text-center mt-5">
                            <p class="mb-0">{{ $error }}</p>
                        </div>
                    @endforeach
                @endif
                <div class="table-responsive">
                    <table class="table borderd-table display align-middle text-center datatable" id="table9" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">إسم المتبرع</th>
                                <th class="text-center">رقم المحمول</th>
                                <th class="text-center">نوع التبرع</th>
                                <th class="text-center">مدة التبرع</th>
                                <th class="text-center">المبلغ</th>
                                <th class="text-center">رقم الايصال</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
