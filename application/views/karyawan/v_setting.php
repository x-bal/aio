<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Device RFID</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>component/dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="<?=base_url();?>component/dist/css/skins/skin-blue-light.css">


</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">


<?php
$this->load->View('karyawan/contain/header.php');

if ($set=="setting") {
  $skey = "";
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>admin/setting"><i class="fa fa-gear"></i> Setting</a></li>
        <!-- <li class="active">Lihat Histori Device</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header text-center">
              <?php echo $this->session->flashdata('pesan');?>
              <h3>Profil Karyawan</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive">
              <div class="col-md-3">
                
              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr style="text-align:center">
                      <td>NIK</td>
                      <td><?=$nik;?></td>
                    </tr>
                    <tr style="text-align:center">
                      <td>Nama</td>
                      <td><?=$namauser;?></td>
                    </tr>
                    <tr style="text-align:center">
                      <td>Position</td>
                      <td><?=$nama_position;?></td>
                    </tr>
                    <tr style="text-align:center">
                      <td>Department</td>
                      <td><?=$nama_department;?></td>
                    </tr>
                    <tr style="text-align:center">
                      <td>Section</td>
                      <td><?=$nama_section;?></td>
                    </tr>
                    <tr style="text-align:center">
                      <td>UID RFID</td>
                      <td><?=$rfid;?></td>
                    </tr>
                    <tr style="text-align:center">
                      <td>Status</td>
                      <td><?php if($status == 1) echo "Aktif"; else echo "Tidak Aktif";?></td>
                    </tr>
                    <tr style="text-align:center">
                      <td>Foto</td>
                      <td><img src="<?=base_url();?>component/dist/img/karyawan/<?=$avatar;?>" class="img-circle" alt="User Image" width="auto" height="150px" /></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-3">
                
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3>Ganti Password</h3>
            </div>
            <!-- /.box-header -->

            <form role="form" action="<?=base_url();?>karyawan/save_change_password" method="post">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="id_karyawan" value="<?=$id_karyawan;?>">
                  <label>Password Sekarang</label>
                  <input type="text" name="password" class="form-control" placeholder="Enter current password" required>
                </div>
                <div class="form-group">
                  <input type="hidden" name="id_karyawan" value="<?=$id_karyawan;?>">
                  <label>Password Baru</label>
                  <input type="text" name="password1" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                  <input type="hidden" name="id_karyawan" value="<?=$id_karyawan;?>">
                  <label>Ulangi Password Baru</label>
                  <input type="text" name="password2" class="form-control" placeholder="Enter confirm password" required>
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-success">Ganti Password</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3>Ganti Foto</h3>
            </div>
            <!-- /.box-header -->

            <?php echo form_open_multipart(base_url().'karyawan/save_change_foto'); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="InputFile">Pilih Foto ("jpg", "jpeg", "gif", "png")</label>
                  <input type="file" name="image" id="InputFile" value="" required>
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-success">Upload Foto</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php
} 

$this->load->view('karyawan/contain/footer.php');
?>

</div>  <!-- penutup header -->

<!-- jQuery 3 -->
<script src="<?=base_url();?>component/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url();?>component/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url();?>component/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>component/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>component/dist/js/adminlte.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#t1").DataTable();
  });

</script>
</body>
</html>