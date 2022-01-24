<?php
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrasi Karyawan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>component/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url();?>component/plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition register-page" style="background-image:url('<?=base_url();?>component/dist/img/photo1.png');background-size: cover;">
<div class="register-box">
  <div class="register-logo" style="margin-bottom:50%">
    <!-- <a href="#"><b>Daftar</b></a> -->
  </div>

  <div class="register-box-body">
    <p class="login-box-msg" style="color:#dd4b39;font-size:24px">Daftar Akun Baru</p>

    <form action="<?=base_url();?>karyawan/register_save" method="post">
      <div class="form-group">
        <select id="dept" name="id_department" class="form-control" required>
          <option value="" disabled="" selected="">-- pilih Department --</option>
      <?php
      if (isset($listdepartment)) {
        foreach ($listdepartment as $key => $value) {
          echo "<option value='".$value->id_department."'>".$value->nama_department."</option>";
        }
      }
      ?>
        </select>
      </div>
      <div class="form-group">
        <select id="sect" name="id_section" class="form-control" required>
          <option value="" disabled="" selected="">-- pilih Section --</option>
      <?php
      if (isset($listsection)) {
        foreach ($listsection as $key => $value) {
          echo "<option value='".$value->id_section."'>".$value->nama_section."</option>";
        }
      }
      ?>
        </select>
      </div>
      <div class="form-group">
        <select name="id_position" class="form-control" required>
          <option value="" disabled="" selected="">-- pilih Position --</option>
      <?php
      if (isset($listposition)) {
        foreach ($listposition as $key => $value) {
          echo "<option value='".$value->id_position."'>".$value->position."</option>";
        }
      }
      ?>
        </select>
      </div>
      <div class="form-group has-feedback">
        <input name="nik" type="text" class="form-control" placeholder="NIK" required>
        <span class="glyphicon glyphicon-bookmark form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="nama" type="text" class="form-control" placeholder="Nama" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="uid" name="rfid" type="text" class="form-control" placeholder="RFID (tap pada reader)" required>
        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="token" type="text" class="form-control" placeholder="Token Reader" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" required> Setuju untuk daftar akun
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="<?=base_url();?>login" class="text-center" style="color:#dd4b39">Login Karyawan</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?=base_url();?>component/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url();?>component/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url();?>component/plugins/iCheck/icheck.min.js"></script>
<script>

  var ajax_call = function(){
    $.getJSON("<?=base_url();?>karyawan/publicrfidreader", function(result){
        //console.log(result);
        if (result.status == "success") {
          if (result.reader[0].status == "1") {
            document.getElementById("uid").value = result.reader[0].uid_rfid;
          }
        }
    });
  };
  var interval = 1000; // where 1000 is 1 second

  setInterval(ajax_call, interval);

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  document.getElementById("dept").onchange = function () {
    $("#sect").empty();
    var e = document.getElementById("dept");
    var value = e.options[e.selectedIndex].value;
    var text = e.options[e.selectedIndex].text;
    var select = document.getElementById('sect');

    $.getJSON("<?=base_url();?>karyawan/getsectionbydept/"+value, function(result){
      //console.log(result);
      if (result.status == "success") {
        result.section.forEach(function(entry) {
          //console.log(entry.id_section);

          var opt = document.createElement('option');
          opt.value = entry.id_section;
          opt.innerHTML = entry.nama_section;
          select.appendChild(opt);
        });
      };
    });
  };
</script>
</body>
</html>
