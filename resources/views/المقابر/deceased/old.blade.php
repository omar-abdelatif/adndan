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
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">المتوفيين السابقين</li>
                            </ol>
                            <div class="buttons">
                                <button type="button" class="btn btn-primary mt-1" data-coreui-toggle="modal" data-coreui-target="#addcsv" data-coreui-whatever="@mdo"> Upload User Excel Sheet </button>
                                <button type="button" class="btn btn-primary mt-1" data-coreui-toggle="modal" data-coreui-target="#addnew" data-coreui-whatever="@mdo"> إضافة متوفي سابق جديد </button>
                            </div>
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
            <div class="old-title mt-5 bg-primary-gradient rounded w-50 mx-auto text-white p-3 text-center">
                <h1>المتوفيين السابقين</h1>
            </div>
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
            <table class="table borderd-table display align-middle text-center" id="table10" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">الاسم</th>
                        <th class="text-center">مكان الدفن</th>
                        <th class="text-center">تاريخ الوفاه</th>
                        <th class="text-center">تاريخ الدفن</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach ($oldDeceased as $oldDeceased)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td class="text-center">{{$oldDeceased->name}}</td>
                            <td class="text-center">{{$oldDeceased->region}} / {{$oldDeceased->tomb}}</td>
                            <td class="text-center">{{$oldDeceased->death_date}}</td>
                            <td class="text-center">{{$oldDeceased->burial_date}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning rounded" data-coreui-toggle="modal" data-coreui-target="#edit{{$oldDeceased->id}}" data-coreui-whatever="@mdo">
                                    <i class="fa fa-edit fa-fade fa-lg"></i>
                                    <b class="fa-fade">تعديل</b>
                                </button>
                                <div class="modal fade" id="edit{{$oldDeceased->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">تعديل {{$oldDeceased->name}}</h1>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bg-dark-gradient">
                                                <form action="{{route('old.update')}}" method="post">
                                                    @csrf
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <input type="hidden" name="id" value="{{$oldDeceased->id}}">
                                                            <div class="col-lg-6">
                                                                <div class="field mt-2">
                                                                    <div class="form-group">
                                                                        <label for="name" class="label text-white">
                                                                            <b>الاسم</b>
                                                                        </label>
                                                                        <input type="text" name="name" class="form-control" id="name" value="{{$oldDeceased->name}}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="field mt-2">
                                                                    <div class="form-group">
                                                                        <label for="region" class="label text-white">
                                                                            <b>المنطقة</b>
                                                                        </label>
                                                                        <input type="text" name="region" class="form-control" id="region" value="{{$oldDeceased->region}}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="field mt-2">
                                                                    <div class="form-group">
                                                                        <label for="tomb" class="label text-white">
                                                                            <b>المقبره</b>
                                                                        </label>
                                                                        <input type="text" name="tomb" class="form-control" id="tomb" value="{{$oldDeceased->tomb}}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="field mt-2">
                                                                    <div class="form-group">
                                                                        <label for="death_date" class="label text-white">
                                                                            <b>تاريخ الوفاة</b>
                                                                        </label>
                                                                        <input type="date" name="death_date" class="form-control" id="death_date" value="{{$oldDeceased->death_date}}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="field mt-2">
                                                                    <div class="form-group">
                                                                        <label for="burial_date" class="label text-white">
                                                                            <b>تاريخ الدفن</b>
                                                                        </label>
                                                                        <input type="date" name="burial_date" class="form-control" id="burial_date" value="{{$oldDeceased->burial_date}}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="field mt-3">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-success w-100">
                                                                            <b>تعديل</b>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger rounded ms-2" data-coreui-toggle="modal" data-coreui-target="#delete{{$oldDeceased->id}}" data-coreui-whatever="@mdo">
                                    <i class="fa-solid fa-trash fa-fade fa-lg"></i>
                                    <b class="fa-fade">حذف</b>
                                </button>
                                <div class="modal fade" id="delete{{$oldDeceased->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title text-decoration-underline" id="exampleModalLabel">حذف {{$oldDeceased->name}}</h3>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('old.delete', $oldDeceased->id)}}" method="get">
                                                    @csrf
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="confirm_msg mb-3">
                                                                    <h2 class="text-center">هل أنت متأكد من الحذف ؟</h2>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center w-100">
                                                                    <div class="field">
                                                                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                                                                    </div>
                                                                    <div class="field">
                                                                        <button type="submit" class="btn btn-danger w-100 text-white">
                                                                            <b>حذف</b>
                                                                        </button>
                                                                    </div>
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
    <div class="upload-csv mt-1">
        <div class="modal fade" id="addcsv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة مجموعة متوفيين</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('old.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="file" name="excel" class="form-control">
                                        <input type="submit" class="btn btn-primary mt-3 d-block w-100" height="50px" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة متوفي جديد</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark-gradient">
                    <form action="{{ route('old.store') }}" method="post" id="OldDeceasedForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="oldDeceasedName" class="text-white">
                                <b>الاسم</b>
                            </label>
                            <input type="text" class="form-control" id="oldDeceasedName" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]{3,}" name="name" placeholder="الاسم" required>
                            <p class="required d-none text-danger mb-0 fw-bold" id="oldReq">هذا الحقل مطلوب</p>
                            <p class="required d-none text-danger mb-0 fw-bold" id="oldMsg">يجب ان يكون اسم المتوفي مكون من 3 احرف على الاقل</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="burial_place" class="text-white">
                                <b>مكان الدفن</b>
                            </label>
                            <select name="region" id="region" class="form-select" required>
                                <option selected disabled>المنطقة</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->name }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                            <p class="required d-none text-danger mb-0 fw-bold" id="regionSelectReq">إختر من القائمة أغلاه</p>
                            <select name="tomb" id="regionTomb" class="form-select regionTomb mt-2" required>
                                <option selected disabled>المقبرة</option>
                            </select>
                            <p class="required d-none text-danger mb-0 fw-bold" id="tombSelectReq">إختر من القائمة أغلاه</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="death_date" class="text-white">
                                <b>تاريخ الوفاه</b>
                            </label>
                            <input type="date" name="death_date" id="deceasedDeath" class="form-control" required>
                            <p class="required d-none text-danger fw-bold mb-0" id="deathDateReq">هذا الحقل مطلوب</p>
                            {{-- <p class="required d-none text-danger fw-bold mb-0" id="deathMsg">تاريخ الوفاه لا يمكن أن يكون في المستقبل</p> --}}
                        </div>
                        <div class="form-group mb-3">
                            <label for="burial_date" class="text-white">
                                <b>تاريخ الدفن</b>
                            </label>
                            <input type="date" name="burial_date" id="deceasedBurial" class="form-control" required>
                            <p class="required d-none text-danger fw-bold mb-0" id="burialReq">هذا الحقل مطلوب</p>
                            {{-- <p class="required d-none text-danger fw-bold mb-0" id="burialMsg">تاريخ الدفن لا يمكن أن يكون قبل تاريخ الوفاه</p> --}}
                        </div>
                        <div class="form-group">
                            <button type="submit" id="OldSubmit" class="btn bg-success-gradient w-100 text-white">
                                <b>إضافة</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
