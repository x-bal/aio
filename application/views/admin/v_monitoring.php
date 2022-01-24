<?php
$id_dep = 0;

$jmlroom = 0;
if (isset($listdepartment)) {
  foreach ($listdepartment as $key => $value) {
    if (isset($alldoorlock)) {
      $zx = 0;
      foreach ($alldoorlock as $key2 => $value2) {
        if ($value2->id_department == $value->id_department) {
          $zx++;
        }
      }
      if ($jmlroom < $zx) {
        $jmlroom = $zx;
      }
    }
  }
}

if (!isset($id_department)) {
  $id_department = 0;
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


</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <?php
    $this->load->view('admin/contain/header.php');

    if ($set == "monitoring") {

    ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Realtime Monitoring Room
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/department"><i class="fa fa-window-restore"></i> Monitoring Room</a></li>
            <!-- <li class="active"></li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header text-center">
                  <?php echo "<br>";
                  echo $this->session->flashdata('pesan'); ?>
                  <h1 class="box-title">DOORLOCK MANAGEMENT SYSTEM</h1><br>
                  <h1 class="label label-danger">SUKABUMI PLANT</h1>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <form role="form" action="<?= base_url(); ?>admin/monitoringdep" method="get">
                      <select onchange="this.form.submit()" name="id_department" class="form-control">
                        <option value="all">All Area</option>
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
                    </form>
                  </div>
                  <div class="col-md-4"></div>
                </div>
                <div class="box-body" style="padding-top:50px">
                  <?php
                  if (isset($listdepartment)) {
                    foreach ($listdepartment as $key => $value) {
                  ?>
                      <div class="col-md-3 text-center" style="padding-bottom:50px">
                        <div class="bg bg-black">
                          <?= $value->nama_department; ?>
                        </div><br>
                        <?php
                        if (isset($alldoorlock)) {
                          $zy = 0;
                          foreach ($alldoorlock as $key2 => $value2) {
                            if ($value2->id_department == $value->id_department) {
                              $zy++;
                        ?>
                              <div class="bg bg-primary">
                                <?= $value2->nama_room; ?>
                              </div>
                              <div style="margin-bottom:10px">
                                <table class="table table-bordered" id="<?= $value2->id_room; ?>">
                                  <!-- <tr>
                            <td class="bg bg-warning">AUTO</td>
                            <td class="bg bg-danger">CLOSED</td>
                            <td class="bg bg-success">LOCKED</td>
                          </tr> -->
                                </table>
                              </div><br>
                        <?php
                            }
                          }
                          for ($i = $zy; $i < $jmlroom; $i++) {
                            $v = 1;
                            //echo '<div class="bg bg-success"><font style="color:#000;color:rgba(0,0,0,0);">-</font></div>';
                            //echo '<br>';
                          }
                        }
                        ?>
                      </div>
                  <?php
                    }
                  }
                  ?>

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
    } else if ($set == "monitoring-department") {

    ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Realtime Monitoring Room
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/department"><i class="fa fa-window-restore"></i> Monitoring Room</a></li>
            <!-- <li class="active"></li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header text-center">
                  <?php echo "<br>";
                  echo $this->session->flashdata('pesan'); ?>
                  <h1 class="box-title">DOORLOCK MANAGEMENT SYSTEM</h1><br>
                  <h1 class="label label-danger">SUKABUMI PLANT</h1>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <form role="form" action="<?= base_url(); ?>admin/monitoringdep" method="get">
                      <select onchange="this.form.submit()" name="id_department" class="form-control">
                        <option value="all">All Departement</option>
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
                    </form>
                  </div>
                  <div class="col-md-4"></div>
                </div>
                <div class="box-body" style="padding-top:50px">
                  <?php
                  if (isset($alldoorlock)) {
                    foreach ($alldoorlock as $key => $value) {
                  ?>
                      <div class="col-md-3 text-center" style="padding-bottom:30px">
                        <div class="bg bg-primary">
                          <?= $value->nama_room; ?>
                        </div>
                        <div style="margin-bottom:10px">
                          <table class="table table-bordered" id="<?= $value->id_room; ?>">
                            <!-- <tr>
                            <td class="bg bg-warning">AUTO</td>
                            <td class="bg bg-danger">CLOSED</td>
                            <td class="bg bg-success">LOCKED</td>
                          </tr> -->
                          </table>
                        </div>
                      </div>
                  <?php
                    }
                  }
                  ?>
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

  <script>
    var ajax_call = function() {
      $.getJSON("<?= base_url(); ?>api/realtimemonitoring", function(result) {
        //console.log(result);
        //console.log(result.data[0]);
        for (var i = 0; i < result.data.length; i++) {
          //console.log(result.data[i].auto);
          //console.log(result.data[i].open);
          //console.log(result.data[i].id_room);

          var relay = "";
          var bgrelay = "";
          if (result.data[i].relay_open == 1) {
            relay = "UNLOCKED";
            bgrelay = "warning";
          } else {
            relay = "LOCKED";
            bgrelay = "success";
          }

          var auto = "";
          var bgauto = "";
          if (result.data[i].auto == 1) {
            auto = "AUTO";
            bgauto = "success";
            relay = "UNLOCKED";
            bgrelay = "warning";
          } else {
            auto = "MANUAL";
            bgauto = "danger";
          }

          var open = "";
          var bgopen = "";
          if (result.data[i].open == 1) {
            open = "OPEN";
            bgopen = "danger";
            relay = "UNLOCKED";
            bgrelay = "warning";
          } else {
            open = "CLOSED";
            bgopen = "success";
          }

          if (document.getElementById(result.data[i].id_room)) {
            document.getElementById(result.data[i].id_room).innerHTML = "<tr><td class='bg bg-" + bgauto + "'>" + auto + "</td><td class='bg bg-" + bgopen + "'>" + open + "</td><td class='bg bg-" + bgrelay + "'>" + relay + "</td></tr>";
          }
        };

        if (result.status == "foundnewcard") {
          if (result.data == "set") {
            alert("OK");
          } else {
            alert("RFID Card tidak terdaftar");
          }
        }
      });
    };
    var interval = 1000; // where 1000 is 1 second

    setInterval(ajax_call, interval);
  </script>
</body>

</html>