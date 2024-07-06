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
                                    <a href="{{ route('region.index') }}">كل المقابر</a>
                                </li>
                                <li class="breadcrumb-item active">كل المتوفيين</li>
                            </ol>
                            <button type="button" class="btn btn-success rounded" data-coreui-toggle="modal" data-coreui-target="#addnew" data-coreui-whatever="@mdo">
                                <b>إضافة متوفي جديد</b>
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
        <div class="col-lg-12">
            <div class="deceased-section-title mt-5 text-center bg-dark-gradient text-white p-3 w-50 mx-auto rounded">
                <h2 class="mb-0">كل المتوفيين</h2>
            </div>
            <div class="deceased-content">
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
                            <th class="text-center">#</th>
                            <th class="text-center">إسم المتوفي</th>
                            <th class="text-center">مكان الوفاه</th>
                            <th class="text-center">تاريخ الوفاه</th>
                            <th class="text-center">تاريخ الدفن</th>
                            <th class="text-center">Actions</th>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            @foreach ($deceased as $deceased)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td class="text-center">{{$deceased->name}}</td>
                                <td class="text-center">{{$deceased->death_place}}</td>
                                <td class="text-center">{{$deceased->death_date}}</td>
                                <td class="text-center">{{$deceased->burial_date}}</td>
                                <td class="text-center">
                                    <a href="{{url('delete_deceased/'.$deceased->id)}}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <button type="button" class="btn btn-warning rounded" data-coreui-toggle="modal" data-coreui-target="#edit{{$deceased->id}}" data-coreui-whatever="@mdo">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="edit{{$deceased->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">تعديل {{$deceased->name}}</h1>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body bg-dark">
                                                    <form action="{{route('deceased.update')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <input type="hidden" class="form-control" name="id" value="{{$deceased->id}}">
                                                                <div class="col-6">
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="name">
                                                                            <b>إسم المتوفي</b>
                                                                        </label>
                                                                        <input type="text" id="name" class="form-control text-center" value="{{$deceased->name}}" name="name" placeholder="إسم المتوفي">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="death_place">
                                                                            <b>مكان الوفاة</b>
                                                                        </label>
                                                                        <input type="text" id="death_place" class="form-control text-center" value="{{$deceased->death_place}}" name="death_place" placeholder="مكان الوفاة">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="death_date">
                                                                            <b>تاريخ الوفاة</b>
                                                                        </label>
                                                                        <input type="date" id="death_date" class="form-control text-center" value="{{$deceased->death_date}}" name="death_date" placeholder="تاريخ الوفاة">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="burial_date">
                                                                            <b>تاريخ الدفن</b>
                                                                        </label>
                                                                        <input type="date" id="burial_date" class="form-control text-center" value="{{$deceased->burial_date}}" name="burial_date" placeholder="تاريخ الدفن">
                                                                    </div>
                                                                    <div class="form-group mt-3 text-center">
                                                                        <label class="text-white" for="files">
                                                                            <b>ملفات</b>
                                                                        </label>
                                                                        <input type="file" name="files" value="{{$deceased->files}}" class="form-control mb-3" accept="image/*">
                                                                        <a href="{{url('build/assets/backend/files/tombs/imgs/'.$deceased->files)}}" target="_blank">
                                                                            <img src="{{asset('build/assets/backend/files/tombs/imgs/'.$deceased->files)}}" class="rounded-circle d-block mx-auto" width="100" alt="{{$deceased->name}}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="files">
                                                                            <b>ملفات PDF</b>
                                                                        </label>
                                                                        <input type="file" name="pdf_files" value="{{$deceased->pdf_files}}" class="form-control mb-3" accept="application/pdf">
                                                                        <a href="{{asset('build/assets/backend/files/tombs/pdf/'.$deceased->pdf_files)}}" class="d-block text-white">
                                                                            <i class="fas fa-file-pdf fa-3x"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="the_washer">
                                                                            <b>القائم بالغسل</b>
                                                                        </label>
                                                                        <input type="text" id="the_washer" class="form-control text-center" value="{{$deceased->washer}}" name="washer" placeholder="القائم بالغسل">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="the_carrier">
                                                                            <b>القائم بالنقل</b>
                                                                        </label>
                                                                        <input type="text" id="the_carrier" class="form-control text-center" value="{{$deceased->carrier}}" name="carrier" placeholder="القائم بالنقل">
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="region">
                                                                            <b>المنطقة:</b>
                                                                            {{$deceased->region}}
                                                                        </label>
                                                                        <select name="region" id="region" class="form-control">
                                                                            <option value="0" selected>-- إختار المنطقة --</option>
                                                                            @foreach ($regions as $region)
                                                                                <option value="{{ $region->name }}">{{ $region->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="tomb">
                                                                            <b>إسم المقبرة:</b>
                                                                            {{$deceased->tomb}}
                                                                        </label>
                                                                        <select name="tomb" id="regionTomb" class="form-control regionTomb">
                                                                            <option value="0" selected>-- إختار المقبرة --</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white" for="room">
                                                                            <b>رقم الغرفة:</b>
                                                                            {{$deceased->room}}
                                                                        </label>
                                                                        <select name="room" id="room" class="form-control roomTomb">
                                                                            <option value="">-- إختار الغرفة --</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-data mt-3">
                                                                        <label class="text-white" for="burial_date">
                                                                            <b>الجنس</b>
                                                                        </label>
                                                                        <div class="gender mt-3 d-flex justify-content-evenly align-items-center">
                                                                            <div class="male">
                                                                                <input type="radio" name="gender" value="ذكر" id="male" {{$deceased->gender == 'ذكر' ? 'checked' : ''}}>
                                                                                <label class="text-white" for="male">
                                                                                    <b>ذكر</b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="female">
                                                                                <input type="radio" name="gender" id="female" value="أنثى" {{$deceased->gender == 'أنثى' ? 'checked' : ''}}>
                                                                                <label class="text-white" for="female">
                                                                                    <b>أنثى</b>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-data mt-3">
                                                                        <label class="text-white" for="burial_date">
                                                                            <b>الحجم</b>
                                                                        </label>
                                                                        <div class="gender mt-3 d-flex justify-content-evenly align-items-center">
                                                                            <div class="male">
                                                                                <input type="radio" name="size" value="1" id="one" {{$deceased->size == 1 ? 'checked' : ''}}>
                                                                                <label class="text-white" for="male">
                                                                                    <b>فردي</b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="female">
                                                                                <input type="radio" name="size" value="2" id="two" {{$deceased->size == 2 ? 'checked' : ''}}>
                                                                                <label class="text-white" for="female">
                                                                                    <b>زوجي</b>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label class="text-white">
                                                                            <b>العمر</b>
                                                                        </label>
                                                                        <div class="gender mt-3 d-flex justify-content-evenly align-items-center">
                                                                            <div class="adult">
                                                                                <input type="radio" name="age" value="بالغ" {{$deceased->age === 'بالغ' ? 'checked' : ''}}>
                                                                                <label for="adult" class="text-white">
                                                                                    <b>بالغ</b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="kid">
                                                                                <input type="radio" name="age" value="طفل" {{$deceased->age === 'طفل' ? 'checked' : ''}}>
                                                                                <label for="kid" class="text-white">
                                                                                    <b>طفل</b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="part">
                                                                                <input type="radio" name="age" value="عضو" {{$deceased->age === 'عضو' ? 'checked' : ''}}>
                                                                                <label for="part" class="text-white">
                                                                                    <b>عضو</b>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-data mt-3">
                                                                        <label for="burial_cost" class="text-white">
                                                                            <b>تكلفة الدفن</b>
                                                                        </label>
                                                                        <input type="number" id="burial_cost" class="form-control text-center" value="{{$deceased->burial_cost}}" name="burial_cost" placeholder="تكلفة الدفن">
                                                                    </div>
                                                                    <div class="textarea mt-4">
                                                                        <label class="text-white" for="notes">
                                                                            <b>ملاحظـــــــات</b>
                                                                        </label>
                                                                        <textarea id="notes" class="form-control text-center" name="notes" rows="5" placeholder="ملاحظـــــــات">{{$deceased->notes}}</textarea>
                                                                    </div>
                                                                    <div class="field mt-3">
                                                                        <button type="submit" class="btn btn-success w-100 text-white">
                                                                            <b>تعديل</b>
                                                                        </button>
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
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة متوفي جديد</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark-gradient">
                    <form action="{{route('deceased.store')}}" method="post" enctype="multipart/form-data" id="deceasedForm">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <label for="deceasedName" class="text-white">
                                            <b>إسم المتوفي</b>
                                        </label>
                                        <input type="text" id="deceasedName" class="form-control text-center" name="name" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s\/\-_()\[\]]/g, '')" pattern="[\u0600-\u06FF\s\/\-_()\[\]]{3,}" placeholder="إسم المتوفي" required>
                                        <p class="required d-none text-danger fw-bold mb-2" id="deceasedNameReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none text-danger fw-bold mb-2" id="deceasedNameMsg">يجب ان يكون الاسم مكون من 3 احرف على الاقل</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="death_place" class="text-white">
                                            <b>مكان الوفاة</b>
                                        </label>
                                        <input type="text" id="death_place" class="form-control text-center" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" name="death_place" placeholder="مكان الوفاة" required>
                                        <p class="required d-none text-danger fw-bold mb-0" id="deathPlaceReq">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="death_date" class="text-white">
                                            <b>تاريخ الوفاة</b>
                                        </label>
                                        <input type="date" id="death_date" class="form-control text-center" name="death_date" placeholder="تاريخ الوفاة" required>
                                        <p class="required d-none text-danger fw-bold mb-2" id="death_date_req">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="burial_date" class="text-white">
                                            <b>تاريخ الدفن</b>
                                        </label>
                                        <input type="date" id="burial_date" class="form-control text-center" name="burial_date" placeholder="تاريخ الدفن" required>
                                        <p class="required d-none text-danger fw-bold mb-2" id="burial_date_req">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="burial_cost" class="text-white">
                                            <b>تكلفة الدفن</b>
                                        </label>
                                        <input type="text" id="burial_cost" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control text-center" name="burial_cost" placeholder="تكلفة الدفن" required>
                                        <p class="required d-none text-danger fw-bold mb-2" id="burial_cost_req">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="gender" class="text-white">
                                            <b>الجنس</b>
                                        </label>
                                        <select name="gender" class="form-select" id="gender" required>
                                            <option selected disabled>جنس المتوفي</option>
                                            <option value="ذكر">ذكر</option>
                                            <option value="أنثى">أنثى</option>
                                        </select>
                                        <p class="required d-none text-danger fw-bold mb-0" id="genReq">أختر من القائمة أعلاه</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="size" class="text-white">
                                            <b>الحجم</b>
                                        </label>
                                        <select name="size" class="form-select" id="size" required>
                                            <option selected disabled>حجم المتوفي</option>
                                            <option value="1">فردي</option>
                                            <option value="2">زوجي</option>
                                            <option value="6">لحد (فقط)</option>
                                        </select>
                                        <p class="required d-none text-danger fw-bold mb-0" id="sizeReq">أختر من القائمة أعلاه</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="text-white" for="age">
                                            <b>العمر</b>
                                        </label>
                                        <select name="age" class="form-select" id="age" required>
                                            <option selected disabled>سن المتوفي</option>
                                            <option value="بالغ">بالغ</option>
                                            <option value="طفل">طفل</option>
                                            <option value="عضو">عضو</option>
                                        </select>
                                        <p class="required d-none text-danger fw-bold mb-0" id="ageReq">أختر من القائمة أعلاه</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <label for="imgs" class="text-white">
                                            <b>صور</b>
                                        </label>
                                        <input type="file" name="files" id="imgs" class="form-control text-center" accept="image/*">
                                        <p class="required d-none fw-bold text-danger mb-0" id="ImgsReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none fw-bold text-danger mb-0" id="ImgsExt">يجب ان يكون امتداد الصورة [ jpg, png, jpeg, webp ]</p>
                                        <p class="required d-none fw-bold text-danger mb-0" id="ImgsSize">يجب ان يكون حجم الصورة اقل من 2 ميجا</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="pdfs" class="text-white">
                                            <b>ملفات PDF</b>
                                        </label>
                                        <input type="file" name="pdf_files" id="pdfs" class="form-control text-center" accept="application/pdf">
                                        <p class="required d-none fw-bold text-danger mb-0" id="PdfReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none fw-bold text-danger mb-0" id="PdfExt">يجب ان يكون امتداد الصورة [ jpg, png, jpeg, webp ]</p>
                                        <p class="required d-none fw-bold text-danger mb-0" id="PdfSize">يجب ان يكون حجم الصورة اقل من 2 ميجا</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="the_washer" class="text-white">
                                            <b>القائم بالغسل</b>
                                        </label>
                                        <input type="text" id="the_washer" class="form-control text-center" name="washer" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s\d\/\-\.\,]/g, '')" placeholder="القائم بالغسل" required>
                                        <p class="required d-none text-danger fw-bold mb-0" id="washerReq">هذ الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="the_carrier" class="text-white">
                                            <b>القائم بالنقل</b>
                                        </label>
                                        <input type="text" id="the_carrier" class="form-control text-center" name="carrier" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s\d\/\-\.\,]/g, '')" placeholder="القائم بالنقل" required>
                                        <p class="required d-none text-danger fw-bold mb-0" id="carrierReq">هذ الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="region" class="text-white">
                                            <b>المنطقة</b>
                                        </label>
                                        <select name="region" id="region" class="form-control" required>
                                            <option selected disabled>المنطقة</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->name }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="required d-none text-danger fw-bold mb-0" id="regionReq">إختر من القائمة أعلاه</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="tomb" class="text-white">
                                            <b>إسم المقبرة</b>
                                        </label>
                                        <select name="tomb" id="regionTomb" class="form-control regionTomb" required>
                                            <option selected>المقبرة</option>
                                        </select>
                                        <p class="required d-none text-danger fw-bold mb-0" id="tombReq">إختر من القائمة السابقة أولا</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="room" class="text-white">
                                            <b>رقم الغرفة</b>
                                        </label>
                                        <select name="room" id="room" class="form-control roomTomb" required>
                                            <option selected>الغرفة</option>
                                        </select>
                                        <p class="required d-none text-danger fw-bold mb-0" id="roomReq">إختر من القائمة السابقة أولا</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="textarea mt-4">
                                        <label for="notes" class="text-white">
                                            <b>ملاحظـــــــات</b>
                                        </label>
                                        <textarea id="notes" class="form-control text-center" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" name="notes" rows="5" placeholder="ملاحظـــــــات" required></textarea>
                                        <p class="required d-none text-danger fw-bold mb-0" id="notesReq">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="field mt-3">
                                        <button type="submit" id="deceasedSubmit" class="btn btn-success w-100 text-white">
                                            <b>إضافة المتوفي</b>
                                        </button>
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
