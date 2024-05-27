@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
        <div class="header-divider"></div>
        <section class="content-header w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('showall') }}">الكفالة</a>
                                </li>
                                <li class="breadcrumb-item active">كل المتبرعين</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#add_donation" data-coreui-whatever="@mdo">
                                <b>إضافة متبرع</b>
                            </button>
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
    <table class="table borderd-table display align-middle text-center" id="table1" data-order='[[ 0, "asc" ]]' data-page-length='10'>
        <thead>
            <tr>
                <td class="text-center">id</td>
                <td class="text-center">الإسم</td>
                <td class="text-center">رقم التلفون</td>
                <td class="text-center">المدة الزمنية</td>
                <td class="text-center">المدة الأخرى</td>
                <td class="text-center">تاريخ التسجيل</td>
                <td class="text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($donator as $donate)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $donate->name }}</td>
                    <td>{{ $donate->mobile_phone }}</td>
                    <td>{{ $donate->duration }}</td>
                    <td>
                        @if ($donate->other_duration)
                            {{ $donate->other_duration }}
                        @else
                            <span class="fw-bold">-</span>
                        @endif
                    </td>
                    <td>{{ $donate->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ url('all_donations/' . $donate->id) }}" class="btn btn-success text-white">
                            <b>History</b>
                        </a>
                        <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit_{{ $donate->id }}" data-coreui-whatever="@mdo">
                            <b>تعديل</b>
                        </button>
                        <div class="modal fade" dir="rtl" id="edit_{{ $donate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">بيانات المتبرع كاملة</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('donator.update') }}" method="post">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="inputs">
                                                            <div class="inputs-title mb-2">
                                                                <h3 class="mb-2 bg-primary p-2 rounded text-white">تعديل البيانات الشخصية</h3>
                                                            </div>
                                                            <div class="inputs-body">
                                                                <input type="hidden" name="id" value="{{ $donate->id }}">
                                                                <div class="form-groups mb-2">
                                                                    <label for="name">
                                                                        <b>الإسم الكامل:</b>
                                                                    </label>
                                                                    <input type="text" id="name" name="name" value="{{ $donate->name }}" class="form-control text-center border-dark" placeholder="إسم المتبرع">
                                                                </div>
                                                                <div class="form-groups mb-2">
                                                                    <label for="phone_number">
                                                                        <b>رقم المحمول:</b>
                                                                    </label>
                                                                    <input type="number" id="phone_number" name="mobile_phone" value="{{ $donate->mobile_phone }}" class="form-control text-center border-dark" placeholder="رقم المحمول">
                                                                </div>
                                                                <div class="form-groups mb-2">
                                                                    <label for="address">
                                                                        <b>المدة الزمنية:</b>
                                                                    </label>
                                                                    <input type="text" name="duration" class="form-control text-center border-dark" value="{{$donate->duration}}" placeholder="المدة الزمنية">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="submit" class="btn btn-success mt-3 d-block w-100 text-white" height="50px" value="إرسال">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <a href="{{ url('delete-donator/' . $donate->id) }}" class="btn btn-danger mt-3 w-100 text-white">
                                            <b>حذف</b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" style="border-radius: 40px" class="btn btn-info text-white" data-coreui-toggle="modal" data-coreui-target="#donation_{{ $donate->id }}" data-coreui-whatever="@mdo">
                            <b>إضافة تبرع</b>
                        </button>
                        <div class="modal fade" dir="rtl" id="donation_{{ $donate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">إضافة تبرع جديد</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <form action="{{ route('donation.store') }}" method="post" data-donation-id={{$donate->id}}>
                                            @csrf
                                            <div class="data-info bg-light p-3 rounded">
                                                <div class="data-info-title mt-3">
                                                    <h3 class="text-center text-dark text-decoration-underline mb-3">البيانات الشخصية</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-2">
                                                            <input type="text" id="name" name="name" value="{{ $donate->name }}" class="form-control text-center border-dark" placeholder="إسم المتبرع" readonly>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="number" id="phone_number" name="mobile_phone" value="{{ $donate->mobile_phone }}" class="form-control text-center border-dark" placeholder="رقم المحمول" readonly>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <select name="donation_type" class="form-select donationType" id="donationType" data-donationtype-id={{$donate->id}} required>
                                                                <option selected disabled>نوع التبرع</option>
                                                                <option value="نقدي">نقدي</option>
                                                                <option value="أخرى">أخرى</option>
                                                            </select>
                                                            <p class="required d-none text-danger fw-bold mb-0 donationtypeReq" data-donationtype-id={{$donate->id}}>أختر من القائمة اعلاه</p>
                                                            <select name="money_type" class="form-select money_type d-none mt-2" data-donationmoneytype-id={{$donate->id}} id="money_type">
                                                                <option selected disabled>نوع التبرع النقدي</option>
                                                                <option value="صدقات">صدقات</option>
                                                                <option value="نقدي">ذكات فطر</option>
                                                                <option value="أخرى">ذكات مال</option>
                                                            </select>
                                                            <p class="required d-none text-danger fw-bold mb-0 donationmoneytype" data-donationmoneytype-id={{$donate->id}}>أختر من القائمة اعلاه</p>
                                                            <input type="text" name="other_type" class="form-control otherDonationType mt-2 d-none" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]{3,}" data-donationothertype-id={{$donate->id}} placeholder="نوع التبرع الأخر">
                                                            <p class="required d-none text-danger fw-bold mb-0 donationothertype" data-donationothertype-id={{$donate->id}}>هذا الحقل مطلوب</p>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" name="amount" class="form-control text-center amount" minlength="2" placeholder="المبلغ المتبرع" data-donationamount-id={{$donate->id}} required>
                                                            <p class="required d-none text-danger fw-bold mb-0 donationamountReq" data-donationamount-id={{$donate->id}}>هذا الحقل مطلوب</p>
                                                            <p class="required d-none text-danger fw-bold mb-0 donationamountMsg" data-donationamount-id={{$donate->id}}>يجب ان يكون المبلغ لا يقل عن 2 رقم</p>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" name="invoice_no" class="form-control text-center invoice" placeholder="رقم الإيصال" data-inv-id={{$donate->id}} required>
                                                            <p class="required d-none text-danger fw-bold mb-0 invReq" data-inv-id={{$donate->id}}>هذا الحقل مطلوب</p>
                                                            <p class="required d-none text-danger fw-bold mb-0 invMsg" data-inv-id={{$donate->id}}>يجل ان يكون رقم اليصال مكون من 5 أرقام</p>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <select name="duration[]" class="form-multi-select duration" data-duration-id={{$donate->id}} multiple required>
                                                                <option value="يناير">يناير</option>
                                                                <option value="فبراير">فبراير</option>
                                                                <option value="مارس">مارس</option>
                                                                <option value="إبريل">إبريل</option>
                                                                <option value="مايو">مايو</option>
                                                                <option value="يونيه">يونيه</option>
                                                                <option value="يوليو">يوليو</option>
                                                                <option value="أغسطس">أغسطس</option>
                                                                <option value="سبتمبر">سبتمبر</option>
                                                                <option value="أكتوبر">أكتوبر</option>
                                                                <option value="نوفمبر">نوفمبر</option>
                                                                <option value="ديسمبر">ديسمبر</option>
                                                            </select>
                                                            <p class="required d-none text-danger fw-bold mb-0 durReq" data-duration-id={{$donate->id}}>إختر من القائمة أعلاه</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" data-donationSubmit-id={{$donate->id}} class="btn btn-primary mt-3 d-block w-100 text-white" value="إرسال">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" dir="rtl" id="add_donation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة متبرع جديد</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('donator.store')}}" method="post" id="newDonators">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-2">
                                    <input type="text" name="name" id="DonatorName" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]{3,}" class="form-control text-center" placeholder="إسم المتبرع" required>
                                    <p id="DonatorReq" class="required text-danger fw-bold d-none mb-0">هذا الحقل مطلوب</p>
                                    <p id="DonatorMsg" class="required text-danger fw-bold d-none mb-0">الأسم باللغة العربية فقط ولا يقل عن 3 أحرف</p>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" id="DonatorMobile" name="mobile_phone" maxlength="11" class="form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="رقم المحمول" required>
                                    <p id="donatorMobileReq" class="required fw-bold text-danger d-none mb-0">هذا الحقل مطلوب</p>
                                    <p id="donatorMobileMsg" class=" required fw-bold text-danger d-none mb-0">يجب ان بكون رقم المحمول 11 رقماً لا غير</p>
                                </div>
                                <div class="form-group mb-2">
                                    <select name="duration" class="form-select" id="duration" required>
                                        <option>نوع المتبرع</option>
                                        <option value="شهري">شهري</option>
                                        <option value="أخرى">أخرى</option>
                                    </select>
                                    <p class="required d-none mb-0 fw-bold text-danger" id="durationReq">يجب اختيار نوع المتبرع من القائمة</p>
                                    <input type="text" name="other_duration" id="otherDuration" class="form-control text-center mt-2" placeholder="حدد المده" disabled>
                                    <p class="d-none mb-0 text-danger fw-bold" id="otherReq">هذا الحقل مطلوب</p>
                                    <p class="d-none mb-0 text-danger fw-bold" id="otherMsg">يجب ان يكون اسم الحرفة باللغة العربية و لا يقل عن 3 احرف</p>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="DonatorsSubmit" class="btn btn-success w-100 mt-3 text-center text-white">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
