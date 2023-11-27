<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Edit User</h4>
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
        <!-- ============================================================== -->
        <!-- Tabel User -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Form Edit User</h3>
                    </div>
                    <form action="/user/update/<?= $user['id_user'] ?>" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select class="form-control" name="role_id" id="role_id" onchange='render(this, <?= $asn ? $objAsn : $objKategori; ?>, <?= json_encode($user) ?>)' required>
                                <option value="" selected disabled>-Pilih Role-</option>
                                <!-- $role ini yang di bawa dari $data yang ada di controller function create -->
                                <?php foreach ($roles as $r) { ?>
                                    <option value="<?= $r['id_role']; ?>" <?= $r['id_role'] == $user['role_id'] ? 'selected' : '' ?>><?= $r['nama_role']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="target">
                            <?php if ($user['role_id'] == 3) { ?>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip" value="<?= $asn->nip; ?>" name="nip" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" value="<?= $asn->nama; ?>" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="asal_dinas" class="form-label">Asal Dinas</label>
                                    <input type="text" class="form-control" id="asal_dinas" value="<?= $asn->asal_dinas; ?>" name="asal_dinas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="" cols="30" rows="5" required><?= $asn->alamat; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No Hp</label>
                                    <input type="text" class="form-control" id="no_hp" value="<?= $asn->no_hp; ?>" name="no_hp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="umur" class="form-label">Umur</label>
                                    <input type="number" class="form-control" id="umur" value="<?= $asn->umur; ?>" name="umur" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?= $asn->email; ?>" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gol_jabatan" class="form-label">Golongan Jabatan</label>
                                    <input type="text" class="form-control" id="gol_jabatan" value="<?= $asn->gol_jabatan; ?>" name="gol_jabatan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" value="<?= $asn->jabatan; ?>" name="jabatan" required>
                                </div>
                            <?php } else if ($user['role_id'] == 2) { ?>
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori Operator</label>
                                    <select class="form-control" name="kategori_id" id="kategori_id" required>
                                        <option value="" selected disabled>-Pilih Kategori-</option>
                                        <!-- $role ini yang di bawa dari $data yang ada di controller function create -->
                                        <?php foreach ($kategori as $k) { ?>
                                            <option value="<?= $k['id_kategori']; ?>" <?= $k['id_kategori'] == $user['kategori_id'] ? 'selected' : '' ?>><?= $k['nama_kategori']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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