@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
        <div class="header-divider"></div>
        <section class="content-header w-100">
            <div class="container-fluid d-flex">
                <div class="row align-items-center justify-content-between w-100">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('region.index') }}">كل المقابر</a>
                                </li>
                                <li class="breadcrumb-item active">مقابر {{$region->name}}</li>
                            </ol>
                            <div class="buttons">
                                <button type="button" class="btn btn-success rounded fw-bold" data-coreui-toggle="modal" data-coreui-target="#addnew" data-coreui-whatever="@mdo">
                                    إضافة متوفي في القرية
                                </button>
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
            <div class="bg-info-gradient p-3 w-50 mx-auto rounded mt-5">
                <div class="wrapper-title">
                    <h2 class="text-center text-white">مقابر {{$region->name}}</h2>
                </div>
            </div>
            <?php $i = 1 ?>
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
        </div>
    </div>
    <div class="table-responsive">
        <table class="table borderd-table display align-middle text-center" id="table19" data-order='[[ 0, "asc" ]]' data-page-length='10'>
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">إسم المتوفي</th>
                    <th class="text-center">جنس المتوفي</th>
                    <th class="text-center">مكان الوفاه</th>
                    <th class="text-center">تاريخ الوفاه</th>
                    <th class="text-center">تاريخ الدفن</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $k=1 ?>
                @foreach ($village as $item)
                    <tr>
                        <td>{{$k++}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{$item->death_place}}</td>
                        <td>{{$item->death_date}}</td>
                        <td>{{$item->burial_date}}</td>
                        <td>
                            {{-- ! Update ! --}}
                            <button type="button" class="btn btn-warning rounded" data-coreui-toggle="modal" data-coreui-target="#edit{{$item->id}}" data-coreui-whatever="@mdo">
                                <i class="fa fa-pen"></i>
                            </button>
                            <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">تعديل {{$item->name}}</h1>
                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-dark">
                                            <form action="{{route("village.deceaseds.update")}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        <div class="form-group mb-2">
                                                            <label for="deceasedName" class="text-white fw-bold">إسم المتوفي</label>
                                                            <input type="text" id="villageDeceasedName" class="form-control text-center" value="{{$item->name}}" name="name" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]{3,}" placeholder="إسم المتوفي" required>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="gender" class="text-white fw-bold">الجنس</label>
                                                            <select name="gender" class="form-select" id="villageDeceasedGender" required>
                                                                <option selected disabled>جنس المتوفي</option>
                                                                <option value="ذكر" {{$item->gender === 'ذكر' ? 'selected' : ''}}>ذكر</option>
                                                                <option value="أنثى" {{$item->gender === 'أنثى' ? 'selected' : ''}}>أنثى</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="death_place" class="text-white fw-bold">مكان الوفاة</label>
                                                            <input type="text" id="villageDeceasedDeathPlace" class="form-control text-center" value="{{$item->death_place}}" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" name="death_place" placeholder="مكان الوفاة" required>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="death_date" class="text-white fw-bold">تاريخ الوفاة </label>
                                                            <input type="date" id="villageDeceasedDeathDate" class="form-control text-center" value="{{$item->death_date}}" name="death_date" placeholder="تاريخ الوفاة" required>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="burial_date" class="text-white fw-bold">تاريخ الدفن</label>
                                                            <input type="date" id="villageDeceasedBurialDate" class="form-control text-center" value="{{$item->burial_date}}" name="burial_date" placeholder="تاريخ الدفن" required>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <button type="submit" class="btn btn-success fw-bold w-100 text-white">تعديل</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ! Delete ! --}}
                            <button type="button" class="btn btn-danger rounded" data-coreui-toggle="modal" data-coreui-target="#delete{{$item->id}}" data-coreui-whatever="@mdo">
                                <i class="fa fa-trash"></i>
                            </button>
                            <div class="modal fade" id="delete{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">حذف {{$item->name}}</h1>
                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-dark">
                                            <form action="{{route("village.deceaseds.delete", $item->id)}}" method="get">
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
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة متوفي جديد</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark-gradient">
                    <form action="{{route('village.deceaseds.store')}}" method="post" id="villageForm">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-2">
                                        <label for="deceasedName" class="text-white fw-bold">إسم المتوفي</label>
                                        <input type="text" id="villageDeceasedName" class="form-control text-center" name="name" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" pattern="[\u0600-\u06FF\s]{3,}" placeholder="إسم المتوفي" required>
                                        <p class="required d-none text-danger fw-bold mb-2" id="villageDeceasedNameReq">هذا الحقل مطلوب</p>
                                        <p class="required d-none text-danger fw-bold mb-2" id="villageDeceasedNameMsg">يجب ان يكون الاسم مكون من 3 احرف على الاقل</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="gender" class="text-white fw-bold">الجنس</label>
                                        <select name="gender" class="form-select" id="villageDeceasedGender" required>
                                            <option selected disabled>جنس المتوفي</option>
                                            <option value="ذكر">ذكر</option>
                                            <option value="أنثى">أنثى</option>
                                        </select>
                                        <p class="required d-none text-danger fw-bold mb-0" id="villageGenReq">أختر من القائمة أعلاه</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="death_place" class="text-white fw-bold">مكان الوفاة</label>
                                        <input type="text" id="villageDeceasedDeathPlace" class="form-control text-center" oninput="this.value = this.value.replace(/[^\u0600-\u06FF\s]/g, '')" name="death_place" placeholder="مكان الوفاة" required>
                                        <p class="required d-none text-danger fw-bold mb-0" id="villageDeathPlaceReq">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="death_date" class="text-white fw-bold">تاريخ الوفاة</label>
                                        <input type="date" id="villageDeceasedDeathDate" class="form-control text-center" name="death_date" placeholder="تاريخ الوفاة" required>
                                        <p class="required d-none text-danger fw-bold mb-2" id="village_death_date_req">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="burial_date" class="text-white fw-bold">تاريخ الدفن</label>
                                        <input type="date" id="villageDeceasedBurialDate" class="form-control text-center" name="burial_date" placeholder="تاريخ الدفن" required>
                                        <p class="required d-none text-danger fw-bold mb-2" id="village_burial_date_req">هذا الحقل مطلوب</p>
                                    </div>
                                    <div class="field mt-3">
                                        <button type="submit" id="villageDeceasedSubmit" class="btn btn-success fw-bold w-100 text-white">إضافة المتوفي</button>
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
