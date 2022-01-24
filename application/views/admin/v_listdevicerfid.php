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
  $this->load->view('admin/contain/header.php');

  if ($set == "list-device-rfid") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Device RFID
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/list_room"><i class="fa fa-address-card"></i> Penambah RFID</a></li>
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
                <a href="<?=base_url();?>admin/add_device_rfid"><button type="button" class="btn btn-danger btn-md">Tambah Device</button></a>
                <br><br>
                <h1 class="box-title"><!-- Daftar Ruangan --></h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center">ID Device</th>
                    <th style="text-align:center">Department</th>
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
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($listdata as $row){ $no++;?>
                  <tr>
                    <td style="text-align:center"><?php echo $row->id_device_rfid;?></td>
                    <td style="text-align:center"><?php echo $row->nama_department;?></td>
                    <td style="text-align:center"><?php echo date("d-M-Y H:i:s",$row->created_at);?></td>
                    <td style="text-align:center">
                        <a href="<?=base_url()?>admin/edit_device_rfid/<?=$row->id_device_rfid?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="<?=base_url()?>admin/hapus_device_rfid/<?=$row->id_device_rfid?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
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
  } else if ($set == "add-device-rfid") {
  ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tambah Device RFID
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/list_room"><i class="fa fa-address-card"></i> Penambah RFID</a></li>
          <li class="active">Tambah Device RFID</li>
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
              <form role="form" action="<?=base_url();?>admin/save_device_rfid" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label>Department</label>
                    <select name="id_department" class="form-control" required>
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
  } else if ($set == "edit-device-rfid") {
      if (!isset($id_department)) {
        $id_department = 0;
      }
  ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Edit Device RFID
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/list_admin"><i class="fa fa-address-card"></i> Penambah RFID</a></li>
          <li class="active">Edit Device RFID</li>
        </ol>
      </section>

          <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h1 class="box-title"><!-- Edit Admin --></h1>
              </div>
              <!-- /.box-header -->
              <form role="form" action="<?=base_url();?>admin/save_edit_device_rfid" method="post">
                <div class="box-body">
                  <div class="form-group">
                  <input type="hidden" name="id_device_rfid" value="<?=$id_device_rfid;?>">
                    <label>Department</label>
                    <select name="id_department" class="form-control" required>
                      <option value="" disabled="" selected="">-- pilih Department --</option>
                  <?php
                  if (isset($listdepartment)) {
                    foreach ($listdepartment as $key => $value) {
                  ?>
                      <option value="<?=$value->id_department;?>" <?php if($value->id_department == $id_department)echo "selected";?>><?=$value->nama_department;?></option>
                  <?php
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
