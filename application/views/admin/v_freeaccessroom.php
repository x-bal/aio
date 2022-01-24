<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Free Access Room</title>
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
  $this->load->view('admin/contain/header.php');

  if ($set == "list-free-access-room") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Free Access Room
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/free_access_room"><i class="fa fa-exchange"></i> Free Access Room</a></li>
          <!-- <li class="active">Daftar</li> -->
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                <a href="<?=base_url();?>admin/add_free_access_room"><button type="button" class="btn btn-danger btn-md">Tambah Free Access Room</button></a>
                <br><br>
                <h1 class="box-title"><!-- Daftar karyawan --></h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">NIK</th>
                    <th style="text-align:center">Nama</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Section</th>
                    <th style="text-align:center">Position</th>
                    <th style="text-align:center">Foto</th>
                    <th style="text-align:center">#</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($listdata)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($listdata as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nik;?></td>
                    <td style="text-align:center"><?php echo $row->nama_karyawan;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_section;?></td>
                    <td style="text-align:center"><?php echo $row->position;?></td>
                    <td style="text-align:center"><img src="<?=base_url();?>component/dist/img/karyawan/<?=$row->foto;?>" class="img-circle" width="50px" height="auto" alt="User Image"></td>
                    <td style="text-align:center">
                        <a href="<?=base_url()?>admin/hapus_free_access_room/<?=$row->id_free_access_room?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                  </tr>
                  <?php }}?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  
  <?php
  } else if ($set == "add-free-access-room") {
  ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tambah Free Access Room
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/free_access_room"><i class="fa fa-exchange"></i> Free Access Room</a></li>
          <li class="active">Tambah Free Access Room</li>
        </ol>
      </section>

          <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h1 class="box-title">Pilih Karyawan</h1>
              </div>
              <!-- /.box-header -->
              <form role="form" action="<?=base_url();?>admin/save_free_access_room" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama Karyawan</label>
                    <select name="id_karyawan" class="form-control" required>
                      <option value="" disabled="" selected="">-- pilih Karyawan --</option>
                      <?php
                      if (isset($listkaryawan)) {
                        foreach ($listkaryawan as $key => $value) {
                          echo "<option value='".$value->id_karyawan."'>".$value->nama_karyawan." - (".$value->nama_department.")</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="box-footer">
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
              </form>
              <!-- /.box-body -->
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
  $this->load->view('admin/contain/footer.php');
  ?>

</div>
<!-- ./wrapper -->

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
