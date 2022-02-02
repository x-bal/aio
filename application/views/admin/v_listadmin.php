<?php

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access - Admin</title>
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

    if ($set == "list-admin") {

    ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Admin
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_admin"><i class="fa fa-users"></i> Daftar Admin</a></li>
            <li class="active">List Admin</li>
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
                  <a href="<?= base_url(); ?>admin/add_admin"><button type="button" class="btn btn-danger btn-md">Tambah Admin</button></a>
                  <br><br>
                  <h1 class="box-title">
                    <!-- Daftar Admin -->
                  </h1>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="t1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="text-align:center">No</th>
                        <th style="text-align:center">Department</th>
                        <th style="text-align:center">Nama</th>
                        <th style="text-align:center">Email</th>
                        <th style="text-align:center">Username</th>
                        <th style="text-align:center">Gambar</th>
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
                        </tr>
                        <?php } else {
                        $no = 0;
                        foreach ($listdata as $row) {
                          $no++; ?>
                          <tr>
                            <td style="text-align:center"><?php echo $no; ?></td>
                            <td style="text-align:center"><?php echo $row->nama_department; ?></td>
                            <td style="text-align:center"><?php echo $row->nama; ?></td>
                            <td style="text-align:center"><?php echo $row->email; ?></td>
                            <td style="text-align:center"><?php echo $row->username; ?></td>
                            <td style="text-align:center"><img src="<?= base_url(); ?>component/dist/img/admin/<?= $row->image; ?>" class="img-circle" width="auto" height="100px" alt="User Image"></td>
                            <td style="text-align:center">
                              <?php
                              if ($row->id_user != 1) {
                              ?>
                                <a href="<?= base_url() ?>admin/edit_admin/<?= $row->id_user ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a href="<?= base_url() ?>admin/menu_access/<?= $row->id_user ?>?role=admin" title="Set Menu Access Room" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-th"></i></a>
                                <a href="<?= base_url() ?>admin/hapus_admin/<?= $row->id_user ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                              <?php
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
    } else if ($set == "add-admin") {
    ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tambah Admin
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_admin"><i class="fa fa-user"></i> Daftar Admin</a></li>
            <li class="active">Tambah Admin</li>
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
                <?php echo form_open_multipart(base_url() . 'admin/save_admin'); ?>
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
                    <label>Nama Admin</label>
                    <input type="text" name="nama" class="form-control" placeholder="Enter name" required>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label for="InputFile">Pilih Foto ("jpg", "jpeg", "gif", "png")</label>
                    <input type="file" name="image" id="InputFile" value="" required>
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
    } else if ($set == "edit-admin") {
      if (!isset($id_department)) {
        $id_department = 0;
      }
    ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Admin
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/list_admin"><i class="fa fa-user"></i> Daftar Admin</a></li>
            <li class="active">Edit Admin</li>
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
                <?php echo form_open_multipart(base_url() . 'admin/save_edit_admin'); ?>
                <div class="box-body">
                  <div class="form-group">
                    <input type="hidden" name="id" value="<?= $id_user; ?>">
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
                    <label>Nama Admin</label>
                    <input type="text" name="nama" class="form-control" placeholder="Enter name" value="<?= $nama; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?= $email; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $username; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <div class="input-group-addon" style="text-align:left">
                      Ganti Password ? (default username) <input type="checkbox" name="changepass">
                    </div>
                  </div>
                  <div class="form-group">
                    <img src="<?= base_url(); ?>component/dist/img/admin/<?php if (isset($gambar)) {
                                                                            echo $gambar;
                                                                          } ?>" width="auto" height="200px"><br>
                    <input type="hidden" name="img" value="<?php if (isset($gambar)) {
                                                              echo $gambar;
                                                            } ?>">
                    <label for="InputFile">Pilih Foto ("jpg", "jpeg", "gif", "png")</label>
                    <input type="file" name="image" id="InputFile" value="">
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
  </script>
</body>

</html>