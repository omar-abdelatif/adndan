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
                                <li class="breadcrumb-item active">كل المقابر</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#addtomb" data-coreui-whatever="@mdo">
                                <b>إضافة مقبرة</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alltombs">
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
                <table class="table borderd-table display align-middle text-center" id="table21" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                    <thead>
                        <tr>
                            <th class="text-center">الإسم</th>
                            <th class="text-center">نوع المقبرة</th>
                            <th class="text-center">تخصص المقبرة</th>
                            <th class="text-center">قوة المقبرة</th>
                            <th class="text-center">المنطقة</th>
                            <th class="text-center">قمة الدفع السنوي</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tomb as $tomb)
                            <tr>
                                <td>{{$tomb->name}}</td>
                                <td>{{$tomb->type}}</td>
                                <td class="fw-bold">
                                    @if ($tomb->tomb_specifices === "0")
                                        مختلط
                                    @elseif ($tomb->tomb_specifices === "1")
                                        رجال
                                    @elseif ($tomb->tomb_specifices === "2")
                                        سيدات
                                    @else
                                        ـــــ
                                    @endif
                                </td>
                                <td class="fw-bold">
                                    @if ($tomb->power === 0)
                                        {{$tomb->other_tomb_power}} - لحد
                                    @else
                                        {{$tomb->power}} - غرف
                                    @endif
                                </td>
                                <td>{{$tomb->region}}</td>
                                <td>{{$tomb->annual_cost}}</td>
                                <td>
                                    {{-- <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit{{$tomb->id}}" data-coreui-whatever="@mdo">
                                        <b>تعديل</b>
                                    </button>
                                    <div class="modal fade" id="edit{{$tomb->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">تعديل مقبرة {{$tomb->name}}</h1>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body bg-dark-gradient">
                                                    <form action="{{route('tomb.update')}}" method="post" data-tombPower-id="{{$tomb->id}}">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="hidden" name="id" value="{{$tomb->id}}">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-2">
                                                                    <input type="text" name="name" value="{{$tomb->name}}" placeholder="إسم المقبرة" class="form-control text-center">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <select name="power" class="form-select" data-powerselect-id="{{$tomb->id}}">
                                                                        <option class="text-center" selected disabled>قوة المقبرة</option>
                                                                        <option value="2" {{$tomb->power  == '2' ? 'selected' : ''}}>2</option>
                                                                        <option value="4" {{$tomb->power  == '4' ? 'selected' : ''}}>4</option>
                                                                        <option value="6" {{$tomb->power  == '6' ? 'selected' : ''}}>6</option>
                                                                        <option value="0" {{$tomb->power  == '0' ? 'selected' : ''}}>أخرى</option>
                                                                    </select>
                                                                    <input type="number" name="other_tomb_power" value="{{$tomb->other_tomb_power}}" id="otherPower" class="form-control d-none mt-2" placeholder="قوة مقبرة اللحود" disabled data-otherpowerselect-id="{{$tomb->id}}">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <select name="tomb_specifices" id="tombSpecifices" class="form-select">
                                                                        <option selected disabled>تخصص المقبره</option>
                                                                        <option value="0" {{$tomb->tomb_specifices === "0" ? "selected" : ""}}>مختلط</option>
                                                                        <option value="1" {{$tomb->tomb_specifices === "1" ? "selected" : ""}}>رجال</option>
                                                                        <option value="2" {{$tomb->tomb_specifices === "2" ? "selected" : ""}}>سيدات</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <select name="type" class="form-select mb-2">
                                                                        <option class="text-center" selected disabled>إختار نوع المقبرة</option>
                                                                        <option value="لحد" {{$tomb->type  == 'لحد' ? 'selected' : ''}}>لحد</option>
                                                                        <option value="عيون" {{$tomb->type  == 'عيون' ? 'selected' : ''}}>عيون</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <select name="region" class="form-select">
                                                                        <option selected disabled>إختار المنطقة</option>
                                                                        @if ($regionCount > 0)
                                                                            @foreach ($region as $regions)
                                                                                <option value="{{$regions->name}}" {{$tomb->region == $regions->name ? 'selected' : ''}}>{{$regions->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <input type="number" name="annual_cost" value="{{$tomb->annual_cost}}" class="form-control text-center" placeholder="قيمة الدفع السنوي">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input type="submit" value="تعديل" class="btn btn-success w-100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <a href="{{route('tomb.destroy',$tomb->id)}}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addtomb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة مقبرة جديدة</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark-gradient">
                    <form action="{{route('tombs.store')}}" method="post" id="newTombForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="name" placeholder="إسم المقبرة" id="tombName" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s\d\/\-\.\,]/g, '')" class="form-control text-center" required>
                                    <p class="required d-none text-danger mb-0 fw-bold" id="tombReq">هذا الحقل مطلوب</p>
                                    <p class="required d-none text-danger mb-0 fw-bold" id="tombMsg">يجب ان يكون اسم المقبره مكون من 3 احرف على الاقل</p>
                                </div>
                                <div class="form-group mb-2">
                                    <select name="power" class="form-select" id="tombPower" required>
                                        <option class="text-center" selected disabled>قوة المقبرة (بالغرف)</option>
                                        <option value="2">2</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="أخرى">أخرى</option>
                                    </select>
                                    <p class="required d-none text-danger fw-bold mb-0" id="powerReq">اختار من القائمة اعلاه</p>
                                    <input type="text" name="other_tomb_power" maxlength="2" minlength="2" id="otherPower" class="form-control d-none mt-2" placeholder="قوة مقبرة" disabled>
                                    <p class="required d-none text-danger fw-bold mb-0" id="otherPowerReq">هذا الحقل مطلوب</p>
                                </div>
                                <div class="form-group mb-2">
                                    <select name="tomb_specifices" id="tombSpecifices" class="form-select" required>
                                        <option selected disabled>تخصص المقبره</option>
                                        <option value="0">مختلط</option>
                                        <option value="1">رجال</option>
                                        <option value="2">سيدات</option>
                                    </select>
                                    <p class="required d-none text-danger fw-bold mb-0" id="tombSpecificesReq">اختار من القائمة اعلاه</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <select name="type" class="form-select" id="tombType" required>
                                        <option class="text-center" selected disabled>نوع المقبرة</option>
                                        <option value="لحد">لحد</option>
                                        <option value="عيون">عيون</option>
                                    </select>
                                    <p class="required d-none text-danger fw-bold mb-0" id="typeReq">اختار من القائمة اعلاه</p>
                                </div>
                                <div class="form-group mb-2">
                                    <select name="region" class="form-select" id="tombRegion" required>
                                        <option selected disabled>المنطقة</option>
                                        @foreach ($region as $region)
                                            <option value="{{$region->name}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="required d-none text-danger fw-bold mb-0" id="regionReq">اختار من القائمة اعلاه</p>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" name="annual_cost" class="form-control text-center" minlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="tombCost" placeholder="قيمة الدفع السنوي" required>
                                    <p class="required text-danger mb-0 fw-bold d-none" id="costReq">هذا الحقل مطلوب</p>
                                    <p class="required text-danger mb-0 fw-bold d-none" id="costMsg">يجب ان لا يقل المبلغ عن 2 رقم</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" value="إضافة" id="tombSubmit" class="btn btn-success w-100">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
