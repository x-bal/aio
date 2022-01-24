<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Karyawan</title>
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

  if ($set == "list-karyawan") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Karyawan
          <small>Department <?=$nama_department;?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/list_karyawan"><i class="fa fa-users"></i> Daftar Karyawan</a></li>
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
                <a href="<?=base_url();?>admin/add_karyawan"><button type="button" class="btn btn-danger btn-md">Tambah Karyawan</button></a>
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
                    <th style="text-align:center">Section</th>
                    <th style="text-align:center">Position</th>
                    <th style="text-align:center">RFID</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Disable Remarks</th>
                    <th style="text-align:center">Foto</th>
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
                    <td style="text-align:center"><?php echo $row->nama_section;?></td>
                    <td style="text-align:center"><?php echo $row->position;?></td>
                    <td style="text-align:center"><?php echo $row->uid_rfid;?></td>
                    <td style="text-align:center">
                      <?php 
                        if ($row->status == 1){
                          echo "Aktif";
                        }else{
                          echo "Tidak Aktif";
                        }
                      ?>
                    </td>
                    <td style="text-align:center">
                      <?php 
                        if ($row->disable_remarks == 1){
                          echo "Ya";
                        }else{
                          echo "Tidak";
                        }
                      ?>
                    </td>
                    <td style="text-align:center"><img src="<?=base_url();?>component/dist/img/karyawan/<?=$row->foto;?>" class="img-circle" width="50px" height="auto" alt="User Image"></td>
                    <td style="text-align:center"><?php echo date("d-M-Y H:i:s",$row->created_karyawan);?></td>
                    <td style="text-align:center">
                        <!-- <a href="<?=base_url()?>admin/edit_karyawan/<?=$row->id_karyawan?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a> -->
                        <a href="<?=base_url()?>admin/hapus_karyawan/<?=$row->id_karyawan?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
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
  } else if ($set == "list-karyawan-all") {
  
  ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Karyawan
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/list_karyawan"><i class="fa fa-users"></i> Daftar Karyawan</a></li>
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
                <a href="<?=base_url();?>admin/add_karyawan"><button type="button" class="btn btn-danger btn-md">Tambah Karyawan</button></a>
                <br><br>
                <h1 class="box-title"><!-- Daftar Karyawan --></h1>
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
                    <th style="text-align:center">RFID</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Disable Remarks</th>
                    <th style="text-align:center">Foto</th>
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
                    <td style="text-align:center"><?php echo $row->uid_rfid;?></td>
                    <td style="text-align:center">
                      <?php 
                        if ($row->status == 1){
                          echo "Aktif";
                        }else{
                          echo "Tidak Aktif";
                        }
                      ?>
                    </td>
                    <td style="text-align:center">
                      <?php 
                        if ($row->disable_remarks == 1){
                          echo "Ya";
                        }else{
                          echo "Tidak";
                        }
                      ?>
                    </td>
                    <td style="text-align:center"><img src="<?=base_url();?>component/dist/img/karyawan/<?=$row->foto;?>" class="img-circle" width="50px" height="auto" alt="User Image"></td>
                    <td style="text-align:center"><?php echo date("d-M-Y H:i:s",$row->created_karyawan);?></td>
                    <td style="text-align:center">
                        <a href="<?=base_url()?>admin/set_access/<?=$row->id_karyawan?>" title="Set Access Room" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-list"></i></a>
                        <a href="<?=base_url()?>admin/edit_karyawan/<?=$row->id_karyawan?>" title="Edit Karyawan" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="<?=base_url()?>admin/hapus_karyawan/<?=$row->id_karyawan?>" title="Hapus Karyawan" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
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
  } else if ($set == "add-karyawan") {
  ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tambah Karyawan
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/list_karyawan"><i class="fa fa-users"></i> Daftar Karyawan</a></li>
          <li class="active">Tambah Karyawan</li>
        </ol>
      </section>

          <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h1 class="box-title"></h1>
              </div>
              <!-- /.box-header -->
              <form role="form" action="<?=base_url();?>admin/save_karyawan" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label>Department</label>
                    <select id="dept" name="id_department" class="form-control" required>
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
                  <div class="form-group">
                    <label>Section</label>
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
                    <label>Position</label>
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
              
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="number" name="nik" class="form-control" placeholder="Enter NIK" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama_karyawan" class="form-control" placeholder="Enter Name" required>
                  </div>
                  <div class="form-group">
                    <label>RFID</label>
                    <input type="text" name="rfid" class="form-control" placeholder="Tap RFID Card" required>
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
  } else if ($set == "edit-karyawan") {
      if (!isset($id_department)) {
        $id_department = 0;
      }
  ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Edit Karyawan
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url();?>admin/list_admin"><i class="fa fa-user"></i> Daftar Karyawan</a></li>
          <li class="active">Edit Karyawan</li>
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
              <form action="<?=base_url();?>admin/save_edit_karyawan" method="post">
                <div class="box-body">
                  <div class="form-group">
                  <input type="hidden" name="id" value="<?=$id_karyawan;?>">
                    <label>Department</label>
                    <select id="dept" name="department" class="form-control" required>
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

                  <div class="form-group">
                    <label>Section</label>
                    <select id="sect" name="id_section" class="form-control" required>
                      <option value="" disabled="" selected="">-- pilih Section --</option>
                  <?php
                  if (isset($listsection)) {
                    foreach ($listsection as $key => $value) {
                  ?>
                      <option value="<?=$value->id_section;?>" <?php if($value->id_section == $id_section)echo "selected";?>><?=$value->nama_section;?></option>
                  <?php
                    }
                  }
                  ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Position</label>
                    <select name="id_position" class="form-control" required>
                      <option value="" disabled="" selected="">-- pilih Position --</option>
                  <?php
                  if (isset($listposition)) {
                    foreach ($listposition as $key => $value) {
                  ?>
                      <option value="<?=$value->id_position;?>" <?php if($value->id_position == $id_position)echo "selected";?>><?=$value->position;?></option>
                  <?php
                    }
                  }
                  ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="number" name="nik" class="form-control" placeholder="Enter NIK" value="<?=$nik;?>" required>
                  </div>

                  <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama" class="form-control" placeholder="Enter name" value="<?=$nama_karyawan;?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label>RFID</label>
                    <input type="text" name="rfid" class="form-control" placeholder="Tap RFID Card" value="<?=$uid_rfid;?>" required>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                      <option value="1" <?php if($status == "1")echo "selected";?>>Aktif</option>
                      <option value="0" <?php if($status == "0")echo "selected";?>>Tidak Aktif</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Disable Remarks</label>
                    <select name="disable_remarks" class="form-control" required>
                      <option value="1" <?php if($disable_remarks == "1")echo "selected";?>>Ya</option>
                      <option value="0" <?php if($disable_remarks == "0")echo "selected";?>>Tidak</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Ganti Password?</label>
                      <div class="input-group-addon" style="text-align:left">
                        (default NIK) <input type="checkbox" name="changepass">
                      </div>
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

<?php
if ($set == "edit-karyawan" || $set == "add-karyawan") {
?>
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
<?php
}
?>
</script>
</body>
</html>
