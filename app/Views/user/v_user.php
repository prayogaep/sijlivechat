<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Kelola User</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ms-auto">
                        <li><a href="#" class="fw-normal">Kelola User</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- jika ada session yang namanya success -->
        <?php if (session('success')) { ?>
            <div class="alert alert-success" role="alert">
                <?= session('success') ?>
            </div>
        <?php } ?>
        <!-- ============================================================== -->
        <!-- Tabel User -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Tabel User Admin</h3>
                        <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                            <a href="/user/create" class="btn btn-primary btn-sm">Tambah User</a>
                            <!-- <select class="form-select shadow-none row border-top">
                                <option>March 2021</option>
                                <option>April 2021</option>
                                <option>May 2021</option>
                                <option>June 2021</option>
                                <option>July 2021</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Username</th>
                                    <th class="border-top-0">Role</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Menampilkan data user -->
                                <?php
                                $no = 1;
                                foreach ($users_admin as $u) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="txt-oflo"><?= $u['username']; ?></td>
                                        <td class="txt-oflo"><?= $u['nama_role']; ?></td>
                                        <td class="txt-oflo">
                                            <?php if ($u['id_user'] != session('id_user')) { ?>
                                                <a href="/user/edit/<?= $u['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="/user/delete/<?= $u['id_user'] ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Yakin ingin menghapus data?')">Delete</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Tabel User Operator</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Username</th>
                                    <th class="border-top-0">Role</th>
                                    <th class="border-top-0">Kategori</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Menampilkan data user -->
                                <?php
                                $no = 1;
                                foreach ($users_operator as $u) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="txt-oflo"><?= $u['username']; ?></td>
                                        <td class="txt-oflo"><?= $u['nama_role']; ?></td>
                                        <td class="txt-oflo"><?= $u['nama_kategori']; ?></td>
                                        <td class="txt-oflo">
                                            <a href="/user/edit/<?= $u['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="/user/delete/<?= $u['id_user'] ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Yakin ingin menghapus data?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Tabel User ASN</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Username</th>
                                    <th class="border-top-0">Role</th>
                                    <th class="border-top-0">Nama</th>
                                    <th class="border-top-0">Asal Dinas</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Menampilkan data user -->
                                <?php
                                $no = 1;
                                foreach ($users_asn as $u) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="txt-oflo"><?= $u['username']; ?></td>
                                        <td class="txt-oflo"><?= $u['nama_role']; ?></td>
                                        <td class="txt-oflo"><?= $u['nama']; ?></td>
                                        <td class="txt-oflo"><?= $u['asal_dinas']; ?></td>
                                        <td class="txt-oflo">
                                            <a href="/user/edit/<?= $u['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="/user/delete/<?= $u['id_user'] ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Yakin ingin menghapus data?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<?= $this->endSection() ?>