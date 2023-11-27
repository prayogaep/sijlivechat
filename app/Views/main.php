<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
  <meta name="description" content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
  <meta name="robots" content="noindex,nofollow">
  <title>SIJAWARA | <?= $title; ?></title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/plugins/images/favicon.png">
  <!-- Custom CSS -->
  <link href="<?= base_url() ?>assets/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
  <!-- Custom CSS -->
  <link href="<?= base_url() ?>assets/css/style.min.css" rel="stylesheet">
  <script src="<?= base_url() ?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
  <style>
    .form-wrapper {
      border-radius: 7px;
    }

    .form-wrapper label {
      font-weight: bold;
    }

    .errors li {
      list-style: none;
      width: 100%;
      text-align: center;
    }

    .errors ul {
      padding-left: 0;
      margin-bottom: 0;
    }

    .message-holder {
      border: 1px solid #ccc;
      border-radius: 4px;
      overflow-x: hidden;
      overflow-y: auto;
      height: 400px;
      margin-bottom: 20px;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .msg-item {
      overflow: hidden;
      clear: both;
      margin-bottom: 12px;
      padding-top: 10px;
      border-radius: 4px;
      padding-bottom: 10px;
    }

    .msg-text {
      padding-left: 70px;
      padding-top: 5px;
      line-height: 19px;
      padding-right: 70px;
    }

    .msg-img {
      width: 60px;
      margin: 0 10px;
    }

    .author {
      font-weight: bold;
    }

    .msg-item p {
      margin: 0;
    }

    .msg-item .time {
      font-size: 10px;
    }

    .msg-item.left-msg {
      background: #0e85a0;
      color: #fff;
    }

    .msg-item.right-msg {
      background: #444;
      color: #fff;
    }

    .time {
      color: #fff;
      opacity: 0.8;
      ;

    }

    .left-msg .msg-img {
      float: left;
    }

    .right-msg {
      text-align: right;
    }

    .right-msg .msg-img {
      float: right;
    }

    @media (max-width: 768px) {
      .form-wrapper .text-right {
        text-align: center !important;
      }

      .form-wrapper .btn-primary {
        display: block;
        margin: 0 auto;
      }
    }
  </style>
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <?= $this->include('layouts/header') ?>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->


    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <?= $this->include('layouts/sidebar') ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <?= $this->renderSection('content') ?>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <?= $this->include('layouts/footer') ?>

    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?= base_url() ?>assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/js/app-style-switcher.js"></script>
  <script src="<?= base_url() ?>assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
  <!--Wave Effects -->
  <script src="<?= base_url() ?>assets/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="<?= base_url() ?>assets/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="<?= base_url() ?>assets/js/custom.js"></script>
  <!--This page JavaScript -->
  <!--chartis chart-->
  <script src="<?= base_url() ?>assets/plugins/bower_components/chartist/dist/chartist.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
  <script src="<?= base_url() ?>assets/js/pages/dashboards/dashboard1.js"></script>
  <script>
    function render(val, obj = {}, opt = {}) {
      $(".target").html("");
      if (typeof obj === 'string') {
        obj = JSON.parse(obj);
      }
      if (typeof opt === 'string') {
        opt = JSON.parse(opt);
      }

      if (val.value == 3) {
        $(".target").append(`
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="${ obj.nip ? obj.nip : "" }" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" value="${ obj.nama ? obj.nama : "" }" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="asal_dinas" class="form-label">Asal Dinas</label>
                            <input type="text" class="form-control" id="asal_dinas" value="${ obj.asal_dinas ? obj.asal_dinas : "" }" name="asal_dinas" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" id="" cols="30" rows="5" required>${ obj.alamat ? obj.alamat : "" }</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Hp</label>
                            <input type="text" class="form-control" id="no_hp" value="${ obj.no_hp ? obj.no_hp : "" }" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" class="form-control" id="umur" value="${ obj.umur ? obj.umur : "" }" name="umur" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="${ obj.email ? obj.email : "" }" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="gol_jabatan" class="form-label">Golongan Jabatan</label>
                            <input type="text" class="form-control" id="gol_jabatan" value="${ obj.gol_jabatan ? obj.gol_jabatan : "" }" name="gol_jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" value="${ obj.jabatan ? obj.jabatan : "" }" name="jabatan" required>
                        </div>
                `);
      } else if(val.value == 2) {
        let option = '';
        for (let index = 0; index < obj.length; index++) {
             option += `<option value="${obj[index].id_kategori}" ${opt.kategori_id == obj[index].id_kategori ? "selected" : ""}>${obj[index].nama_kategori}</option>`;
        }
        $('.target').append(`<div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori Operator</label>
                            <select class="form-control" name="kategori_id" id="kategori_id" required>
                                <option value="" selected disabled>-Pilih Kategori-</option>
                                ${option}
                            </select>
                        </div>`)
      }
    }
  </script>
</body>

</html>