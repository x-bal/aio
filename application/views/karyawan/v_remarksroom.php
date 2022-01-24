<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Remarks Room</title>
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
  $this->load->view('karyawan/contain/header.php');

  if ($set == "remarksroom") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Remarks Room 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>karyawan/remarksroom"><i class="fa fa-building-o"></i> Remarks Room</a></li>
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
                    <th style="text-align:center">Room</th>
                    <th style="text-align:center">Isi Remarks</th>
                    <!-- <th style="text-align:center">#</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($room)){?>
                  <tr>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <td>Data tidak ditemukan</td>
                    <!-- <td>Data tidak ditemukan</td> -->
                  </tr>
                  <?php } else{
                  $no=0;
                  foreach($room as $row){ 
                    $show = 0;
                    if (isset($access_room)) {
                      foreach ($access_room as $keyaccess) {
                        if ($keyaccess->id_room == $row->id_room) {
                          $show++;
                        }
                      }
                    }

                    if ($show > 0) {
                      $no++;
                    ?>
                  <tr>
                    <td style="text-align:center"><?php echo $no;?></td>
                    <td style="text-align:center"><?php echo $row->nama_room;?></td>
                    <td style="text-align:center">
                        <a href="<?=base_url()?>karyawan/fillremarks/<?=$row->id_room?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                  </tr>
                  <?php }}}?>
                  
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
  } else if ($set == "fillremarks") {
    $namaroom = "";
    $id_room = 0;
    if (isset($dataroom)) {
      foreach ($dataroom as $key => $value) {
        $namaroom = $value->nama_room;
        $id_room = $value->id_room;
      }
    }
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Remarks 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>karyawan/remarksroom"><i class="fa fa-building-o"></i> Remarks Room</a></li>
          <li class="active">Remarks</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                <h1 class="box-title"><?=$namaroom;?></h1>
              </div>
              <!-- /.box-header -->
              <form action="<?=base_url();?>karyawan/fillremarkssave" method="post">
                <div class="box-body">

                  <input type="hidden" name="id_karyawan" value="<?=$id_karyawan;?>">
                  <input type="hidden" name="id_room" value="<?=$id_room;?>">
                  
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="number" name="nik" class="form-control" placeholder="Enter NIK" value="<?=$nik;?>" required readonly>
                  </div>

                  <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama" class="form-control" placeholder="Enter name" value="<?=$namauser;?>" required readonly>
                  </div>

                  <div class="form-group">
                    <label>Remarks Activity</label>
                    <select id="activity" name="remarks_activity" class="form-control" required>
                      <option value="" disabled="" selected="">-- pilih Remarks --</option>
                  <?php
                  if (isset($remarksactivity)) {
                    foreach ($remarksactivity as $key => $value) {
                  ?>
                      <option value="<?=$value->id_public_remarks;?>"><?=$value->remarks_activity;?></option>
                  <?php
                    }
                  }
                  ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <input id="activity2" type="text" name="remarks_activity2" class="form-control" placeholder="" required>
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
<!-- page script -->
<script>
  $(function () {
    $("#t1").DataTable();
  });
<?php
if ($set == "fillremarks") {
?>
  document.getElementById("activity2").disabled = true;
  document.getElementById("activity").onchange = function () {
    var e = document.getElementById("activity");
    var value = e.options[e.selectedIndex].value;
    var text = e.options[e.selectedIndex].text;
    if (value == 4) {
      document.getElementById("activity2").placeholder = "isi nama tool";
      document.getElementById("activity2").value = "";
      document.getElementById("activity2").disabled = false;
    }else if (value == 8) {
      document.getElementById("activity2").placeholder = "isi alasan";
      document.getElementById("activity2").value = "";
      document.getElementById("activity2").disabled = false;
    }else{
      document.getElementById("activity2").placeholder = "";
      document.getElementById("activity2").value = "";
      document.getElementById("activity2").disabled = true;
    }

  };
<?php
}
?>
</script>
</body>
</html>
