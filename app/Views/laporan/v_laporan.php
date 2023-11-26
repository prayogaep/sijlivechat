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
        <!-- ============================================================== -->
        <!-- Three charts -->
        <!-- ============================================================== -->
        <div class="row justify-content-between">
            <div class="white-box analytics-info">
                <form class="space-y-6" action="" method="get">
                    <?php
                    $sBulan = $_GET ? $_GET['bulan'] : date('m');
                    $sTahun = $_GET ? $_GET['tahun'] : date('Y');
                    ?>
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0 mt-3">Laporan Jumlah Pengaduan</h3>
                        <div class="col-md-6 col-sm-6 col-xs-6 ms-auto">
                            <div class="row">
                                <div class="col">
                                    <label for="largeInput" class="form-label">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-select shadow-none row border-top" onchange="search()">
                                        <?php foreach ($bulan as $b => $v) { ?>
                                            <option value="<?= $b; ?>" <?= $sBulan == $b ? 'selected' : '' ?>><?= $v; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                <label for="largeInput" class="form-label">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-select shadow-none row border-top" onchange="search()">
                                        <?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
                                            <option value="<?= $i; ?>" <?= $sTahun == $i ? 'selected' : '' ?>><?= $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-4 col-md-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Jumlah Pengaduan</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ms-auto"><span class="counter text-success"><?= $jumlah_aduan ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Pengaduan Selesai</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash2"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ms-auto"><span class="counter text-purple"><?= $jumlah_aduan_selesai ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Pengaduan Belum Selesai</h3>
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <div id="sparklinedash3"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                            </div>
                        </li>
                        <li class="ms-auto"><span class="counter text-info"><?= $jumlah_aduan_belum_selesai ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="white-box analytics-info">
                <h3 class="box-title">Laporan Jumlah Pengaduan Selesai Per Operator</h3>
            </div>
        </div>
        <div class="row justify-content-between">
            <?php foreach ($jumlah_peroperator as $jpo) { ?>
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title"><?= $jpo->username ?></h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter text-success"><?= $jpo->total ?></span></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row justify-content-between">
            <div class="white-box analytics-info">
                <h3 class="box-title">Laporan Jumlah Pengaduan Per Kategori</h3>
            </div>
        </div>
        <div class="row justify-content-between">
            <?php foreach ($jumlah_perkategori as $jpo) { ?>
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title"><?= $jpo->nama_kategori ?></h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter"><?= $jpo->total ?></span></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<script>
    function search() {
        let bulan = document.getElementById('bulan').value;
        let tahun = document.getElementById('tahun').value;
        window.location.href = "?bulan=" + bulan + "&tahun=" + tahun;
    }
</script>
<?= $this->endSection() ?>