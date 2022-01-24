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
    $this->load->View('admin/contain/header.php');

    if ($set == "setting") {
      $skey = "";
    ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Setting
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>admin/setting"><i class="fa fa-gear"></i> Setting</a></li>
            <!-- <li class="active">Lihat Histori Device</li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <?php echo $this->session->flashdata('pesan'); ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="padding-bottom:50px;">
                  <form action="<?= base_url(); ?>admin/set_room_dashboard" method="post">
                    <h4><i class="icon fa fa-dashboard"></i> Pilih Room (Dashboard)</h4>
                    <select name="room_dash" class="form-control">
                      <?php
                      if (isset($room_dashboard)) {
                        foreach ($room_dashboard as $key => $value) {
                          if ($value->flag_dashboard == 1) {
                            echo "<option value='" . $value->id_room . "' selected>" . $value->nama_room . "</option>";
                          } else {
                            echo "<option value='" . $value->id_room . "'>" . $value->nama_room . "</option>";
                          }
                        }
                      }
                      ?>

                    </select>
                    <br>
                    <button type="submit" class="btn btn-danger">Set Room Dashboard</button>
                  </form>
                </div>

                <div class="box-body table-responsive">
                  <div class="callout callout-success">
                    <h4><i class="icon fa fa-warning"></i> SECRET KEY</h4>

                    <?php
                    if (isset($secretKey)) {
                      foreach ($secretKey as $keys => $value) {
                        $skey = $value->key;
                        echo "<i class='icon fa fa-lock'></i> <b>" . $skey . "</b>";
                      }
                    }
                    ?>
                  </div>
                  <!-- <div class="callout callout-warning">
                <h4><i class="icon fa fa-link"></i> URL MODE DEVICE</h4>

                <i class='icon fa fa-globe'></i> <b><?= base_url(); ?>api/getmode?key=<?= $skey; ?>&iddev=XXX</b><br>
                <i class='icon fa fa-globe'></i> <b><?= base_url(); ?>api/getmodejson?key=<?= $skey; ?>&iddev=XXX</b>
              </div>
              <div class="callout callout-info">
                <h4><i class="icon fa fa-link"></i> URL ADD RFID CARD</h4>

                <i class='icon fa fa-globe'></i> <b><?= base_url(); ?>api/addcard?key=<?= $skey; ?>&iddev=XXX&rfid=XXX</b><br>
                <i class='icon fa fa-globe'></i> <b><?= base_url(); ?>api/addcardjson?key=<?= $skey; ?>&iddev=XXX&rfid=XXX</b>
              </div>
              <div class="callout callout-danger">
                <h4><i class="icon fa fa-link"></i> URL ABSENSI</h4>

                <i class='icon fa fa-globe'></i> <b><?= base_url(); ?>api/absensi?key=<?= $skey; ?>&iddev=XXX&rfid=XXX</b><br>
                <i class='icon fa fa-globe'></i> <b><?= base_url(); ?>api/absensijson?key=<?= $skey; ?>&iddev=XXX&rfid=XXX</b>
              </div> -->

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
    <?php
    }

    $this->load->view('admin/contain/footer.php');
    ?>

  </div> <!-- penutup header -->

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