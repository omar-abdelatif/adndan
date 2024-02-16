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
            <li class="nav-item">
                <a class="nav-link" href="{{route('donator.index')}}" target="_top">
                    <img src="{{asset('icons/donator.png')}}" width="100" alt="alcases">
                    المتبرع
                </a>
            </li>
            <li class="nav-group" aria-expanded="false">
                <a class="nav-link nav-group-toggle" href="" target="_top">
                    <img src="{{asset('icons/report.png')}}" alt="alcases">
                    تقارير
                </a>
                <ul class="nav-group-items" style="height: 0px;">
                    <li class="nav-item">
                        <a class="nav-link justify-content-center" href="{{route('reports.index')}}" target="_top">
                            <img src="{{asset('icons/all_cases.png')}}" alt="alcases">
                            التبرعات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link justify-content-center" href="{{route('reports.kfala')}}" target="_top">
                            <img src="{{asset('icons/donator.png')}}" alt="alcases">
                            الكفالة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link justify-content-center" href="{{route('reports.safe')}}" target="_top">
                            <img src="https://img.icons8.com/external-filled-color-icons-papa-vector/150/external-Safe-money-filled-color-icons-papa-vector.png" style="width: 50px !important" alt="external-Safe-money-filled-color-icons-papa-vector"/>
                            الخزنة
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="">
            <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
            <b>المقابر</b>
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{route('region.index')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>كل المناطق</b>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('tombs.all')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>كل المقابر</b>
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
            <li class="nav-item">
                <a class="nav-link" href="{{route('tombs.report')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>التقارير</b>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('tombs.report')}}" target="_top">
                    <img src="{{ asset('icons/icons8-cemetery-30.png') }}" alt="donate">
                    <b>التبرعات</b>
                </a>
            </li>
        </ul>
    </li>

    {{-- <li class="nav-group" aria-expanded="false"></li>

    <li class="nav-group" aria-expanded="false">
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
