@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
        <div class="header-divider"></div>
        <section class="content-header w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 d-inline-flex align-items-center justify-content-between w-100">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">كل المقابر</li>
                        </ol>
                        <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#addregion" data-coreui-whatever="@mdo">
                            <b>إضافة منطقة</b>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="row mt-5 justify-content-center">
        @if (session('success'))
            <div class="alert alert-success text-center">
                <p class="m-0">{{ session('success') }}</p>
            </div>
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger text-center">
                    <p class="mb-0">{{ $error }}</p>
                </div>
            @endforeach
        @endif
        <div class="col-12">
            <div class="cases-title bg-dark-gradient mb-5 p-3 rounded w-50 mx-auto text-center d-flex justify-content-center align-items-center" data-wow-iteration="infinite">
                <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="40" alt="logo">
                <h1 class="text-white text-decoration-underline mb-0">مشروع المقابر</h1>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">6 أكتوبر</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("october.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">الفيوم</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("fayum.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">الغفير</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("gafeer.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden mt-4">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">القطامية</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("katamya.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden mt-4">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">زينهم</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("zenhom.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden mt-4">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">15 مايو</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("15may.index")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="items bg-info-gradient p-3 rounded overflow-hidden mt-4">
                <div class="item-header">
                    <div class="item-logo text-center">
                        <img src="{{asset('icons/icons8-cemetery-30.png')}}" width="50" alt="cemetry logo">
                    </div>
                    <div class="item-title mt-2">
                        <h3 class="text-white text-center text-decoration-underline">القرية</h3>
                    </div>
                </div>
                <div class="item-footer">
                    <a href='{{route("village.all")}}' class="btn btn-primary w-100 mt-3">
                        <b>المزيد</b>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addregion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة منطقة جديدة</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('region.store') }}" method="post" id="regionForm">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-2">
                                        <input type="text" name="name" placeholder="إسم المنطقة" id="regionName" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" class="form-control text-center" required>
                                        <p class="required d-none text-danger fw-bold mb-0" id="regionNameReq">هذا الحقل مطلوب</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-2">
                                        <input type="text" name="capacity" maxlength="2" class="form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="regionPower" placeholder="قوة المنطقة" required>
                                        <p class="required d-none text-danger fw-bold mb-0" id="regionPowerReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none text-danger fw-bold mb-0" id="regionPowerMsg">يجب ان يكون الحقل مكون من 2 رقم</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="submit" value='إضافة' id="regionSubmition" class="btn btn-success w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
