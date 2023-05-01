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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('tombs.index') }}">كل المقابر</a>
                                </li>
                                <li class="breadcrumb-item active">مقابر 6 أكتوبر</li>
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
            <div class="bg-info-gradient p-3 w-50 mx-auto rounded mt-5">
                <div class="wrapper-title">
                    <h2 class="text-center text-white">مقابر السادس من أكتوبر</h2>
                </div>
            </div>
            <?php $i = 1 ?>
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
            <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <td class="text-center">id</td>
                        <td class="text-center">الإسم</td>
                        <td class="text-center">نوع المقبرة</td>
                        <td class="text-center">قوة المقبرة</td>
                        <td class="text-center">قمة الدفع السنوي</td>
                        <td class="text-center">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @if ($tombCount > 0)
                        @foreach ($octoberTomb as $tomb)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{$tomb->name}}</td>
                                <td>{{$tomb->type}}</td>
                                <td>{{$tomb->power}}</td>
                                <td>{{$tomb->annually_cost}}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#history_{{$tomb->id}}" data-coreui-whatever="@mdo">
                                        <b>عرض</b>
                                    </button>
                                    <div class="modal fade" id="history_{{$tomb->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">بيانات المقبرة الثابتة</h3>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="tomb-static-details mb-3 d-flex justify-content-evenly">
                                                        <div class="tomb-name">
                                                            <h4>
                                                                إسم المقبرة:
                                                                {{$tomb->name}}
                                                            </h4>
                                                        </div>
                                                        <div class="tomb-power">
                                                            <h4>
                                                                القوة:
                                                                {{$tomb->power}}
                                                            </h4>
                                                        </div>
                                                        <div class="tomb-type">
                                                            <h4>
                                                                النوع:
                                                                {{$tomb->type}}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="room-details">
                                                        <div class="room-title mt-2 ms-3">
                                                            <h3 class="text-right mb-3">بيانات الحجرات</h3>
                                                        </div>
                                                        <div class="room-content">
                                                            <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                                                                <thead>
                                                                    <td></td>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit{{$tomb->id}}" data-coreui-whatever="@mdo">
                                        <b>تعديل</b>
                                    </button>
                                    <div class="modal fade" id="edit{{$tomb->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة مقبرة جديدة</h1>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('october.update')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <input type="hidden" name="id" value="{{$tomb->id}}">
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="name" value="{{$tomb->name}}" placeholder="إسم المقبرة" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <select name="power" class="form-control mb-2">
                                                                            <option class="text-center" selected>قوة المقبرة</option>
                                                                            <option value="1" {{ $tomb->power  == '1' ? 'selected' : ''}}>1</option>
                                                                            <option value="2" {{ $tomb->power  == '2' ? 'selected' : ''}}>2</option>
                                                                            <option value="3" {{ $tomb->power  == '3' ? 'selected' : ''}}>3</option>
                                                                            <option value="4" {{ $tomb->power  == '4' ? 'selected' : ''}}>4</option>
                                                                            <option value="5" {{ $tomb->power  == '5' ? 'selected' : ''}}>5</option>
                                                                            <option value="6" {{ $tomb->power  == '6' ? 'selected' : ''}}>6</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <select name="type" class="form-control mb-2">
                                                                            <option class="text-center" selected>إختار نوع المقبرة</option>
                                                                            <option value="لحد" {{ $tomb->type  == 'لحد' ? 'selected' : ''}}>لحد</option>
                                                                            <option value="عيون" {{ $tomb->type  == 'عيون' ? 'selected' : ''}}>عيون</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="number" name="annually_cost" value="{{$tomb->annually_cost}}" class="form-control mb-3 text-center" placeholder="قيمة الدفع السنوي">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="field">
                                                                        <input type="submit" value="تعديل" class="btn btn-success w-100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{url('destroy_october_tomb/'.$tomb->id)}}" class="btn btn-danger">
                                        <b>حذف</b>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h1 class="text-center text-dark mt-5">لا توجد مقابر حاليا</h1>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addtomb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة مقبرة جديدة</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('october.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="text" name="name" placeholder="إسم المقبرة" class="form-control mb-3 text-center">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <select name="power" class="form-control mb-2">
                                            <option class="text-center" selected>قوة المقبرة</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <select name="type" class="form-control mb-2">
                                            <option class="text-center" selected>إختار نوع المقبرة</option>
                                            <option value="لحد">لحد</option>
                                            <option value="عيون">عيون</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="field">
                                        <input type="number" name="annually_cost" class="form-control mb-3 text-center" placeholder="قيمة الدفع السنوي">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field">
                                        <input type="submit" value="إضافة" class="btn btn-success w-100">
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
