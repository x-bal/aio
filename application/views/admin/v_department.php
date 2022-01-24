<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Door Lock Access - Department</title>
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

  if ($set == "list-department") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Department
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/department"><i class="fa fa-building"></i> Department</a></li>
          <li class="active">List Department</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                <a href="<?=base_url();?>admin/add_department"><button type="button" class="btn btn-danger btn-md">Tambah Department</button></a>
                <br><br>
                <h1 class="box-title"><!-- Daftar Department --></h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Nama Department</th>
                    <th style="text-align:center">Section</th>
                    <th style="text-align:center">Created at</th>
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
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($listdata as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center">
                      <a href="<?=base_url()?>admin/add_section/<?=$row->id_department?>" title="Tambah Section" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i></a>
                      <a href="<?=base_url()?>admin/list_section/<?=$row->id_department?>" title="Daftar Section" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-list"></i></a>
                    </td>
                    <td style="text-align:center"><?php echo Date("d-M-Y H:i:s",$row->created_at);?></td>
                    <td style="text-align:center">
                      <a href="<?=base_url()?>admin/edit_department/<?=$row->id_department?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                      <a href="<?=base_url()?>admin/hapus_department/<?=$row->id_department?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
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
  } else if ($set == "add-department") {
  ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tambah Department
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/department"><i class="fa fa-building"></i> Department</a></li>
          <li class="active">Tambah Department</li>
        </ol>
      </section>

          <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h1 class="box-title"><!-- Tambah Admin --></h1>
              </div>
              <!-- /.box-header -->
              <form role="form" action="<?=base_url();?>admin/save_department" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama Department</label>
                    <input type="text" name="department" class="form-control" placeholder="Enter name" required>
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
  }else if ($set == "edit-department") {
    if (!isset($nama_department)) {
      $nama_department = "";
    }
    if (!isset($id)) {
      $id = 0;
    }
  ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Edit Department
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/department"><i class="fa fa-building"></i> Department</a></li>
          <li class="active">Edit Department</li>
        </ol>
      </section>

          <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h1 class="box-title"><!-- Tambah Admin --></h1>
              </div>
              <!-- /.box-header -->
              <form role="form" action="<?=base_url();?>admin/save_edit_department" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <label>Nama Department</label>
                    <input type="text" name="department" class="form-control" placeholder="Enter name" value="<?=$nama_department;?>" required>
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
