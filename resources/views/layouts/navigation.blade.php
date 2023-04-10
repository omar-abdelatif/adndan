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
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
                    </svg>
                    إجمالي الحالات
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addnew')}}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-playlist-add') }}"></use>
                    </svg>
                    إضافة حالة
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('donator.index')}}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-playlist-add') }}"></use>
                    </svg>
                    المتبرع
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
                <a class="nav-link" href="{{route('showall')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>أكتوبر</b>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addnew')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    الفيوم
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addnew')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    الغفير
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addnew')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    زينهم
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addnew')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    القطامية
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addnew')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    15 مايو
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <img src="{{ asset('icons/icons8-service-30.png') }}" alt="donate">
            <b>الخدمات</b>
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <img src="{{ asset('icons/icons8-sms-30.png') }}" alt="donate">
                    <b>الرسائل النصية</b>
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
