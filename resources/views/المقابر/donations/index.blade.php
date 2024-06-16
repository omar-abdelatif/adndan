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
                                <li class="breadcrumb-item active">التبرعات</li>
                            </ol>
                            <button type="button" class="btn btn-primary mt-1 fw-bold" data-coreui-toggle="modal" data-coreui-target="#addnew" data-coreui-whatever="@mdo"> إضافة متبرع جديد</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة متبرع جديد</h4>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark-gradient">
                    <form action="{{route('new.tomb.donator.store')}}" method="post" id="newTombDonatorsForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-2">
                                    <label for="donatorName" class="text-white fw-bold">إسم المتبرع</label>
                                    <input type="text" class="form-control" name="name" id="tombDonatorName" placeholder="إسم المتبرع" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')">
                                    <p id="tombDonatorReq" class="required text-danger fw-bold d-none mb-0">هذا الحقل مطلوب</p>
                                    <p id="tombDonatorMsg" class="required text-danger fw-bold d-none mb-0">الأسم باللغة العربية فقط ولا يقل عن 3 أحرف</p>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="donatorName" class="text-white fw-bold">رقم المحمول</label>
                                    <input type="text" id="tombDonatorMobile" name="mobile_number" maxlength="12" class="form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="رقم المحمول" required>
                                    <p id="tombdonatorMobileReq" class="required fw-bold text-danger d-none mb-0">هذا الحقل مطلوب</p>
                                    <p id="tombdonatorMobileMsg" class=" required fw-bold text-danger d-none mb-0">يجب ان بكون رقم المحمول 11 رقماً بالاضافة الى مفتاح الدولة</p>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="donationDuration" class="text-white fw-bold">نوع المتبرع</label>
                                    <select name="donator_type" class="form-select" id="donationDuration" required>
                                        <option selected disabled>نوع المتبرع</option>
                                        <option value="شهري">شهري</option>
                                        <option value="أخرى">أخرى</option>
                                    </select>
                                    <p class="required d-none mb-0 fw-bold text-danger" id="tombDurationReq">يجب اختيار نوع المتبرع من القائمة</p>
                                    <input type="text" name="donator_duration" id="tombOtherDuration" class="form-control text-center mt-2 d-none" placeholder="حدد النوع الأحر للمتبرع" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]" disabled>
                                    <p class="d-none mb-0 text-danger fw-bold" id="tombOtherReq">هذا الحقل مطلوب</p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="tombFormSubmition" class="btn btn-success w-100 text-white fw-bold">إضافة المتوفي</button>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="donators-section-title mt-5 text-center bg-dark-gradient text-white p-3 w-50 mx-auto rounded">
                <h2 class="mb-0">متبرعين المقابر الجديدة</h2>
            </div>
            <div class="donators-content">
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
                                <th class="text-center">نوع المتبرع</th>
                                <th class="text-center">نوع التبرع الأخر</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            @foreach ($tombDonators as $donator)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$donator->name}}</td>
                                    <td>{{$donator->mobile_number}}</td>
                                    <td>{{$donator->donator_type}}</td>
                                    <td>
                                        @if ($donator->donator_duration)
                                            {{$donator->donator_duration}}
                                        @else
                                            <span class="fw-bold">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- ! Donation History ! --}}
                                        <a href="{{route("new.tomb.donator.donation.history", $donator->id)}}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{-- ! Update Donators ! --}}
                                        <button type="button" class="btn btn-warning rounded" data-coreui-toggle="modal" data-coreui-target="#edit{{$donator->id}}" data-coreui-whatever="@mdo">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <div class="modal fade" id="edit{{$donator->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title text-decoration-underline" id="exampleModalLabel">تعديل {{$donator->name}}</h3>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body bg-dark-gradient">
                                                        <form action="{{route("new.tomb.donator.update")}}" method="post" data-newdonator-id={{$donator->id}}>
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <input type="hidden" name="id" value="{{$donator->id}}">
                                                                    <div class="form-group mb-2">
                                                                        <label for="donatorName" class="text-white fw-bold">إسم المتبرع</label>
                                                                        <input type="text" class="form-control" name="name" id="tombDonatorName" value="{{$donator->name}}" data-donationName-id={{$donator->id}} placeholder="إسم المتبرع" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]{3,}">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="donatorName" class="text-white fw-bold">رقم المحمول</label>
                                                                        <input type="text" id="tombDonatorMobile" name="mobile_number" maxlength="12" data-donationMobile-id={{$donator->id}} value="{{$donator->mobile_number}}" class="form-control text-center" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="رقم المحمول">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="donationDuration" class="text-white fw-bold">نوع المتبرع</label>
                                                                        <select name="donator_type" class="form-select" id="donationDuration" data-donatortype-id={{$donator->id}}>
                                                                            <option selected disabled>نوع المتبرع</option>
                                                                            <option value="شهري" {{$donator->donator_type === 'شهري' ? 'selected' : ''}}>شهري</option>
                                                                            <option value="أخرى" {{$donator->donator_type === 'أخرى' ? 'selected' : ''}}>أخرى</option>
                                                                        </select>
                                                                        <input type="text" name="donator_duration" id="tombOtherDuration" value="{{$donator->donator_duration}}" data-donatorduration-id={{$donator->id}} class="form-control text-center mt-2 d-none" placeholder="حدد النوع الأحر للمتبرع" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" id="tombFormSubmition" data-donatorsubmition-id={{$donator->id}} class="btn btn-success w-100 text-white fw-bold">إضافة المتوفي</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ! Delete Donators ! --}}
                                        <button type="button" class="btn btn-danger rounded" data-coreui-toggle="modal" data-coreui-target="#delete{{$donator->id}}" data-coreui-whatever="@mdo">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <div class="modal fade" id="delete{{$donator->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title text-decoration-underline" id="exampleModalLabel">حذف {{$donator->name}}</h3>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body bg-dark-gradient">
                                                        <form action="{{route("new.tomb.donator.destroy", $donator->id)}}" method="get">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-title text-center">
                                                                        <h3 class="text-white my-3">هل أنت متأكد من الحذف</h3>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">إلغاء</button>
                                                                        <button type="submit" role="button" class="btn btn-primary fw-bold">تأكيد</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection






