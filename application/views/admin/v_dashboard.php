<?php
$datax = [];
$iddepcursor = [];
$y = 0;

$dataTunggu = [];
$idDepTunggu = [];
$tunggu = 0;

$dataProduction = [];
$idDepProduction = [];
$production = 0;

$dataOffice = [];
$idDepOffice = [];
$office = 0;

if (isset($department)) {
  $datax[0] = 0;
  $dataTunggu[0] = 0;
  $dataProduction[0] = 0;
  $dataOffice[0] = 0;

  foreach ($department as $key => $value) {
    $datax[$value->id_department] = 0;
    $dataTunggu[$value->id_department] = 0;
    $dataProduction[$value->id_department] = 0;
    $dataOffice[$value->id_department] = 0;

    $iddepcursor[$y] = $value->id_department;
    $idDepTunggu[$tunggu] = $value->id_department;
    $idDepProduction[$production] = $value->id_department;
    $idDepOffice[$office] = $value->id_department;

    $y++;
    $tunggu++;
    $production++;
    $office++;
  }
};

$nama_room = "";
if (isset($dataAccess)) {
  foreach ($dataAccess as $key => $value) {
    $datax[$value->id_department]++;
    $nama_room = $value->nama_room;
  }
}


if (isset($dataRuangTunggu)) {
  foreach ($dataRuangTunggu as $key => $value) {
    $dataTunggu[$value->id_department]++;
  }
}

if (isset($dataProductionWorkshop)) {
  foreach ($dataProductionWorkshop as $key => $value) {
    $dataProduction[$value->id_department]++;
  }
}

// if (isset($dataOffice)) {
//   var_dump($dataOffice);
//   foreach ($dataOffice as $key) {
//     // $dataOffice[$value->id_department]++;
//   }
// }

// for ($i=0; $i <= $y; $i++) { 
//   echo $datax[$i];
//   echo "<br>";
// }

$jmlKar = 0;
if (isset($karyawan)) {
  foreach ($karyawan as $key => $value) {
    $jmlKar++;
  }
}

$jmlRoom = 0;
if (isset($room)) {
  foreach ($room as $key => $value) {
    $jmlRoom++;
  }
}

$jmlLog = 0;
if (isset($totalAccess)) {
  foreach ($totalAccess as $key => $value) {
    $jmlLog++;
  }
}

