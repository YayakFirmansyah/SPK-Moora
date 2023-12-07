<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/polinema-logo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="d-block">SPK-Moora</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Pengolahan Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <ul style="list-style: none;">
                            <li class="nav-item">
                                <a href="{{ url('profile') }}" class="nav-link">
                                    <i class="nav-icon fas fa-balance-scale-right"></i>
                                    <p>
                                        Kriteria & Bobot
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('pengalaman-kuliah') }}" class="nav-link">
                                    <i class="nav-icon fas fa-list-ol"></i>
                                    <p>
                                        Alternatif & Value
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                            Hasil
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <ul style="list-style: none;">
                            <li class="nav-item">
                                <a href="{{ url('kendaraan') }}" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Matriks Keputusan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('hobi') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chart-area"></i>
                                    <p>
                                        Perhitungan MOORA
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('keluarga') }}" class="nav-link">
                                    <i class="nav-icon fas fa-sort-amount-down"></i>
                                    <p>
                                        Ranking
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
