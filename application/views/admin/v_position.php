<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Position</title>
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

  if ($set == "position") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Position
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/position"><i class="fa fa-bookmark"></i> Position</a></li>
          <li class="active">Daftar Position</li>
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
                    <th style="text-align:center">Position</th>
                    <th style="text-align:center">Keterangan</th>
                    <!-- <th style="text-align:center">#</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($listdata)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <!-- <td>Data tidak ditemukan</td> -->
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($listdata as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->position;?></td>
                    <td style="text-align:center"><?php echo $row->ket;?></td>
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
