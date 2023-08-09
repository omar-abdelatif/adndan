@extends('layouts.app')

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
                            <p id="totalAmountHome" class="mb-0 ms-3"></p>
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
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success text-center mt-5">
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
