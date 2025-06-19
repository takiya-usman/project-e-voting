@include('dashboard.admin.layout.header')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('dashboard.admin.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.halaman.index') }}">
                        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.kelas.index') }}">
                        <i class="mdi mdi mdi-book-multiple menu-icon"></i>
                        <span class="menu-title">Kelas</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.kandidat.index') }}">
                        <i class="mdi mdi mdi-account-multiple-plus menu-icon"></i>
                        <span class="menu-title">Kandidat</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.visimisi.index') }}">
                        <i class="mdi mdi mdi-telegram menu-icon"></i>
                        <span class="menu-title">Visi & Misi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.suara.index') }}">
                        <i class="mdi mdi mdi-voice menu-icon"></i>
                        <span class="menu-title">Suara</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.siswa.index') }}">
                        <i class="mdi mdi mdi-school menu-icon"></i>
                        <span class="menu-title">Siswa</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.countdown.index') }}">
                        <i class="mdi mdi mdi-timer menu-icon"></i>
                        <span class="menu-title">Waktu Pelaksanan</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @include('dashboard.admin.layout.pesan')
                <div class="row">
                    <div class="col-md-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                @yield('konten')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            @include('dashboard.admin.layout.footer')
