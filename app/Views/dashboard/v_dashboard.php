<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ms-auto">
                        <li><a href="#" class="fw-normal">Dashboard</a></li>
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
        <!-- ============================================================== -->
        <!-- Three charts -->
        <!-- ============================================================== -->
        <div class="row justify-content-between">
            <div class="col-lg-4 col-md-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Jumlah Aduan</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ms-auto"><span class="counter text-success"><?= $jumlah_aduan; ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Jumlah Aduan Selesai</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash2"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ms-auto"><span class="counter text-purple"><?= $jumlah_aduan_selesai; ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Jumlah Aduan Belum Selesai</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash3"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ms-auto"><span class="counter text-info"><?= $jumlah_aduan_belum_selesai; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Daftar Aduan Livechat</h3>
                        <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                            <?php if (session('id_role') == 3) { ?>
                                <a href="/livechat/create" class="btn btn-primary btn-sm">Tambah Aduan Livechat</a>
                            <?php } ?>
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
                                    <th class="border-top-0">Id Aduan</th>
                                    <th class="border-top-0">Tanggal Aduan</th>
                                    <th class="border-top-0">Nama Pengadu</th>
                                    <th class="border-top-0">Asal Dinas</th>
                                    <th class="border-top-0">Nama Kategori</th>
                                    <th class="border-top-0">Keterangan</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Menampilkan data user -->
                                <?php
                                $no = 1;
                                foreach ($livechat as $u) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="txt-oflo"><?= $u['id_livechat']; ?></td>
                                        <td class="txt-oflo"><?= date('d-m-Y', strtotime($u['tanggal_aduan'])); ?></td>
                                        <td class="txt-oflo"><?= $u['nama']; ?></td>
                                        <td class="txt-oflo"><?= $u['asal_dinas']; ?></td>
                                        <td class="txt-oflo"><?= $u['nama_kategori']; ?></td>
                                        <td class="txt-oflo"><?= $u['keterangan']; ?></td>
                                        <td class="txt-oflo"><span class="badge bg-danger"><?= $u['status'] == 0 ? 'Belum Selesai' : 'Selesai'; ?></span></td>
                                        <td class="txt-oflo">
                                            <a href="/livechat/detail/<?= $u['id_livechat']; ?>" class="btn btn-info btn-sm">Livechat</a>
                                            <?php if ($u['status'] == 0 && $u['user_id'] == session('id_user')) { ?>
                                                <a href="/livechat/edit/<?= $u['id_livechat']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="/livechat/delete/<?= $u['id_livechat'] ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Yakin ingin menghapus data?')">Delete</a>
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
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<?= $this->endSection() ?>