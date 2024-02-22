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
                <a class="dropdown-item text-right" href="{{ route('profile.show') }}">
                    <svg class="icon me-2">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg>
                    صفحتي
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item text-right" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                        </svg>
                        تسجيل خروج
                    </a>
                </form>
            </div>
        </li>
    </ul>
</div>
