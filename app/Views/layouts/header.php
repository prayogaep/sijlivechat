<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <style>
                .header-link {
                    font-size: 18px; margin-left: 10px;
                }
                @media only screen and (max-width: 900px) {
                     .header-link {
                        font-size: 10px;
                        margin-left: 3px;
                    }
                }
            </style>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <h4 class="text-center text-white fw-bold mt-2 header-link">SIJAWARA</h4>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <a class="nav-toggler waves-effect waves-light text-white d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">

                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li>
                    <a class="profile-pic" href="#">
                        <span class="text-white font-medium"><?= session('username') ?> - <?= session('nama_role') . ' ' . session('nama_kategori') ?></span></a>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>