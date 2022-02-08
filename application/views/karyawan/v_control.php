<?php
$thispage = 1;

if (isset($_GET['page'])) {
  $thispage = $_GET['page'];

  if ($thispage == 0) {
    redirect(base_url() . 'admin/control?page=1');
  }
}

$id_dep = 0;
if (isset($_GET['id_department'])) {
  $id_dep = $_GET['id_department'];
}

$all = 0;
if (isset($_GET['all'])) {
  $all = $_GET['all'];
  if ($all > 1) {
    redirect(base_url() . 'admin/control?all=1');
  }
}

$closed = 0;
$open = 0;
$lock = 0;
$auto = 0;
$manual = 0;

if (isset($alldoorlock)) {
  foreach ($alldoorlock as $key => $value) {
    if ($value->open == 1) {
      $open++;
    } else {
      $closed++;
    }

    if ($value->auto == 1) {
      $auto++;
    } else {
      $manual++;
    }
  }
}

$link = "";
if (isset($_GET['all'])) {
  $link = "all=1";
}
if (isset($_GET['id_department'])) {
  $link = "id_department=" . $_GET['id_department'];
}
if (isset($_GET['page'])) {
  $link = "page=" . $_GET['page'];
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Door Lock Access - Department</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/dist/css/skins/skin-blue-light.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <?php
    $this->load->view('karyawan/contain/header.php');

    if ($set == "list-control") {

    ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DoorLock Management System
            <small>Control Room</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/department"><i class="fa fa-keyboard-o"></i> Control Room</a></li>
            <!-- <li class="active"></li> -->
          </ol>
        </section>
        <!-- BEGIN: Content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row" style="margin-bottom: 20px;">

              <div class="col-md-4" style="margin-bottom: 10px;">
                <div class="card" style="background-color: #DBEAFD; padding: 10px;">
                  <div class="card-body" style="display: flex;">
                    <div class="icon rounded shadow" style="background-color: #CCE2FD; width: 30px; height: 30px; padding: 5px; border-radius: 50%; text-align: center;">
                      <i class="fas fa-door-open" style="color: #3B82F6; font-size: 12px;"></i>
                    </div>

                    <div class="count" style="margin-left: 20px;">
                      <span style="color: #3B82F6;"><?php if (isset($totaldoorlock)) echo $totaldoorlock; ?> </span> <br> <span style="color: grey;">Total DoorLock</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-2" style="margin-bottom: 10px;">
                <div class="card" style="background-color: #FDCACA; padding: 10px;">
                  <div class="card-body" style="display: flex;">
                    <div class="icon rounded shadow" style="background-color: #FCB8B8; width: 30px; height: 30px; padding: 5px; border-radius: 50%; text-align: center;">
                      <i class="fas fa-door-closed" style="color: #DC2626; font-size: 12px;"></i>
                    </div>

                    <div class="count" style="margin-left: 15px;">
                      <span style="color: #DC2626;"><?php if (isset($closed)) echo $closed; ?> </span> <br> <span style="color: grey;">Closed</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-2" style="margin-bottom: 10px;">
                <div class="card" style="background-color: #D1F9E5; padding: 10px;">
                  <div class="card-body" style="display: flex;">
                    <div class="icon rounded shadow" style="background-color: #B1F2D6; width: 30px; height: 30px; padding: 5px; border-radius: 50%; text-align: center;">
                      <i class="fas fa-door-open" style="color: #719669; font-size: 12px;"></i>
                    </div>

                    <div class="count" style="margin-left: 15px;">
                      <span style="color: #719669;"><?php if (isset($open)) echo $open; ?> </span> <br> <span style="color: grey;">Open</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-2" style="margin-bottom: 10px;">
                <div class="card" style="background-color: #DBEAFD; padding: 10px;">
                  <div class="card-body" style="display: flex;">
                    <div class="icon rounded shadow" style="background-color: #CCE2FD; width: 30px; height: 30px; padding: 5px; border-radius: 50%; text-align: center;">
                      <i class="fas fa-cog" style="color: #3B9CF8; font-size: 12px;"></i>
                    </div>

                    <div class="count" style="margin-left: 15px;">
                      <span style="color: #3B9CF8;"><?php if (isset($auto)) echo $auto; ?> </span> <br> <span style="color: grey;">Auto</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-2" style="margin-bottom: 10px;">
                <div class="card" style="background-color: #DDD6FD; padding: 10px;">
                  <div class="card-body" style="display: flex;">
                    <div class="icon rounded shadow" style="background-color: #D1C7FC; width: 30px; height: 30px; padding: 5px; border-radius: 50%; text-align: center;">
                      <i class="fas fa-wrench" style="color: #8B3AEE; font-size: 12px;"></i>
                    </div>

                    <div class="count" style="margin-left: 15px;">
                      <span style="color: #8B3AEE;"><?php if (isset($manual)) echo $manual; ?> </span> <br> <span style="color: grey;">Manual</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header text-center" style="background-color: #004d9f; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <form role="form" action="<?= base_url(); ?>admin/control" method="get" style="margin-left: 45%;">
                      <select onchange="this.form.submit()" name="id_department" class="form-control" style="width: 120px; background-color: #004d9f; color: white; border: none;">
                        <option value="all">All Area</option>
                        <?php
                        if (isset($listdepartment)) {
                          foreach ($listdepartment as $key => $value) {
                        ?>
                            <option value="<?= $value->id_department; ?>" <?php if ($value->id_department == $id_dep) echo "selected"; ?>><?= $value->nama_department; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </form>
                  </div>

                  <div class="card-body" style="margin-top: 20px;">
                    <div class="row mt-5">
                      <?php if (isset($listdoorlock)) {
                        foreach ($listdoorlock as $door) :
                      ?>
                          <div class="col-md-3" style="margin-bottom: 20px;">
                            <div class="card shadow" style="background-color:#FEFEFE;">
                              <div class="card-body" style="padding: 10px;">
                                <div class="head" style="display: flex; justify-content: space-between;">
                                  <div class="title">
                                    <span><b><?= $door->nama_room ?></b></span><br>
                                    <span><b>Dept. <?= $door->nama_department ?></b></span>
                                  </div>

                                  <div class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                      <i class="fas fa-ellipsis-v"></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                      <div class="px-4 py-2 border-b border-gray-200 dark:border-dark-5 font-medium text-center">DoorLock Control
                                        <hr>
                                      </div>

                                      <div class="p-2">
                                        <div class="mt-2 text-center form-group">
                                          <?php if ($door->auto == 0) { ?>
                                            <label>Lock | unLock</label>
                                            <div class="mt-1">
                                              <div class="form-check">
                                                <form role="form" action="<?= base_url(); ?>admin/control_relay" method="post">
                                                  <input type="hidden" name="id_room" value="<?= $door->id_room; ?>">
                                                  <input type="hidden" name="link" value="<?= $link; ?>">
                                                  <input name="checkbox_relay" value="1" onchange="this.form.submit()" class="form-check-switch" type="checkbox" <?php if ($door->relay_open == 1) echo "checked"; ?>>
                                                </form>
                                              </div>
                                            </div>
                                          <?php } else {
                                            echo " Set position switch to Manual";
                                          } ?>
                                        </div>
                                      </div>

                                      <?php if ($door->auto == 1) { ?>
                                        <div class="px-4 py-2 border-b border-gray-200 dark:border-dark-5 font-medium text-center">Position Switch</div>
                                        <div class="p-2">
                                          <div class="mt-2 text-center form-group">
                                            <label>Auto | Manual</label>
                                            <div class="mt-1">
                                              <div class="form-check">
                                                <form role="form" action="<?= base_url(); ?>admin/positionswitch" method="post">
                                                  <input type="hidden" name="id_room" value="<?= $door->id_room; ?>">
                                                  <input type="hidden" name="link" value="<?= $link; ?>">
                                                  <input name="checkbox_position" value="0" onchange="this.form.submit()" class="form-check-switch shadow" type="checkbox" <?php if ($door->auto == 0) echo "checked"; ?>>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <?php } else { ?>
                                        <div class="px-4 py-2 border-b border-gray-200 dark:border-dark-5 font-medium text-center">Position Switch</div>
                                        <div class="p-2">
                                          <div class="mt-2 text-center form-group">
                                            <label>Auto | Manual</label>
                                            <div class="mt-1">
                                              <div class="form-check">
                                                <form role="form" action="<?= base_url(); ?>admin/positionswitch" method="post">
                                                  <input type="hidden" name="id_room" value="<?= $door->id_room; ?>">
                                                  <input type="hidden" name="link" value="<?= $link; ?>">
                                                  <input name="checkbox_position" value="0" onchange="this.form.submit()" class="form-check-switch" type="checkbox" <?php if ($door->auto == 0) echo "checked"; ?>>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <?php } ?>

                                    </ul>
                                  </div>
                                </div>

                                <div class="status" style="display: flex; margin-top: 7px;">
                                  <?php if ($door->open == 1) { ?>
                                    <div style="background-color: #719669; padding-left: 5px; padding-right: 5px; border-radius: 20px; color: white; margin-right: 3px; font-weight: bold;">Open</div>
                                  <?php } else { ?>
                                    <div style="background-color: #DC2626; padding-left: 5px; padding-right: 5px; border-radius: 20px; color: white; margin-right: 3px; font-weight: bold;">Closed</div>
                                  <?php } ?>

                                  <?php if ($door->auto == 1) { ?>
                                    <div style="background-color: #3B82F6; padding-left: 5px; padding-right: 5px; border-radius: 20px; color: white; margin-right: 3px; font-weight: bold;">Auto</div>
                                  <?php } else { ?>
                                    <div style="background-color: #8B3AEE; padding-left: 5px; padding-right: 5px; border-radius: 20px; color: white; margin-right: 3px; font-weight: bold;">Manual</div>
                                  <?php } ?>
                                </div>

                                <div>
                                  <center>
                                    <?php
                                    if ($door->open == 0 && $door->auto == 0 && $door->relay_open == 0) {
                                    ?>
                                      <img src="<?= base_url(); ?>component/dist/images/Lock.svg" alt="" srcset="" width="200" height="200">
                                      <?php
                                    } else {
                                      if ($door->open == 0 && $door->auto == 1) {
                                      ?>
                                        <img src="<?= base_url(); ?>component/dist/images/Lock.svg" alt="" srcset="" width="200" height="200">
                                        <?php
                                      } else {
                                        if ($door->open == 1) {
                                        ?>
                                          <img src="<?= base_url(); ?>component/dist/images/Open.svg" alt="" srcset="" width="200" height="200">
                                        <?php
                                        } else {
                                        ?>
                                          <img src="<?= base_url(); ?>component/dist/images/Close.svg" alt="" srcset="" width="200" height="200">
                                    <?php
                                        }
                                      }
                                    }
                                    ?>
                                  </center>
                                </div>

                              </div>
                            </div>
                          </div>
                      <?php
                        endforeach;
                      }
                      ?>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="mt-8 mx-5 intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                          <ul class="pagination">
                            <?php
                            if ($id_dep == 0) {
                            ?>
                              <li> <a class="pagination__link <?php if ($all == 1) echo 'pagination__link--active'; ?>" href="<?= base_url(); ?>admin/control?all=1">All</a> </li>
                              <?php
                              if ($all == 0) {
                                if (isset($totaldoorlock)) {
                                  $page = intval($totaldoorlock / 8);
                                  $sisa = $totaldoorlock % 8;
                                  //echo $page;
                                  //echo $sisa;
                                  if ($sisa > 0) {
                                    $page++;
                                  }
                                  $x = 0;
                                  for ($z = 0; $z < $page; $z++) {
                                    $x++;
                              ?>
                                    <li> <a class="pagination__link <?php if ($x == $thispage) echo 'pagination__link--active'; ?>" href="<?= base_url(); ?>admin/control?page=<?= $x; ?>"><?= $x; ?></a> </li>
                            <?php
                                  }
                                }
                              }
                            }
                            ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- END: Content -->
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
            <li><a href="<?= base_url(); ?>admin/department"><i class="fa fa-building"></i> Department</a></li>
            <li class="active">Tambah Department</li>
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
                <form role="form" action="<?= base_url(); ?>admin/save_department" method="post">
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
    } else if ($set == "edit-department") {
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
            <li><a href="<?= base_url(); ?>admin/department"><i class="fa fa-building"></i> Department</a></li>
            <li class="active">Edit Department</li>
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
                <form role="form" action="<?= base_url(); ?>admin/save_edit_department" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <input type="hidden" name="id" value="<?= $id; ?>">
                      <label>Nama Department</label>
                      <input type="text" name="department" class="form-control" placeholder="Enter name" value="<?= $nama_department; ?>" required>
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
    $this->load->view('karyawan/contain/footer.php');
    ?>

  </div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script src="<?= base_url(); ?>component/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url(); ?>component/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url(); ?>component/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="<?= base_url(); ?>component/bower_components/raphael/raphael.min.js"></script>
  <script src="<?= base_url(); ?>component/bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url(); ?>component/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="<?= base_url(); ?>component/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?= base_url(); ?>component/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url(); ?>component/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url(); ?>component/bower_components/moment/min/moment.min.js"></script>
  <script src="<?= base_url(); ?>component/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?= base_url(); ?>component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?= base_url(); ?>component/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?= base_url(); ?>component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url(); ?>component/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>component/dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url(); ?>component/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>component/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script src="<?= base_url(); ?>component/dist/js/Chart.min.js"></script>
  <script src="<?= base_url(); ?>component/dist/js/utils.js"></script>

  <!-- page script -->
  <script>
    $(function() {
      $("#t1").DataTable();
    });
  </script>
</body>

</html>