if (!isset($note)) {
  $note = "last 30 days";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Door Lock Access</title>
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
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <?php
    $this->load->view('admin/contain/header.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?= base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <!-- <li class="active">Dashboard</li> -->
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= $y; ?></h3>

                <p>Department</p>
              </div>
              <div class="icon">
                <i class="ion ion-bookmark"></i>
              </div>
              <a href="<?= base_url(); ?>admin/department" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= $jmlRoom; ?>
                  <!-- <sup style="font-size: 20px">%</sup> -->
                </h3>

                <p>Room</p>
              </div>
              <div class="icon">
                <i class="ion ion-home"></i>
              </div>
              <a href="<?= base_url(); ?>admin/list_room" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= $jmlKar; ?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= base_url(); ?>admin/list_karyawan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?= $jmlLog; ?></h3>

                <p>30 day Access Granted</p>
              </div>
              <div class="icon">
                <i class="ion ion-forward"></i>
              </div>
              <a href="<?= base_url(); ?>admin/log" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12 col-md-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
              <!-- Tabs within a box -->
              <div class="box box-default">
                <div class="box-header with-border text-center">
                  <h3 class="box-title">Select Date Period</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <form action="<?= base_url(); ?>admin/dashboard" method="get">
                      <div class="col-md-2">
                      </div>
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" name="tanggal" class="form-control pull-right" id="reservation">
                        </div>
                        <!-- /.input group -->
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-danger">Query Data</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <!-- /.nav-tabs-custom -->
          </section>
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
              <!-- Tabs within a box -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= $nama_room_dash; ?> Access by Dept <?= $note; ?></h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div id="canvas-holder">
                        <div class="row">
                          <div style="width: 100%; height: 100%">
                            <canvas id="chart-area"></canvas>
                          </div>
                          <!-- <button class="btn btn-box-tool" id="randomizeData">Randomize Data</button>
                        <button class="btn btn-box-tool" id="addDataset">Add Dataset</button>
                        <button class="btn btn-box-tool" id="removeDataset">Remove Dataset</button> -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="box-body table-responsive">
                        <table id="t1" class="table table-bordered table-striped" class="t1">
                          <thead>
                            <tr>
                              <th style="text-align:center">No</th>
                              <th style="text-align:center">Nama</th>
                              <th style="text-align:center">Department</th>
                              <th style="text-align:center">Time</th>
                              <th style="text-align:center">Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (empty($dataAccess)) { ?>

                              <tr>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                              </tr>
                              <?php } else {
                              $no = 0;
                              foreach ($dataAccess as $row) {
                                $no++; ?>
                                <tr>
                                  <td style="text-align:center"><?php echo $no; ?></td>
                                  <td style="text-align:center"><?php echo $row->nama_karyawan; ?></td>
                                  <td style="text-align:center"><?php echo $row->nama_department; ?></td>
                                  <td style="text-align:center">
                                    <?php echo Date("d M y", $row->access_time); ?><br>
                                    <?php echo Date("H:i:s", $row->access_time); ?>
                                  </td>
                                  <td style="text-align:center"><?php echo $row->keterangan; ?></td>
                                  <!-- <td style="text-align:center">
                        <a href="<?= base_url() ?>admin/edit_position/<?= $row->id_position ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td> -->
                                </tr>
                            <?php }
                            } ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <!-- /.nav-tabs-custom -->

          </section>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
              <!-- Tabs within a box -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Ruang Tunggu Access by Dept <?= $note; ?></h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div id="canvas-holder">
                        <div class="row">
                          <div style="width: 100%; height: 100%">
                            <canvas id="chart-area-tunggu"></canvas>
                          </div>
                          <!-- <button class="btn btn-box-tool" id="randomizeData">Randomize Data</button>
                        <button class="btn btn-box-tool" id="addDataset">Add Dataset</button>
                        <button class="btn btn-box-tool" id="removeDataset">Remove Dataset</button> -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="box-body table-responsive">
                        <table id="t2" class="table table-bordered table-striped" class="t1">
                          <thead>
                            <tr>
                              <th style="text-align:center">No</th>
                              <th style="text-align:center">Nama</th>
                              <th style="text-align:center">Department</th>
                              <th style="text-align:center">Time</th>
                              <th style="text-align:center">Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (empty($dataRuangTunggu)) { ?>

                              <tr>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                              </tr>
                              <?php } else {
                              $no = 0;
                              foreach ($dataRuangTunggu as $tg) {
                                $no++; ?>
                                <tr>
                                  <td style="text-align:center"><?php echo $no; ?></td>
                                  <td style="text-align:center"><?php echo $tg->nama_karyawan; ?></td>
                                  <td style="text-align:center"><?php echo $tg->nama_department; ?></td>
                                  <td style="text-align:center">
                                    <?php echo Date("d M y", $tg->access_time); ?><br>
                                    <?php echo Date("H:i:s", $tg->access_time); ?>
                                  </td>
                                  <td style="text-align:center"><?php echo $tg->keterangan; ?></td>
                                  <!-- <td style="text-align:center">
                        <a href="<?= base_url() ?>admin/edit_position/<?= $tg->id_position ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td> -->
                                </tr>
                            <?php }
                            } ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <!-- /.nav-tabs-custom -->

          </section>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
              <!-- Tabs within a box -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Production Workshop Access by Dept <?= $note; ?></h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div id="canvas-holder">
                        <div class="row">
                          <div style="width: 100%; height: 100%">
                            <canvas id="chart-area-prodwork"></canvas>
                          </div>
                          <!-- <button class="btn btn-box-tool" id="randomizeData">Randomize Data</button>
                        <button class="btn btn-box-tool" id="addDataset">Add Dataset</button>
                        <button class="btn btn-box-tool" id="removeDataset">Remove Dataset</button> -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="box-body table-responsive">
                        <table id="t3" class="table table-bordered table-striped" class="t3">
                          <thead>
                            <tr>
                              <th style="text-align:center">No</th>
                              <th style="text-align:center">Nama</th>
                              <th style="text-align:center">Department</th>
                              <th style="text-align:center">Time</th>
                              <th style="text-align:center">Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (empty($dataProductionWorkshop)) { ?>

                              <tr>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                              </tr>
                              <?php } else {
                              $no = 0;
                              foreach ($dataProductionWorkshop as $tg) {
                                $no++; ?>
                                <tr>
                                  <td style="text-align:center"><?php echo $no; ?></td>
                                  <td style="text-align:center"><?php echo $tg->nama_karyawan; ?></td>
                                  <td style="text-align:center"><?php echo $tg->nama_department; ?></td>
                                  <td style="text-align:center">
                                    <?php echo Date("d M y", $tg->access_time); ?><br>
                                    <?php echo Date("H:i:s", $tg->access_time); ?>
                                  </td>
                                  <td style="text-align:center"><?php echo $tg->keterangan; ?></td>
                                  <!-- <td style="text-align:center">
                        <a href="<?= base_url() ?>admin/edit_position/<?= $tg->id_position ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td> -->
                                </tr>
                            <?php }
                            } ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <!-- /.nav-tabs-custom -->

          </section>

          <!-- <section class="col-lg-12 connectedSortable">
            <div class="nav-tabs-custom">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Pintu Office 1 Access by Dept <?= $note; ?></h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div id="canvas-holder">
                        <div class="row">
                          <div style="width: 100%; height: 100%">
                            <canvas id="chart-area-office"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="box-body table-responsive">
                        <table id="t3" class="table table-bordered table-striped" class="t3">
                          <thead>
                            <tr>
                              <th style="text-align:center">No</th>
                              <th style="text-align:center">Nama</th>
                              <th style="text-align:center">Department</th>
                              <th style="text-align:center">Time</th>
                              <th style="text-align:center">Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (empty($dataOffice)) { ?>

                              <tr>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                              </tr>
                              <?php } else {
                              $no = 0;
                              foreach ($dataOffice as $tg) {
                                $no++; ?>
                                <tr>
                                  <td style="text-align:center"><?php echo $no; ?></td>
                                  <td style="text-align:center"><?php echo $tg->nama_karyawan; ?></td>
                                  <td style="text-align:center"><?php echo $tg->nama_department; ?></td>
                                  <td style="text-align:center">
                                    <?php echo Date("d M y", $tg->access_time); ?><br>
                                    <?php echo Date("H:i:s", $tg->access_time); ?>
                                  </td>
                                  <td style="text-align:center"><?php echo $tg->keterangan; ?></td>
                                </tr>
                            <?php }
                            } ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </section> -->
          <!-- /.Left col -->
          <!-- right col -->

        </div>
        <!-- /.row (main row) -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php
    $this->load->view('admin/contain/footer.php');
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

  <script>
    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };

    var config = {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [
            <?php
            for ($i = 0; $i < $y; $i++) {
              echo $datax[$iddepcursor[$i]] . ",";
            };
            ?>
          ],
          backgroundColor: [
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.yellow,
            window.chartColors.green,
            window.chartColors.blue,
            window.chartColors.purple,
            window.chartColors.grey,
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.yellow,
            window.chartColors.green,
            window.chartColors.blue,
            window.chartColors.purple,
            window.chartColors.grey,
          ],
          label: 'Dataset 1'
        }],
        labels: [
          <?php
          if (isset($department)) {
            foreach ($department as $key => $value) {
              echo "'" . $value->nama_department . "',";
            }
          };
          ?>
        ]
      },
      options: {
        responsive: true
      }
    };

    window.onload = function() {
      var ctx = document.getElementById('chart-area').getContext('2d');
      window.myPie = new Chart(ctx, config);
    };


    var ctx_2 = document.getElementById("chart-area-tunggu").getContext('2d');
    var data_2 = {
      datasets: [{
        data: [
          <?php
          for ($i = 0; $i < $tunggu; $i++) {
            echo $dataTunggu[$idDepTunggu[$i]] . ",";
          };
          ?>
        ],
        backgroundColor: [
          '#5800FF',
          '#f56954',
          '#3498db',
          '#E900FF',
          '#041562',
          '#FFAD60',
        ],
      }],
      labels: [
        <?php
        if (isset($department)) {
          foreach ($department as $key => $value) {
            echo "'" . $value->nama_department . "',";
          }
        };
        ?>
      ]
    };

    var myDoughnutChart_2 = new Chart(ctx_2, {
      type: 'doughnut',
      data: data_2,
      options: {
        responsive: true,
      }
    });

    var ctx_3 = document.getElementById("chart-area-prodwork").getContext('2d');
    var data_3 = {
      datasets: [{
        data: [
          <?php
          for ($i = 0; $i < $production; $i++) {
            echo $dataProduction[$idDepProduction[$i]] . ",";
          };
          ?>
        ],
        backgroundColor: [
          '#3498db',
          '#041562',
          '#5800FF',
          '#FFAD60',
          '#E900FF',
          '#f56954',
        ],
      }],
      labels: [
        <?php
        if (isset($department)) {
          foreach ($department as $key => $value) {
            echo "'" . $value->nama_department . "',";
          }
        };
        ?>
      ]
    };

    var myDoughnutChart_3 = new Chart(ctx_3, {
      type: 'doughnut',
      data: data_3,
      options: {
        responsive: true,
      }
    });

    var ctx_4 = document.getElementById("chart-area-prodwork").getContext('2d');
    var data_4 = {
      datasets: [{
        data: [
          <?php
          for ($i = 0; $i < $office; $i++) {
            echo $dataOffice[$idDepOffice[$i]] . ",";
          };
          ?>
        ],
        backgroundColor: [
          '#f56954',
          '#E900FF',
          '#5800FF',
          '#FFAD60',
          '#3498db',
          '#041562',
        ],
      }],
      labels: [
        <?php
        if (isset($department)) {
          foreach ($department as $key => $value) {
            echo "'" . $value->nama_department . "',";
          }
        };
        ?>
      ]
    };

    var myDoughnutChart_4 = new Chart(ctx_4, {
      type: 'doughnut',
      data: data_4,
      options: {
        responsive: true,
      }
    });
  </script>



  <!-- page script -->
  <script>
    $(function() {
      $(".table").DataTable({
        "lengthMenu": [3, 10, 50, 100],
        "pageLength": 3
      });
    });

    $(function() {
      //Date range picker
      $('#reservation').daterangepicker()

    });
  </script>
</body>

</html>