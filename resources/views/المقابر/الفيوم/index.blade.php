@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
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
            <table class="table borderd-table display align-middle text-center" id="table15" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="text-center">الإسم</th>
                        <th class="text-center">نوع المقبرة</th>
                        <th class="text-center">تخصص المقبرة</th>
                        <th class="text-center">قوة المقبرة</th>
                        <th class="text-center">تاريخ أخر دفنة</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                @if ($tombs->count() >= 1)
                    <tbody>
                        @foreach ($tombs as $tomb)
                            <tr>
                                <td>{{$tomb->name}}</td>
                                <td>{{$tomb->type}}</td>
                                <td>
                                    @if ($tomb->tomb_specifices === "0")
                                        مختلط
                                    @elseif ($tomb->tomb_specifices === "1")
                                        رجال
                                    @elseif ($tomb->tomb_specifices === "2")
                                        سيدات
                                    @else
                                        <span class="fw-bold">ـــــ</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($tomb->power === "0")
                                        {{$tomb->other_tomb_power}}
                                    @else
                                        {{$tomb->power}}
                                    @endif
                                </td>
                                <td>{{$tomb->burial_date}}</td>
                                <td>
                                    <div class="btn-group align-items-center justify-content-evenly">
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
                                                                            <b>الإجمالي</b>
                                                                        </p>
                                                                    </div>
                                                                    <div class="available-body text-white">
                                                                        <span>
                                                                            <b>رجال:</b>
                                                                            {{ $tomb->getTotalPlaces()['male'] }}
                                                                        </span>
                                                                        <span>
                                                                            <b>سيدات:</b>
                                                                            {{ $tomb->getTotalPlaces()['female'] }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($tomb->tomb_specifices === "0")
                                                            <div class="tomb-status bg-info rounded p-3 mt-3 d-none">
                                                                <div class="tomb-status-title mb-3">
                                                                    <h2 class="text-center text-decoration-underline">حالة المقبرة</h2>
                                                                </div>
                                                                <div class="tomb-status-content d-flex align-items-center justify-content-around">
                                                                    <p class="mb-0 ms-3 bg-primary p-2 rounded text-white">
                                                                        <b>قوة المقبرة:</b>
                                                                        {{$tomb->power}}
                                                                    </p>
                                                                    <div class="available bg-primary p-2 rounded d-none">
                                                                        <div class="available-title">
                                                                            <p class="mb-0 ms-3 text-white text-decoration-underline">
                                                                                <b>المتاح</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="available-body text-white">
                                                                            <span>
                                                                                <b>رجال:</b>
                                                                                ....
                                                                            </span>
                                                                            <span>
                                                                                <b>سيدات:</b>
                                                                                ....
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="rooms bg-success rounded p-3 mt-3">
                                                            <div class="rooms-title mb-3">
                                                                <h2 class="text-center text-decoration-underline">تفاصيل الغرف</h2>
                                                            </div>
                                                            <div class="rooms-content">
                                                                <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">id</th>
                                                                            <th class="text-center">إسم الغرفة</th>
                                                                            <th class="text-center">قوة الغرفة</th>
                                                                            <th class="text-center">تاريخ أخر دفنة</th>
                                                                            @if ($tomb->tomb_specifices === "0")
                                                                                <th class="text-center">المتاح رجال</th>
                                                                                <th class="text-center">المتاح سيدات</th>
                                                                            @elseif ($tomb->tomb_specifices === "1")
                                                                                <th class="text-center">المتاح رجال</th>
                                                                            @else
                                                                                <th class="text-center">المتاح سيدات</th>
                                                                            @endif
                                                                            <th class="text-center">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                            $q = 0;
                                                                        ?>
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
                                                                                $isDisabled = $room->isDisabled;
                                                                            @endphp
                                                                            @if ($sumSize === 6)
                                                                                <tr>
                                                                                    @if ($tomb->tomb_specifices === "1" || $tomb->tomb_specifices === "2")
                                                                                        <td class="text-center" colspan="5">{{ $room->name }} ممتلئة</td>
                                                                                    @else
                                                                                        <td class="text-center" colspan="6">{{ $room->name }} ممتلئة</td>
                                                                                    @endif
                                                                                    <td class="d-flex justify-content-center">
                                                                                        <a href="{{ route('fayum.rooms', ['tombId' => $tomb->id, 'roomId' => $room->id]) }}" class="btn btn-info ms-2">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </a>
                                                                                        @if (!$isDisabled && $sumSize >= $room->capacity)
                                                                                            <form action="{{ route('rooms.oldDeceased', $room->id) }}" method="post">
                                                                                                @csrf
                                                                                                <button type="submit" class="btn btn-warning purify">
                                                                                                    <b>تطهير</b>
                                                                                                </button>
                                                                                            </form>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @else
                                                                                <tr>
                                                                                    <td>{{ $loop->iteration }}</td>
                                                                                    <td>{{ $room->name }}</td>
                                                                                    <td>{{ $room->capacity }}</td>
                                                                                    <td>{{ $room->burial_date }}</td>
                                                                                    @if ($tomb->tomb_specifices === "0")
                                                                                        @if ($q < $roomsCount / 2)
                                                                                            <td>{{ 6 - $deceasedsCount }}</td>
                                                                                            <td>
                                                                                                <i class="fas fa-times text-danger"></i>
                                                                                            </td>
                                                                                        @else
                                                                                            <td>
                                                                                                <i class="fas fa-times text-danger"></i>
                                                                                            </td>
                                                                                            <td>{{ 6 - $deceasedsCount }}</td>
                                                                                        @endif
                                                                                    @elseif ($tomb->tomb_specifices === 1)
                                                                                        <td>{{ 6 - $deceasedsCount }}</td>
                                                                                    @else
                                                                                        <td>{{ 6 - $deceasedsCount }}</td>
                                                                                    @endif
                                                                                    <td>
                                                                                        <a href="{{ route('fayum.rooms', ['tombId' => $tomb->id, 'roomId' => $room->id]) }}" class="btn btn-info">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                            @php $q++; @endphp
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
                                                                    @foreach ($tombData as $tombInfo)
                                                                        @if ($tomb->id === $tombInfo['id'])
                                                                            @if (isset($tombInfo['latest_deceased']))
                                                                                <p class="mb-0 ms-3 bg-primary text-white p-2 rounded">
                                                                                    <b>إسم المتوفي:</b>
                                                                                    {{ $tombInfo['latest_deceased']['name'] }}
                                                                                </p>
                                                                                <p class="mb-0 ms-3 bg-primary text-white p-2 rounded">
                                                                                    <b>تاريخ الدفن:</b>
                                                                                    {{ $tombInfo['latest_deceased']['burial_date'] }}
                                                                                </p>
                                                                                <p class="mb-0 ms-3 bg-primary text-white p-2 rounded">
                                                                                    <b>الغرفة:</b>
                                                                                    {{ $tombInfo['latest_deceased']['room'] }}
                                                                                </p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
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
                @else
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <h1 class="mb-0">لا توجد مقابر في هذه المنطقة حالياً</h1>
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
@endsection
