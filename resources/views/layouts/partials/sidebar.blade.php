<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>    
        </li>
        {{-- <li class="nav-item {{ request()->routeIs('admin.fisioterapis.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.fisioterapis.index') }}">
                <i class="mdi mdi-18px mdi-stethoscope menu-icon"></i>
                <span class="menu-title">Fisioterapis</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item {{ request()->routeIs('admin.price.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.price.index') }}">
                <i class="mdi mdi-18px mdi-cash menu-icon"></i>
                <span class="menu-title">Biaya</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="mdi mdi-18px mdi-account menu-icon"></i>
                <span class="menu-title">Pasien</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.article.*') ? 'active' : ''}}"
                data-toggle="collapse" href="#information"
                aria-expanded="{{ request()->routeIs('admin.article.*') ? 'true' : 'false'}}" aria-controls="information">
                <i class="mdi mdi-information menu-icon"></i>
                <span class="menu-title">Informasi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.article.*') ? 'show' : ''}}" id="information">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.tag.index') }}">Tag</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.article.index') }}">Artikel</a></li>
                    <li class="nav-item"> <a class="nav-link coming-soon" href="#">Poster</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.video.index') }}">Video</a></li>
                </ul>
            </div>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#history" aria-expanded="false" aria-controls="history">
                <i class="mdi mdi-history menu-icon"></i>
                <span class="menu-title">Riwayat</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="history">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link coming-soon" href="#">Pakan</a></li>
                    <li class="nav-item"> <a class="nav-link coming-soon" href="#">Kondisi Air</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
