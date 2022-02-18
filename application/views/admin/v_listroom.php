<?php

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Ruangan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="<?= base_url(); ?>favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?= base_url(); ?>favicon.ico" type="image/x-icon">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="<?= base_url(); ?>component/dist/css/skins/skin-blue-light.css">


</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <?php
    $this->load->view('admin/contain/header.php');

    if ($set == "list-room") {

    ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Ruangan
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_room"><i class="fa fa-home"></i> Room</a></li>
            <li class="active">Daftar Ruangan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <?php echo "<br>";
                  echo $this->session->flashdata('pesan'); ?>
                  <a href="<?= base_url(); ?>admin/add_room"><button type="button" class="btn btn-danger btn-md">Tambah Ruangan</button></a>
                  <br><br>
                  <h1 class="box-title">
                    <!-- Daftar Ruangan -->
                  </h1>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="t1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="text-align:center">ID Ruangan</th>
                        <th style="text-align:center">Department</th>
                        <th style="text-align:center">Nama Ruangan</th>
                        <th style="text-align:center">Tipe Ruangan</th>
                        <th style="text-align:center">Remarks</th>
                        <th style="text-align:center">Gambar</th>
                        <th style="text-align:center">Total Karyawan</th>
                        <th style="text-align:center">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (empty($listdata)) { ?>
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
                        <?php } else {
                        $no = 0;
                        foreach ($listdata as $row) {
                          $no++; ?>
                          <tr>
                            <td style="text-align:center"><?php echo $row->id_room; ?></td>
                            <td style="text-align:center"><?php echo $row->nama_department; ?></td>
                            <td style="text-align:center"><?php echo $row->nama_room; ?></td>
                            <td style="text-align:center"><?php echo $row->type; ?></td>
                            <td style="text-align:center">
                              <?php
                              if ($row->type == "public") {
                                if ($row->need_remarks == 1) {
                                  echo "Ya";
                                } else {
                                  echo "Tidak";
                                }
                              } else {
                                echo "Tidak";
                              }
                              ?>
                            </td>
                            <td style="text-align:center">
                              <?php
                              if ($row->img_room != "") {
                              ?>
                                <img src="<?= base_url(); ?>component/dist/room/<?= $row->img_room; ?>" width="auto" height="100px">
                              <?php
                              } else {
                                echo "-";
                              }
                              ?>
                            </td>
                            <td style="text-align:center">
                              <a href="<?= base_url('admin/count-karyawan/' . $row->id_room) ?>" class="btn btn-sm btn-info"> <?= $this->db->query(" SELECT COUNT(id_karyawan) as total FROM access_room_karyawan WHERE id_room = $row->id_room ")->row()->total; ?>
                              </a>
                            </td>
                            <td style="text-align:center">
                              <a href="<?= base_url() ?>admin/uploadimg_room/<?= $row->id_room ?>" title="upload gambar" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-picture"></i></a>
                              <a href="<?= base_url() ?>admin/edit_room/<?= $row->id_room ?>" title="edit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                              <a href="<?= base_url() ?>admin/hapus_room/<?= $row->id_room ?>" title="hapus" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                          </tr>
                      <?php }
                      } ?>

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
    } else if ($set == "add-room") {
    ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tambah Ruangan
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_room"><i class="fa fa-home"></i> Room</a></li>
            <li class="active">Tambah Ruangan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h1 class="box-title">
                    <!-- Tambah Admin -->
                  </h1>
                </div>
                <!-- /.box-header -->
                <form role="form" action="<?= base_url(); ?>admin/save_room" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Department</label>
                      <select name="department" class="form-control" required>
                        <option value="" disabled="" selected="">-- pilih Department --</option>
                        <?php
                        if (isset($listdepartment)) {
                          foreach ($listdepartment as $key => $value) {
                            echo "<option value='" . $value->id_department . "'>" . $value->nama_department . "</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Nama Ruangan</label>
                      <input type="text" name="room" class="form-control" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                      <label>Tipe Ruangan</label>
                      <select id="type" name="type" class="form-control" required>
                        <option value="restricted">Restricted</option>
                        <option value="public">Public</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Remarks?</label>
                      <select id="remarks" name="remarks" class="form-control" required>
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
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
    } else if ($set == "edit-room") {
      if (!isset($id_department)) {
        $id_department = 0;
      }
    ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Ruangan
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_room"><i class="fa fa-home"></i> Room</a></li>
            <li class="active">Edit Ruangan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h1 class="box-title">
                    <!-- Edit Admin -->
                  </h1>
                </div>
                <!-- /.box-header -->
                <form action="<?= base_url(); ?>admin/save_edit_room" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <input type="hidden" name="id" value="<?= $id_room; ?>">
                      <label>Department</label>
                      <select name="department" class="form-control" required>
                        <option value="" disabled="" selected="">-- pilih Department --</option>
                        <?php
                        if (isset($listdepartment)) {
                          foreach ($listdepartment as $key => $value) {
                        ?>
                            <option value="<?= $value->id_department; ?>" <?php if ($value->id_department == $id_department) echo "selected"; ?>><?= $value->nama_department; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Nama Ruangan</label>
                      <input type="text" name="nama" class="form-control" placeholder="Enter name" value="<?= $nama_room; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Tipe Ruangan</label>
                      <select id="type" name="type" class="form-control" required>
                        <option value="restricted" <?php if ($type == "restricted") echo "selected"; ?>>Restricted</option>
                        <option value="public" <?php if ($type == "public") echo "selected"; ?>>Public</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Remarks?</label>
                      <select id="remarks" name="remarks" class="form-control" required>
                        <option value="0" <?php if ($need_remarks == "0") echo "selected"; ?>>Tidak</option>
                        <option value="1" <?php if ($need_remarks == "1") echo "selected"; ?>>Ya</option>
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
    } else if ($set == "list-room-dep") {

    ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Ruangan
            <small>Department <?= $nama_department; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_room"><i class="fa fa-home"></i> Room</a></li>
            <!-- <li class="active">Daftar Ruangan</li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <?php echo $this->session->flashdata('pesan'); ?>

                  <h1 class="box-title">
                    <!-- Daftar Ruangan -->
                  </h1>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="t1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="text-align:center">ID Ruangan</th>
                        <th style="text-align:center">Nama Ruangan</th>
                        <th style="text-align:center">Tipe Ruangan</th>
                        <th style="text-align:center">Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (empty($listdata)) { ?>
                        <tr>
                          <td>Data tidak ditemukan</td>
                          <td>Data tidak ditemukan</td>
                          <td>Data tidak ditemukan</td>
                          <td>Data tidak ditemukan</td>
                        </tr>
                        <?php } else {
                        $no = 0;
                        foreach ($listdata as $row) {
                          $no++; ?>
                          <tr>
                            <td style="text-align:center"><?php echo $row->id_room; ?></td>
                            <td style="text-align:center"><?php echo $row->nama_room; ?></td>
                            <td style="text-align:center"><?php echo $row->type; ?></td>
                            <td style="text-align:center">
                              <?php
                              if ($row->type == "public") {
                                if ($row->need_remarks == 1) {
                                  echo "Ya";
                                } else {
                                  echo "Tidak";
                                }
                              } else {
                                echo "Tidak";
                              }
                              ?>
                            </td>
                          </tr>
                      <?php }
                      } ?>

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
    } else if ($set == "uploadimg-room") {
      if (!isset($id_department)) {
        $id_department = 0;
      }
    ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Upload Gambar Ruangan
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_room"><i class="fa fa-home"></i> Room</a></li>
            <li class="active">Upload Gambar Ruangan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h1 class="box-title">
                    <!-- Edit Admin -->
                  </h1>
                </div>
                <!-- /.box-header -->
                <form action="<?= base_url(); ?>admin/save_upload_room" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?= $id_room; ?>">
                        <label>Department</label>
                        <select name="department" class="form-control" required disabled="">
                          <option value="" disabled="" selected="">-- pilih Department --</option>
                          <?php
                          if (isset($listdepartment)) {
                            foreach ($listdepartment as $key => $value) {
                          ?>
                              <option value="<?= $value->id_department; ?>" <?php if ($value->id_department == $id_department) echo "selected"; ?>><?= $value->nama_department; ?></option>
                          <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tipe Ruangan</label>
                        <select id="type" name="type" class="form-control" required disabled="">
                          <option value="restricted" <?php if ($type == "restricted") echo "selected"; ?>>Restricted</option>
                          <option value="public" <?php if ($type == "public") echo "selected"; ?>>Public</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="img" value="<?= $img_room; ?>">
                        <label for="InputFile">Pilih Foto ("jpg", "jpeg", "gif", "png")</label>
                        <input type="file" name="image" id="InputFile" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input type="text" name="nama" class="form-control" placeholder="Enter name" value="<?= $nama_room; ?>" required disabled="">
                      </div>
                      <div class="form-group">
                        <label>Remarks?</label>
                        <select id="remarks" name="remarks" class="form-control" required disabled="">
                          <option value="0" <?php if ($need_remarks == "0") echo "selected"; ?>>Tidak</option>
                          <option value="1" <?php if ($need_remarks == "1") echo "selected"; ?>>Ya</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <?php
                        if ($img_room != "") {
                        ?>
                          <img src="<?= base_url(); ?>component/dist/room/<?= $img_room; ?>" width="auto" height="300px">
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Upload</button>
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
  <script src="<?= base_url(); ?>component/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url(); ?>component/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url(); ?>component/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>component/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>component/dist/js/adminlte.min.js"></script>
  <!-- page script -->
  <script>
    $(function() {
      $("#t1").DataTable();
    });

    <?php
    if ($set == "add-room") {
    ?>
      document.getElementById("type").onchange = function() {
        document.getElementById("remarks").setAttribute("disabled", "disabled");
        if (this.value == 'public')
          document.getElementById("remarks").removeAttribute("disabled");
      };

      if (document.getElementById("type").value == 'restricted') {
        document.getElementById("remarks").setAttribute("disabled", "disabled");
      };
    <?php
    }

    if ($set == "edit-room") {
    ?>
      document.getElementById("type").onchange = function() {
        document.getElementById("remarks").setAttribute("disabled", "disabled");
        if (this.value == 'public')
          document.getElementById("remarks").removeAttribute("disabled");
      };

      if (document.getElementById("type").value == 'restricted') {
        document.getElementById("remarks").setAttribute("disabled", "disabled");
      };
    <?php
    }
    ?>
  </script>
</body>

</html>