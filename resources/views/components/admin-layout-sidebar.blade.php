<!-- Sidebar utama dengan gaya dan warna latar yang ditentukan -->
<div class="sidebar sidebar-style-2" data-background-color="light">
    <!-- Bagian logo di sidebar -->
    <div class="sidebar-logo">
        <!-- Header untuk logo dengan warna latar yang ditentukan -->
        <div class="logo-header" data-background-color="grey">
            <!-- Link menuju halaman utama, menampilkan logo -->
            <a href="index.html" class="logo">
                <img src="/img/Telkom.png" alt="navbar brand" class="navbar-brand" height="40" />
            </a>

            <!-- Tombol untuk men-toggle sidebar -->
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left-dark"></i>
                </button>
            </div>
            <!-- Tombol untuk membuka menu topbar -->
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- Akhir dari header logo -->
    </div>

    <!-- Wrapper untuk konten sidebar dengan scrollbar -->
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <!-- Navigasi utama sidebar -->
            <ul class="nav nav-secondary">
                <!-- Item navigasi untuk dashboard admin -->
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : 'inactive' }}">
                    <a href="{{ route('admin.dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <!-- Seksi menu untuk menampilkan kategori navigasi -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <!-- Akhir dari seksi menu -->

                <!-- Item navigasi untuk halaman Data Master -->
                <li class="nav-item {{ request()->routeIs('admin.intern') ? 'active' : 'inactive' }}">
                    <a href="{{ route('admin.intern') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-friends"></i>
                        <p>Data Master</p>
                    </a>
                </li>



                <!-- Item navigasi untuk halaman Absensi -->
                <li class="nav-item {{ request()->routeIs('admin.presensi.monitoring') ? 'active' : 'inactive' }}">
                    <a href="{{ route('admin.presensi.monitoring') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-check"></i>
                        <p>Presensi</p>
                    </a>
                </li>

                <!-- Item navigasi untuk halaman Absensi -->
                <li class="nav-item {{ request()->routeIs('admin.absensi') ? 'active' : 'inactive' }}">
                    <a href="{{ route('admin.absensi') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-times"></i>
                        <p>Absensi</p>
                    </a>
                </li>

                <!-- Item navigasi untuk halaman Surat -->
                <li class="nav-item {{ request()->routeIs('admin.surat') ? 'active' : 'inactive' }}">
                    <a href="{{ route('admin.surat') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        <p>Surat</p>
                    </a>
                </li>

                <!-- Item navigasi untuk halaman Kantor -->
                <li class="nav-item {{ request()->routeIs('admin.office') ? 'active' : 'inactive' }}">
                    <a href="{{ route('admin.office') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-building"></i>
                        <p>Kantor</p>
                    </a>
                </li>

                <!-- Item navigasi untuk halaman Events -->
                <li class="nav-item {{ request()->routeIs('admin.event') ? 'active' : 'inactive' }}">
                    <a href="{{ route('admin.event') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Events</p>
                    </a>
                </li>

                <!-- Seksi menu untuk bagian navigasi tambahan -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Lainnya</h4>
                </li>
                <!-- Akhir dari seksi menu tambahan -->

                <!-- Item navigasi untuk halaman Pengaturan -->
                <li class="nav-item {{ request()->is('admin/setting') ? 'active' : 'inactive' }}">
                    <a href="#" class="collapsed" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>

                <!-- Item navigasi untuk halaman Bantuan -->
                <li class="nav-item {{ request()->is('admin/help') ? 'active' : 'inactive' }}">
                    <a href="#" class="collapsed" aria-expanded="false">
                        <i class="fas fa-question-circle"></i>
                        <p>Bantuan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
