<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <img src="{{ asset('icons/icons8-dashboard-layout-30.png') }}" alt="donate">
            <b>لوحة التحكم</b>
        </a>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <img src="{{ asset('icons/icons8-donate-40.png') }}" alt="donate">
            <b>الكفالة</b>
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{route('showall')}}" target="_top">
                    <img src="{{asset('icons/all_cases.png')}}" width="100" alt="alcases">
                    إجمالي الحالات
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('addnew')}}" target="_top">
                    <img src="{{asset('icons/add_case.png')}}" width="120" alt="alcases">
                    إضافة حالة
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('donator.index')}}" target="_top">
                    <img src="{{asset('icons/donator.png')}}" width="100" alt="alcases">
                    المتبرع
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('reports.index')}}" target="_top">
                    <img src="{{asset('icons/report.png')}}" width="100" alt="alcases">
                    تقارير
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
            <b>المقابر</b>
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="all_old_deceased" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>كل المناطق</b>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('old.index')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>المتوفيين السابقين</b>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('deceased.index')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>كل المتوفيين</b>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">

    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <img src="{{ asset('icons/icons8-service-30.png') }}" alt="donate">
            <b>الخدمات</b>
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{route('text.add')}}" target="_top">
                    <img src="{{ asset('icons/icons8-sms-30.png') }}" alt="donate">
                    <b>الرسائل النصية</b>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('text.add')}}" target="_top">
                    <img src="{{ asset('icons/subscription.png') }}" alt="subscription">
                    <b>الإشتراكات</b>
                </a>
            </li>
        </ul>
    </li>
    {{-- <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Two-level menu
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Child menu
                </a>
            </li>
        </ul>
    </li> --}}
</ul>
