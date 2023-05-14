@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="{{ asset('icons/brand.svg#full') }}"></use>
                </svg>
            </a>
            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">لوحة التحكم</a>
                </li>
            </ul>
            <ul class="header-nav ms-auto"></ul>
            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            {{ __('My profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                </svg>
                                {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <div class="header-divider"></div>
        <section class="content-header w-100">
            <div class="container-fluid d-flex">
                <div class="row align-items-center ">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('region.index') }}">كل المقابر</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('october.index') }}">مقابر {{$region->name}}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('october.index') }}">{{$tombName}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{$room->name}}</li>
                            </ol>
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
            <div class="content-title bg-dark-gradient p-3 mx-auto w-50 rounded mt-5 text-white">
                <h2 class="text-center">{{$room->name}}</h2>
            </div>
            <div class="content-data">
                <div class="row">
                    <div class="col-12">
                        <?php $k = 1 ?>
                        <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الإسم</th>
                                    <th class="text-center">مكان الوفاه</th>
                                    <th class="text-center">تاريخ الوفاه</th>
                                    <th class="text-center">تاريخ الدفن</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deceased as $deceased)
                                    <tr>
                                        <td class="text-center">{{$k++}}</td>
                                        <td class="text-center">{{$deceased->name}}</td>
                                        <td class="text-center">{{$deceased->death_place}}</td>
                                        <td class="text-center">{{$deceased->death_date}}</td>
                                        <td class="text-center">{{$deceased->burial_date}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning rounded" data-coreui-toggle="modal" data-coreui-target="#edit{{$deceased->id}}" data-coreui-whatever="@mdo">
                                                <i class="fa-solid fa-edit fa-fade fa-lg"></i>
                                            </button>
                                            <div class="modal fade" id="edit{{$deceased->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">تعديل {{$deceased->name}}</h1>
                                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('zenhom.update')}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <input type="text" class="form-control" name="id" value="{{$deceased->id}}">
                                                                        <div class="col-6">
                                                                            <div class="form-group mt-3">
                                                                                <label for="name">
                                                                                    <b>إسم المتوفي</b>
                                                                                </label>
                                                                                <input type="text" id="name" class="form-control text-center" value="{{$deceased->name}}" name="name" placeholder="إسم المتوفي">
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="death_place">
                                                                                    <b>مكان الوفاة</b>
                                                                                </label>
                                                                                <input type="text" id="death_place" class="form-control text-center" value="{{$deceased->death_place}}" name="death_place" placeholder="مكان الوفاة">
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="death_date">
                                                                                    <b>تاريخ الوفاة</b>
                                                                                </label>
                                                                                <input type="date" id="death_date" class="form-control text-center" value="{{$deceased->death_date}}" name="death_date" placeholder="تاريخ الوفاة">
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="burial_date">
                                                                                    <b>تاريخ الدفن</b>
                                                                                </label>
                                                                                <input type="date" id="burial_date" class="form-control text-center" value="{{$deceased->burial_date}}" name="burial_date" placeholder="تاريخ الدفن">
                                                                            </div>
                                                                            <div class="form-group mt-3 text-center">
                                                                                <label for="files">
                                                                                    <b>ملفات</b>
                                                                                </label>
                                                                                <input type="file" name="files" value="{{$deceased->files}}" class="form-control mb-3" accept="image/*">
                                                                                <img src="{{asset('build/assets/backend/files/tombs/imgs/'.$deceased->files)}}" class="rounded-circle d-block mx-auto" width="100" alt="{{$deceased->name}}">
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="files">
                                                                                    <b>ملفات PDF</b>
                                                                                </label>
                                                                                <input type="file" name="pdf_files" value="{{$deceased->pdf_files}}" class="form-control mb-3" accept="application/pdf">
                                                                                <a href="{{asset('build/assets/backend/files/tombs/pdf/'.$deceased->pdf_files)}}" class="d-block">
                                                                                    <i class="fas fa-file-pdf fa-3x"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group mt-3">
                                                                                <label for="the_washer">
                                                                                    <b>القائم بالغسل</b>
                                                                                </label>
                                                                                <input type="text" id="the_washer" class="form-control text-center" value="{{$deceased->washer}}" name="washer" placeholder="القائم بالغسل">
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="the_carrier">
                                                                                    <b>القائم بالنقل</b>
                                                                                </label>
                                                                                <input type="text" id="the_carrier" class="form-control text-center" value="{{$deceased->carrier}}" name="carrier" placeholder="القائم بالنقل">
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="region">
                                                                                    <b>المنطقة</b>
                                                                                </label>
                                                                                <select name="region" id="region" class="form-control">
                                                                                    <option value="0" selected>-- إختار المنطقة --</option>
                                                                                    {{-- @foreach ($regions as $region)
                                                                                        <option value="{{ $region->name }}">{{ $region->name }}</option>
                                                                                    @endforeach --}}
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="tomb">
                                                                                    <b>إسم المقبرة</b>
                                                                                </label>
                                                                                <select name="tomb" id="regionTomb" class="form-control regionTomb">
                                                                                    <option value="0" selected>-- إختار المقبرة --</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <label for="room">
                                                                                    <b>رقم الغرفة</b>
                                                                                </label>
                                                                                <select name="room" id="room" class="form-control roomTomb">
                                                                                    <option value="">-- إختار الغرفة --</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="textarea mt-4">
                                                                                <label for="notes">
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
                                            <button type="button" class="btn btn-danger rounded" data-coreui-toggle="modal" data-coreui-target="#delete{{$deceased->id}}" data-coreui-whatever="@mdo">
                                                <i class="fa-solid fa-trash fa-fade fa-lg"></i>
                                            </button>
                                            <div class="modal fade" id="delete{{$deceased->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title text-decoration-underline" id="exampleModalLabel">حذف مقبرة {{$deceased->name}}</h3>
                                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('zenhom.destroy', $deceased->id)}}" method="get">
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
            </div>
        </div>
    </div>
@endsection
