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
    <?php if (session('success')) { ?>
      <div class="alert alert-success" role="alert">
        <?= session('success') ?>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-12 pt-3 pb-3 bg-white from-wrapper">
        <div class="container">
          <h3>Chat</h3>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-8">
              <div class="row">
                <div class="col-12">
                  <div class="message-holder">
                    <div id="messages" class="row"></div>
                  </div>
                  <div class="form-group">
                    <textarea id="message-input" class="form-control" name="" rows="2"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <button id="send" class="btn float-right  btn-primary">Send</button>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 mb-3">
              <ul id="user-list" class="list-group"></ul>
              <hr>
              <span>Detail Aduan</span>
              <table class="table no-wrap">
                <tr>
                  <td>Id Aduan</td>
                  <td>:</td>
                  <td><?= $livechat->id_livechat; ?></td>
                </tr>
                <tr>
                  <td>Nama Pengadu</td>
                  <td>:</td>
                  <td><?= $livechat->nama; ?></td>
                </tr>
                <tr>
                  <td>Asal Dinas</td>
                  <td>:</td>
                  <td><?= $livechat->asal_dinas; ?></td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td>:</td>
                  <td><?= $livechat->nama_kategori; ?></td>
                </tr>
              </table>
              <label for="keterangan" class="form-label">Keterangan Aduan</label>
              <textarea class="form-control" readonly rows="3"><?= $livechat->keterangan; ?></textarea>
              <?php if (session('id_role') != 3) { ?>
                <a href="/livechat/selesai/<?= $livechat->id_livechat; ?>" class="btn btn-success btn-lg mt-3" onclick="return confirm('Are you sure ?')">Selesai</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->
</div>
<script>
  var conn = new WebSocket('ws://localhost:8081?access_token=<?= session()->get('id_user') ?>&ticket=<?= $livechat->id_livechat ?>');
  $(function() {
    scrollMsgBottom()
  })

  function scrollMsgBottom() {
    var d = $('.message-holder');
    d.scrollTop(d.prop("scrollHeight"));
  }

  $(function() {

    conn.onopen = function(e) {
      console.log("Connection established!");
    };

    conn.onmessage = function(e) {
      let data = JSON.parse(e.data)
      console.log(data);
      if ('users' in data) {
        updateUsers(data.users)
        // if (data.ticket == "<?= $livechat->id_livechat ?>" && data.connect == 'connecting') {
        // }
      } else if ('message' in data) {
        newMessage(data)
        // if (data.ticket == "<?= $livechat->id_livechat ?>" && data.connect == 'sending') {                
        // }
      }

    };

    $('#send').on('click', function() {
      var msg = $('#message-input').val();
      if (msg.trim() == '')
        return false
      conn.send(msg);
      myMessage(msg);
      $('#message-input').val('')
    })
  })

  function newMessage(msg) {
    html = `<div class="col-8 msg-item left-msg">
                    <div class="msg-text">
                      <span class="author">` + msg.author + `</span> <span class="time">` + msg.time + `</span><br>
                      <p>` + msg.message + `</p>
                    </div>
                  </div>`
    $('#messages').append(html)
    scrollMsgBottom()

  }

  function myMessage(msg) {
    var name = '<?= session()->get('username') ?>'
    var date = new Date;
    var minutes = date.getMinutes();
    var hour = date.getHours();
    var time = hour + ':' + minutes
    html = `<div class="col-8 msg-item right-msg offset-4">
                    <div class="msg-text">
                      <span class="author">Me</span> <span class="time">` + time + `</span><br>
                      <p>` + msg + `</p>
                    </div>
                  </div>`
    $('#messages').append(html)
    scrollMsgBottom()
  }

  function updateUsers(users) {
    var html = ''
    var myId = <?= session()->get('id_user') ?>;


    for (let index = 0; index < users.length; index++) {
      if (myId != users[index].c_user_id)
        html += '<li class="list-group-item">' + users[index].c_name + '</li>'
    }

    if (html == '') {
      html = '<p>The Chat Room is Empty</p>'
    }


    $('#user-list').html(html)


  }
</script>
<?= $this->endSection() ?>