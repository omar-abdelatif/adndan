@extends('layouts.app')
@section('header')
    <header class="header header-sticky">
        @include('layouts.upper-header')
    </header>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-primary text-white p-4">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary ms-3">{{ $count }}</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">إجمالي الحالات</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-info text-white p-4">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary ms-3">0</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">إجمالي الحالات المستحقة</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-warning text-white p-4">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-money') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p id="totalAmountHome" class="mb-0 ms-3">{{$totalDonations}}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">إجمالي التبرعات</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-danger text-white p-4">
                        <svg class="icon icon-xl">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-settings') }}"></use>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0 ms-3">{{ $fullDate }}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">تاريخ اليوم</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden mt-3">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-success text-white p-4">
                        <i class="fa-duotone fa-tombstone-blank fa-2xl"></i>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0 ms-3">{{$totalDeceased}}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">عدد المتوفيين</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden mt-3">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-success text-white p-4">
                        <i class="fa-duotone fa-tombstone-blank fa-2xl"></i>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0 ms-3">{{$totalOldDeceased}}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">عدد المتوفيين السابقين</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden mt-3">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-success text-white p-4">
                        <i class="fa-duotone fa-tombstone-blank fa-2xl"></i>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0 ms-3">{{$tombs}}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">عدد المقابر</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden mt-3">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-success text-white p-4">
                        <i class="fa-duotone fa-tombstone-blank fa-2xl"></i>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0 ms-3">{{$totalTombDonations}}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">إجمالي تبرعات المقابر</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden mt-3">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-success text-white p-4">
                        <i class="fa-duotone fa-hands-holding-dollar fa-2xl"></i>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0 ms-3">{{$totalDonators}}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">عدد المتبرعين</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card overflow-hidden mt-3">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-success text-white p-4">
                        <i class="fa-duotone fa-hands-holding-dollar fa-2xl"></i>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">
                            <p class="mb-0 ms-3">{{$totalTombDonators}}</p>
                        </div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small ms-3">عدد المتبرعين المقابر الجديدة</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success text-center mt-5">
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
