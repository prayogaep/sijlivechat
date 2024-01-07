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
        <!-- Tabel User -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Form Aduan Livechat</h3>
                    </div>
                    <form action="/livechat/update/<?= $livechat['id_livechat']; ?>" method="post">
                        <div class="mb-3">
                            <label for="tanggal_aduan" class="form-label">Tanggal Aduan</label>
                            <input type="date" class="form-control" id="tanggal_aduan" name="tanggal_aduan" readonly value="<?= $livechat['tanggal_aduan']; ?>" required>
                            <input type="hidden" class="form-control" id="user_id" name="user_id" readonly value="<?= $livechat['user_id']; ?>" required>
                            <input type="hidden" class="form-control" id="status" name="status" readonly value="<?= $livechat['status']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Nama Kategori</label>
                            <select class="form-control" name="kategori_id" id="kategori_id" required>
                                <option value="" selected disabled>-Pilih Kategori-</option>
                                <?php foreach ($kategori as $k) { ?>
                                    <option value="<?= $k['id_kategori']; ?>" <?= $k['id_kategori'] == $livechat['kategori_id'] ? 'selected' : '' ?>><?= $k['nama_kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Aduan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"><?= $livechat['keterangan']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= base_url('/livechat');?>" class="btn btn-primary">Cancel<a/>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<?= $this->endSection() ?>