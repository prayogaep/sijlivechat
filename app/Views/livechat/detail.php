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
                    <div id="container">
                      <div id="summernote">
                      </div>

                    </div>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
  $(document).ready(function() {
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

      function getImageUrl() {
        // Mendapatkan HTML konten dari Summernote
        var summernoteContent = $('#summernote').summernote('code');

        // Membuat elemen HTML sementara untuk memanipulasi konten

      }
      $('#send').on('click', function() {
        // var msg = $('#message-input').val();
        var imageUrl = null;
        var msg = $('#summernote').summernote('code');
        var tempElement = document.createElement('div');
        tempElement.innerHTML = msg;

        // Mendapatkan elemen <img> dari konten Summernote
        var imageElement = tempElement.querySelector('img');

        if (imageElement) {
          // Mendapatkan nilai atribut src dari elemen <img>
          imageUrl = imageElement.getAttribute('src');
          console.log('Image URL:', imageUrl);
        }
        // Menghapus elemen <img> dari elemen sementara
        var imageElements = tempElement.querySelectorAll('img');
        imageElements.forEach(function(img) {
          img.parentNode.removeChild(img);
        });

        // Mendapatkan HTML konten tanpa elemen <img>
        msg = tempElement.innerHTML;
        myMessage(msg, imageUrl);
        if (imageUrl) {
          msg += "#photo_" + imageUrl;
        }
        conn.send(msg);
        $('#message-input').val('');
        $('#summernote').summernote('reset');
      })
    });

    function newMessage(msg) {
      let imgUrl = '';
      let send = '';
      if (msg.photo) {
        imgUrl += `<img src="${msg.photo}" width="100" height="100">`;
      }
      let pesan = msg.message.split('#photo_');
      if (pesan.length > 1) {
        send = pesan[0];
      } else {
        send = msg.message;
      }
      html = `<div class="col-8 msg-item left-msg">
                    <div class="msg-text">
                      <span class="author">` + msg.author + `</span> <span class="time">` + msg.time + `</span><br>
                      <p>${send}</p>
                      ${imgUrl}
                    </div>
                  </div>`
      $('#messages').append(html)
      scrollMsgBottom()
    }

    function myMessage(msg, imageUrl) {
      var name = '<?= session()->get('username') ?>'
      var date = new Date;
      var minutes = date.getMinutes();
      var hour = date.getHours();
      var time = hour + ':' + minutes
      html = `<div class="col-8 msg-item right-msg offset-4">
                    <div class="msg-text">
                      <span class="author">Me</span> <span class="time">` + time + `</span><br>
                      <p>` + msg + `</p>
                      <img src="${imageUrl}" width="100" height="100">
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

    $('#summernote').summernote({
      placeholder: 'Ketik disini...',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  });
</script>
<?= $this->endSection() ?>