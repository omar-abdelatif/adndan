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
                                <li class="breadcrumb-item active">كل المتوفيين</li>
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
            <div class="deceased-section-title mt-5 text-center bg-dark-gradient text-white p-3 w-50 mx-auto rounded">
                <h2 class="mb-0">كل المتوفيين</h2>
            </div>
            <div class="deceased-content">
                <div class="table-responsive">
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
                                    <a href="{{route('deceased.index', $deceased->id)}}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
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
                                                <div class="modal-body">
                                                    <form action="{{route('deceased.update')}}" method="post">
                                                        @csrf
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <input type="hidden" name="id" value="{{$deceased->id}}">
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="name" value="{{$deceased->name}}" placeholder="إسم المتوفي" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="deah_place" value="{{$deceased->death_place}}" placeholder="مكان الوفاه" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="date" name="death_date" value="{{$deceased->death_date}}" placeholder="تاريخ الوفاه" class="form-control mb-3 text-center" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="date" name="burial_date" value="{{$deceased->burial_date}}" placeholder="تاريخ الدفن" class="form-control mb-3 text-center" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="washer" value="{{$deceased->washer}}" placeholder="القائم بالغسل" class="form-control mb-3 text-center" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="carrier" value="{{$deceased->carrier}}" placeholder="القائم بالنقل" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="region" value="{{$deceased->region}}" placeholder="المنطقة" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="tomb" value="{{$deceased->tomb}}" placeholder="المقبرة" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="room" value="{{$deceased->room}}" placeholder="الغرفة" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="notes" value="{{$deceased->notes}}" placeholder="ملاحظات" class="form-control mb-3 text-center">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="notes" value="{{$deceased->notes}}" placeholder="ملاحظات" class="form-control mb-3 text-center">
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
