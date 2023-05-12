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
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">المتوفيين السابقين</li>
                            </ol>
                            <div class="buttons">
                                <button type="button" class="btn btn-primary mt-1" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"> Upload User Excel Sheet </button>
                                <button type="button" class="btn btn-primary mt-1" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"> إضافة متوفي سابق جديد </button>
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
                <h1>كل المتوفيين</h1>
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
            <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
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
                                <a href="" class="btn btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                {{-- <button type="button" class="btn btn-primary mt-1" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"> Upload User Excel Sheet </button>
                                <button type="button" class="btn btn-primary mt-1" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"> Upload User Excel Sheet </button> --}}
                                <a href="" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="upload-csv mt-1">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">إضافة متوفي جديد</h1>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('old.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="الاسم">
                        </div>
                        <div class="form-group">
                            <label for="burial_place">مكان الوفاه</label>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
