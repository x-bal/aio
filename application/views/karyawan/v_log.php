<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Log Aktivitas</title>
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

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <?php
  $this->load->view('karyawan/contain/header.php');

  if ($set == "log") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Log Aktivitas 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>karyawan/log"><i class="fa fa-book"></i> Log Aktivitas</a></li>
          <!-- <li class="active"></li> -->
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                <h1 class="box-title"><!-- Daftar Ruangan --></h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Pintu</th>
                    <th style="text-align:center">Keterangan</th>
                    <th style="text-align:center">Remark</th>
                    <th style="text-align:center">Waktu Akses</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($logkaryawan)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($logkaryawan as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center"><?php echo $row->keterangan;?></td>
                    <td style="text-align:center"><?php echo $row->remarks_log;?></td>
                    <td style="text-align:center"><?php echo date("H:i:s d-M-Y",$row->access_time);?></td>
                    <!-- <td style="text-align:center">
                        <a href="<?=base_url()?>admin/edit_position/<?=$row->id_position?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td> -->
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
  } else if ($set == "log2") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Log Aktivitas 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>karyawan/log"><i class="fa fa-book"></i> Log Aktivitas</a></li>
          <!-- <li class="active"></li> -->
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                <h1 class="box-title"><?=$namauser;?></h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Room</th>
                    <th style="text-align:center">Keterangan</th>
                    <th style="text-align:center">Remark</th>
                    <th style="text-align:center">Waktu Akses</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($logkaryawan)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($logkaryawan as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center"><?php echo $row->keterangan;?></td>
                    <td style="text-align:center"><?php echo $row->remarks_log;?></td>
                    <td style="text-align:center"><?php echo date("H:i:s d-M-Y",$row->access_time);?></td>
                    
                  </tr>
                  <?php }}?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              <div class="box-body table-responsive">
                <h4>Team</h4>
                <table id="t2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Room</th>
                    <th style="text-align:center">Nama Karyawan</th>
                    <th style="text-align:center">NIK</th>
                    <th style="text-align:center">Position</th>
                    <th style="text-align:center">Keterangan</th>
                    <th style="text-align:center">Remark</th>
                    <th style="text-align:center">Waktu Akses</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($logbawahan)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
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
                  foreach($logbawahan as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center"><?php echo $row->nama_karyawan;?></td>
                    <td style="text-align:center"><?php echo $row->nik;?></td>
                    <td style="text-align:center"><?php echo $row->position;?></td>
                    <td style="text-align:center"><?php echo $row->keterangan;?></td>
                    <td style="text-align:center"><?php echo $row->remarks_log;?></td>
                    <td style="text-align:center"><?php echo date("H:i:s d-M-Y",$row->access_time);?></td>
                    <!-- <td style="text-align:center">
                        <a href="<?=base_url()?>admin/edit_position/<?=$row->id_position?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td> -->
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
  } else if ($set == "log3") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Log Aktivitas 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>karyawan/log"><i class="fa fa-book"></i> Log Aktivitas</a></li>
          <!-- <li class="active"></li> -->
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                <h1 class="box-title"><?=$namauser;?></h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Room</th>
                    <th style="text-align:center">Keterangan</th>
                    <th style="text-align:center">Remark</th>
                    <th style="text-align:center">Waktu Akses</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($logkaryawan)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($logkaryawan as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center"><?php echo $row->keterangan;?></td>
                    <td style="text-align:center"><?php echo $row->remarks_log;?></td>
                    <td style="text-align:center"><?php echo date("H:i:s d-M-Y",$row->access_time);?></td>
                    
                  </tr>
                  <?php }}?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              <div class="box-body table-responsive">
                <h4>Team</h4>
                <form action="<?=base_url();?>karyawan/downloadlog" method="post">
                  <div class="col-md-3">
                    <input type="hidden" name="flagjabatan" value="<?php echo $flagjabatan;?>">
                  </div>
                  <div class="form-group col-md-6 text-center">
                    <button type="submit" class="btn btn-danger">Download Log Aktivitas</button>
                  </div>
                  <div class="col-md-3">
                  </div>
                </form>
                <table id="t2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Room</th>
                    <th style="text-align:center">Nama Karyawan</th>
                    <th style="text-align:center">NIK</th>
                    <th style="text-align:center">Position</th>
                    <th style="text-align:center">Keterangan</th>
                    <th style="text-align:center">Remark</th>
                    <th style="text-align:center">Waktu Akses</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($logbawahan)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
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
                  foreach($logbawahan as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center"><?php echo $row->nama_karyawan;?></td>
                    <td style="text-align:center"><?php echo $row->nik;?></td>
                    <td style="text-align:center"><?php echo $row->position;?></td>
                    <td style="text-align:center"><?php echo $row->keterangan;?></td>
                    <td style="text-align:center"><?php echo $row->remarks_log;?></td>
                    <td style="text-align:center"><?php echo date("H:i:s d-M-Y",$row->access_time);?></td>
                    <!-- <td style="text-align:center">
                        <a href="<?=base_url()?>admin/edit_position/<?=$row->id_position?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td> -->
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
  } else if ($set == "log4") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Log Aktivitas 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>karyawan/log"><i class="fa fa-book"></i> Log Aktivitas</a></li>
          <!-- <li class="active"></li> -->
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                <h1 class="box-title"><?=$namauser;?></h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Room</th>
                    <th style="text-align:center">Keterangan</th>
                    <th style="text-align:center">Remark</th>
                    <th style="text-align:center">Waktu Akses</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($logkaryawan)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($logkaryawan as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center"><?php echo $row->keterangan;?></td>
                    <td style="text-align:center"><?php echo $row->remarks_log;?></td>
                    <td style="text-align:center"><?php echo date("H:i:s d-M-Y",$row->access_time);?></td>
                    
                  </tr>
                  <?php }}?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              <div class="box-body table-responsive">
                <h4>Team</h4>
                <form action="<?=base_url();?>karyawan/downloadlog" method="post">
                  <div class="col-md-3">
                    <input type="hidden" name="flagjabatan" value="<?php echo $flagjabatan;?>">
                  </div>
                  <div class="form-group col-md-6 text-center">
                    <button type="submit" class="btn btn-danger">Download Log Aktivitas</button>
                  </div>
                  <div class="col-md-3">
                  </div>
                </form>
                <table id="t2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Department</th>
                    <th style="text-align:center">Room</th>
                    <th style="text-align:center">Nama Karyawan</th>
                    <th style="text-align:center">NIK</th>
                    <th style="text-align:center">Position</th>
                    <th style="text-align:center">Keterangan</th>
                    <th style="text-align:center">Remark</th>
                    <th style="text-align:center">Waktu Akses</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($logbawahan)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
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
                  foreach($logbawahan as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center"><?php echo $row->nama_karyawan;?></td>
                    <td style="text-align:center"><?php echo $row->nik;?></td>
                    <td style="text-align:center"><?php echo $row->position;?></td>
                    <td style="text-align:center"><?php echo $row->keterangan;?></td>
                    <td style="text-align:center"><?php echo $row->remarks_log;?></td>
                    <td style="text-align:center"><?php echo date("H:i:s d-M-Y",$row->access_time);?></td>
                    <!-- <td style="text-align:center">
                        <a href="<?=base_url()?>admin/edit_position/<?=$row->id_position?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td> -->
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
  }
  $this->load->view('karyawan/contain/footer.php');
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
<!-- date-range-picker -->
<script src="<?=base_url();?>component/bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url();?>component/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#t1").DataTable();
    $("#t2").DataTable();
  });

  $(function () {
    //Date range picker
    $('#reservation').daterangepicker()

  });
</script>
</body>
</html>
