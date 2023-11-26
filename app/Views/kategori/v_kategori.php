<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?= $title; ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ms-auto">
                        <li><a href="#" class="fw-normal"><?= $title; ?></a></li>
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
                        <h3 class="box-title mb-0">Tabel Kategori Aduan</h3>
                        <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                            <a href="/kategori/create" class="btn btn-primary btn-sm">Tambah kategori</a>
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
                                    <th class="border-top-0">Nama Kategori</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Menampilkan data user -->
                                <?php
                                $no = 1;
                                foreach ($kategori as $u) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="txt-oflo"><?= $u['nama_kategori']; ?></td>
                                        <td class="txt-oflo">
                                            <a href="/kategori/edit/<?= $u['id_kategori']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="/kategori/delete/<?= $u['id_kategori'] ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Yakin ingin menghapus data?')">Delete</a>
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