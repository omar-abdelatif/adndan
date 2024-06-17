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
                                    <a href="{{ route('region.index') }}">كل المقابر</a>
                                </li>
                                <li class="breadcrumb-item active">مقابر {{$region->name}}</li>
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
            <div class="bg-info-gradient p-3 w-50 mx-auto rounded mt-5">
                <div class="wrapper-title">
                    <h2 class="text-center text-white">مقابر {{$region->name}}</h2>
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
            <table class="table borderd-table display align-middle text-center" id="table17" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <td class="text-center">id</td>
                        <td class="text-center">الإسم</td>
                        <td class="text-center">نوع المقبرة</td>
                        <td class="text-center">قوة المقبرة</td>
                        <td class="text-center">المنطقة</td>
                        <td class="text-center">قمة الدفع السنوي</td>
                        <td class="text-center">تاريخ أخر دفنة</td>
                        <td class="text-center">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tombs as $tomb)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$tomb->name}}</td>
                            <td>{{$tomb->type}}</td>
                            <td>{{$tomb->power}}</td>
                            <td>{{$tomb->region}}</td>
                            <td>{{$tomb->annual_cost}}</td>
                            <td>{{$tomb->burial_date}}</td>
                            <td>
                                <div class="btn-group align-items-center justify-content-evenly">
                                    <button type="button" class="btn btn-warning rounded" data-coreui-toggle="modal" data-coreui-target="#edit{{$tomb->id}}" data-coreui-whatever="@mdo">
                                        <i class="fa-solid fa-pen-to-square fa-fade fa-lg"></i>
                                        <b class="fa-fade">تعديل</b>
                                    </button>
                                    <div class="modal fade" id="edit{{$tomb->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title text-decoration-underline" id="exampleModalLabel">تعديل مقبرة {{$tomb->name}}</h1>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('katamya.update')}}" method="post">
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
                                                                            <option value="1" {{$tomb->power  == '1' ? 'selected' : ''}}>1</option>
                                                                            <option value="2" {{$tomb->power  == '2' ? 'selected' : ''}}>2</option>
                                                                            <option value="3" {{$tomb->power  == '3' ? 'selected' : ''}}>3</option>
                                                                            <option value="4" {{$tomb->power  == '4' ? 'selected' : ''}}>4</option>
                                                                            <option value="5" {{$tomb->power  == '5' ? 'selected' : ''}}>5</option>
                                                                            <option value="6" {{$tomb->power  == '6' ? 'selected' : ''}}>6</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <select name="type" class="form-control mb-2">
                                                                            <option class="text-center" selected>إختار نوع المقبرة</option>
                                                                            <option value="لحد" {{$tomb->type  == 'لحد' ? 'selected' : ''}}>لحد</option>
                                                                            <option value="عيون" {{$tomb->type  == 'عيون' ? 'selected' : ''}}>عيون</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="text" name="region" value="{{$tomb->region}}" class="form-control text-center mb-3" placeholder="إختار المنطقة" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field">
                                                                        <input type="number" name="annual_cost" value="{{$tomb->annual_cost}}" class="form-control mb-3 text-center" placeholder="قيمة الدفع السنوي">
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
                                    <button type="button" class="btn btn-danger rounded ms-2" data-coreui-toggle="modal" data-coreui-target="#delete{{$tomb->id}}" data-coreui-whatever="@mdo">
                                        <i class="fa-solid fa-trash fa-fade fa-lg"></i>
                                        <b class="fa-fade">حذف</b>
                                    </button>
                                    <div class="modal fade" id="delete{{$tomb->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title text-decoration-underline" id="exampleModalLabel">حذف مقبرة {{$tomb->name}}</h3>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('katamya.destroy', $tomb->id)}}" method="get">
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
                                    <button type="button" class="btn btn-success rounded" data-coreui-toggle="modal" data-coreui-target="#show{{$tomb->id}}" data-coreui-whatever="@mdo">
                                        <i class="fa-solid fa-eye fa-fade fa-lg"></i>
                                        <b class=" fa-fade">عرض</b>
                                    </button>
                                    <div class="modal fade" id="show{{$tomb->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title text-decoration-underline" id="exampleModalLabel">عرض بيانات {{$tomb->name}}</h3>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="tomb-details bg-secondary rounded p-3">
                                                        <div class="tomb-details-title mb-3">
                                                            <h2 class="text-center text-decoration-underline">تفاصيل المقبرة</h2>
                                                        </div>
                                                        <div class="tomb-details-content d-flex align-items-center justify-content-evenly">
                                                            <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                <b>إسم المقبرة:</b>
                                                                {{$tomb->name}}
                                                            </p>
                                                            <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                <b>قوة المقبرة:</b>
                                                                {{$tomb->power}}
                                                            </p>
                                                            <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                <b>إسم المنطقة:</b>
                                                                {{$tomb->region}}
                                                            </p>
                                                            <div class="available bg-primary p-2 rounded">
                                                                <div class="available-title">
                                                                    <p class="mb-0 ms-3 text-white text-decoration-underline">
                                                                        <b>المتاح</b>
                                                                    </p>
                                                                </div>
                                                                <div class="available-body text-white">
                                                                    <span>
                                                                        <b>رجال:</b>
                                                                        .....
                                                                    </span>
                                                                    <span>
                                                                        <b>سيدات:</b>
                                                                        ......
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tomb-status bg-info rounded p-3 mt-3">
                                                        <div class="tomb-status-title mb-3">
                                                            <h2 class="text-center text-decoration-underline">حالة المقبرة</h2>
                                                        </div>
                                                        <div class="tomb-status-content d-flex align-items-center justify-content-around">
                                                            <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                <b>قوة المقبرة:</b>
                                                                {{$tomb->power}}
                                                            </p>
                                                            <div class="available bg-primary p-2 rounded">
                                                                <div class="available-title">
                                                                    <p class="mb-0 ms-3 text-white text-decoration-underline">
                                                                        <b>المتاح</b>
                                                                    </p>
                                                                </div>
                                                                <div class="available-body text-white">
                                                                    <span>
                                                                        <b>رجال:</b>
                                                                        .....
                                                                    </span>
                                                                    <span>
                                                                        <b>سيدات:</b>
                                                                        ......
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                <b>تاريخ أخر دفنة:</b>
                                                                .....
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="rooms bg-success rounded p-3 mt-3">
                                                        <div class="rooms-title mb-3">
                                                            <h2 class="text-center text-decoration-underline">تفاصيل الغرف</h2>
                                                        </div>
                                                        <div class="rooms-content">
                                                            <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                                                                <thead>
                                                                    <th class="text-center">id</th>
                                                                    <th class="text-center">إسم الغرفة</th>
                                                                    <th class="text-center">قوة الغرفة</th>
                                                                    <th class="text-center">تاريخ أخر دفنة</th>
                                                                    <th class="text-center">المتاح رجال</th>
                                                                    <th class="text-center">المتاح سيدات</th>
                                                                    <th class="text-center">Actions</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $j=1 ?>
                                                                    @foreach ($tomb->rooms as $room)
                                                                        @php
                                                                            $sumSize = $room->deceased->sum(function($deceased) {
                                                                                return (int) $deceased->size;
                                                                            });
                                                                            $roomsCount = $tomb->rooms->count();
                                                                            $roomId = $room->id;
                                                                            $deceasedsCount = 0;
                                                                            $deceasedsAll = $room->deceased->where("rooms_id", $roomId);
                                                                            foreach ($deceasedsAll as $deceased) {
                                                                                $deceasedsCount += (int) $deceased->size;
                                                                            }
                                                                        @endphp
                                                                        @if ($sumSize === $room->capacity)
                                                                            <tr>
                                                                                <td class="text-center" colspan="6">{{$room->name}} ممتلئة</td>
                                                                                <td class="d-flex justify-content-center">
                                                                                    <a href="{{ route('katamya.rooms', ['tombId' => $tomb->id, 'roomId' => $room->id]) }}" class="btn btn-info ms-2">
                                                                                        <i class="fa fa-eye"></i>
                                                                                    </a>
                                                                                    @if ($sumSize >= $room->capacity)
                                                                                        <form action="{{route('rooms.oldDeceased', $room->id)}}" method="post">
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-warning purify ">
                                                                                                <b>تطهير</b>
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <td>{{ $j++ }}</td>
                                                                                <td>{{$room->name}}</td>
                                                                                <td>{{$room->capacity}}</td>
                                                                                <td>{{ $room->burial_date }}</td>
                                                                                <td>0</td>
                                                                                <td>0</td>
                                                                                <td>
                                                                                    <a href="{{ route('katamya.rooms', ['tombId' => $tomb->id, 'roomId' => $room->id]) }}" class="btn btn-info">
                                                                                        <i class="fa fa-eye"></i>
                                                                                    </a>
                                                                                    @php
                                                                                        $sumSize = $room->deceased->sum('size');
                                                                                    @endphp
                                                                                    @if ($sumSize >= $room->capacity)
                                                                                        <form action="{{route('rooms.oldDeceased', $room->id)}}" method="post">
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-warning purify" data-room-id={{$room->id}}>
                                                                                                <b>تطهير</b>
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="last-burial-info bg-warning rounded p-3 mt-3">
                                                        <div class="last-burial-title mb-3">
                                                            <h2 class="text-center text-decoration-underline">بيانات أخر دفنة</h2>
                                                        </div>
                                                        <div class="last-burial-content">
                                                            <div class="details d-flex align-items-center justify-content-evenly">
                                                                <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                    <b>إسم المتوفي:</b>
                                                                    .....
                                                                </p>
                                                                <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                    <b>تاريخ الدفن:</b>
                                                                    .....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
@endsection
