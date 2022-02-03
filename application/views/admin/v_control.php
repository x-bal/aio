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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="<?= base_url(); ?>component/dist/css/skins/skin-blue-light.css">

  <!-- css control -->
  <link rel="stylesheet" href="<?= base_url(); ?>component/dist/css/app.css">
  <link rel="stylesheet" href="<?= base_url(); ?>component/dist/css/line-awesome.min.css">
  <!-- end css -->
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <?php
    $this->load->view('admin/contain/header.php');

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
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="box p-5 mt-6 bg-theme-36 intro-x">
                  <div class="flex flex-wrap gap-3">
                    <a class="flex items-center justify-center w-12 h-12 rounded-full bg-theme-37 dark:bg-dark-1 bg-opacity-20 hover:bg-opacity-30 text-white" href="">
                      <i class="las la-door-open text-theme-39 text-xl font-black"></i>
                    </a>
                    <div class="mr-auto">
                      <div class="text-theme-39 text-2xl font-medium leading-5 mt-3.5"><?php if (isset($totaldoorlock)) echo $totaldoorlock; ?></div>
                      <div class="text-theme-38 text-opacity-70 flex items-center leading-4"> Total DoorLock </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="box p-5 mt-6 bg-theme-40 intro-x">
                  <div class="flex flex-wrap gap-3">
                    <a class="flex items-center justify-center w-12 h-12 rounded-full bg-theme-41 dark:bg-dark-1 bg-opacity-20 hover:bg-opacity-30 text-white" href="">
                      <i class="las la-door-closed text-theme-42 text-xl font-black"></i>
                    </a>
                    <div class="mr-auto">
                      <div class="text-theme-42 text-2xl font-medium leading-5 mt-3.5"><?= $closed; ?> </div>
                      <div class="text-theme-38 text-opacity-70 flex items-center leading-4"> Closed </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="box p-5 mt-6 bg-theme-45 intro-x">
                  <div class="flex flex-wrap gap-3">
                    <a class="flex items-center justify-center w-12 h-12 rounded-full bg-theme-44 dark:bg-dark-1 bg-opacity-20 hover:bg-opacity-30 text-white" href="">
                      <i class="las la-door-open text-theme-43 text-xl font-black"></i>
                    </a>
                    <div class="mr-auto">
                      <div class="text-theme-43 text-2xl font-medium leading-5 mt-3.5"><?= $open; ?> </div>
                      <div class="text-theme-38 text-opacity-70 flex items-center leading-4"> Open </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="box p-5 mt-6 bg-theme-36 intro-x">
                  <div class="flex flex-wrap gap-3">
                    <a class="flex items-center justify-center w-12 h-12 rounded-full bg-theme-37 dark:bg-dark-1 bg-opacity-20 hover:bg-opacity-30 text-white" href="">
                      <i class="las la-cog text-theme-39 text-xl font-black"></i>
                    </a>
                    <div class="mr-auto">
                      <div class="text-theme-39 text-2xl font-medium leading-5 mt-3.5"><?= $auto; ?></div>
                      <div class="text-theme-38 text-opacity-70 flex items-center leading-4"> Auto </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="box p-5 mt-6 bg-theme-48 intro-x">
                  <div class="flex flex-wrap gap-3">
                    <a class="flex items-center justify-center w-12 h-12 rounded-full bg-theme-47 dark:bg-dark-1 bg-opacity-20 hover:bg-opacity-30 text-white" href="">
                      <i class="las la-wrench text-theme-46 text-xl font-black"></i>
                    </a>
                    <div class="mr-auto">
                      <div class="text-theme-46 text-2xl font-medium leading-5 mt-3.5"><?= $manual; ?> </div>
                      <div class="text-theme-38 text-opacity-70 flex items-center leading-4"> Manual </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header text-center" style="background-color: #004d9f; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <form role="form" action="<?= base_url(); ?>admin/control" method="get">
                      <select onchange="this.form.submit()" name="id_department" class="h-10 pl-5 pr-10 hover:border-theme-53 focus:outline-none appearance-none border-none my-3 text-white dark:text-gray-300 bg-theme-53 p-2 rounded-full stroke-current form-select form-select-light sm:w-auto">
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

                  <div class="card-body">
                    <div class="row mt-5">
                      <?php if (isset($listdoorlock)) {
                        foreach ($listdoorlock as $door) :
                      ?>
                          <div class="col-md-3" style="margin-bottom: 20px;">
                            <div class="card shadow" style="background-color: #FEFEFE;">
                              <div class="card-body p-2">
                                <div class="head flex mb-3" style="justify-content: space-between;">
                                  <div class="title">
                                    <p class="font-bold"><?= $door->nama_room ?></p>
                                    <p class="font-bold">Dept. <?= $door->nama_department ?></p>
                                  </div>

                                  <div class="dropdown">
                                    <a href="javascript:;" title="control relay" class="dropdown-toggle block" aria-expanded="true">
                                      <i class="las la-ellipsis-v text-xl"></i>
                                    </a>
                                    <div class="dropdown-menu w-40">
                                      <div class="dropdown-menu__content box dark:bg-dark-1">
                                        <div class="px-4 py-2 border-b border-gray-200 dark:border-dark-5 font-medium text-center">Doorlock Control</div>
                                        <div class="p-2">
                                          <div class="mt-2 text-center">
                                            <?php
                                            if ($door->auto == 0) {
                                            ?>
                                              <label>Lock | unLock</label>
                                              <div class="mt-1">
                                                <div class="col-md-4">
                                                </div>
                                                <div class="form-check">
                                                  <form role="form" action="<?= base_url(); ?>admin/control_relay" method="post">
                                                    <input type="hidden" name="id_room" value="<?= $door->id_room; ?>">
                                                    <input type="hidden" name="link" value="<?= $link; ?>">
                                                    <input name="checkbox_relay" value="1" onchange="this.form.submit()" class="form-check-switch" type="checkbox" <?php if ($door->relay_open == 1) echo "checked"; ?>>
                                                  </form>
                                                </div>
                                              </div>
                                            <?php
                                            } else {
                                              echo "set position switch to Manual";
                                            }
                                            ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="status flex">
                                  <?php if ($door->open == 1) { ?>
                                    <div class="inline-flex items-center justify-center px-2 py-1 font-bold leading-none rounded-full bg-theme-44 text-white text-md w-auto">Open</div>
                                  <?php } else { ?>
                                    <div class="inline-flex items-center justify-center px-2 py-1 font-bold leading-none rounded-full bg-theme-41 text-white text-md w-auto">Closed</div>
                                  <?php } ?>

                                  <?php if ($door->auto == 1) { ?>
                                    <div class="dropdown">
                                      <a href="javascript:;" title="set position" class="dropdown-toggle block" aria-expanded="true">
                                        <div class="inline-flex items-center justify-center px-2 py-1 font-bold leading-none rounded-full bg-theme-37 text-white text-md w-auto">Auto</div>
                                      </a>
                                      <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1">
                                          <div class="px-4 py-2 border-b border-gray-200 dark:border-dark-5 font-medium text-center">Position Switch</div>
                                          <div class="p-2">
                                            <div class="mt-2 text-center form-group">
                                              <label>Auto | Manual</label>
                                              <div class="mt-1">
                                                <div class="col-md-4">
                                                </div>
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
                                        </div>
                                      </div>
                                    </div>
                                  <?php } else { ?>
                                    <div class="dropdown">
                                      <a href="javascript:;" title="set position" class="dropdown-toggle block" aria-expanded="true">
                                        <div class="inline-flex items-center justify-center px-2 py-1 font-bold leading-none rounded-full bg-theme-47 text-white text-md w-auto">Manual</div>
                                      </a>
                                      <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1">
                                          <div class="px-4 py-2 border-b border-gray-200 dark:border-dark-5 font-medium text-center">Position Switch</div>
                                          <div class="p-2">
                                            <div class="mt-2 text-center form-group">
                                              <label>Auto | Manual</label>
                                              <div class="mt-1">
                                                <div class="col-md-4">
                                                </div>
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
                                        </div>
                                      </div>
                                    </div>
                                  <?php } ?>
                                </div>

                                <div class="door">
                                  <center>
                                    <?php
                                    if ($door->open == 0 && $door->auto == 0 && $door->relay_open == 0) {
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

  <!-- script control -->
  <script src="<?= base_url(); ?>component/dist/js/app.js"></script>
  <!-- end script -->
</body>

</html>