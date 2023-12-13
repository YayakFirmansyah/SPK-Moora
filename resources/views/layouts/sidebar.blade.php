<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/polinema-logo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text d-block">SPK-Moora</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="h-100 d-flex flex-column justify-content-between align-items-center">
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
                                <a href="{{ url('kriteriabobot') }}" class="nav-link">
                                    <i class="nav-icon fas fa-balance-scale-right"></i>
                                    <p>
                                        Kriteria & Bobot
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('alternatif') }}" class="nav-link">
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
                                <a href="{{ url('decisionmatrix') }}" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Matriks Keputusan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('normalization') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chart-area"></i>
                                    <p>
                                        Perhitungan MOORA
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('ranking') }}" class="nav-link">
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
            <ul class="nav nav-pills nav-sidebar flex-column m-2">
                <li class="nav-item bg-danger rounded">
                    <a type="button" data-target="#resetModal" data-toggle="modal"  class="nav-link">
                        <i class="nav-icon fas fa-trash"></i>
                        <p>
                            Reset Data
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Reset Data Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Semua Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal body content here -->
                <h5>Apakah Anda yakin menghapus semua data?</h5>
                <p>(semua data yang sudah diinputkan akan hilang)</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <form action="{{ url('/resetData') }}" method="post">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-danger">Reset Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
