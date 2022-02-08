<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Door Lock Access - Notif Door Open</title>
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

        <?php $this->load->view('admin/contain/header.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Create Notif Door Open
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url(); ?>admin/notif"><i class="fa fa-exclamation"></i> Notif Telegram</a></li>
                    <li class="active">Create Notif</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                Tambah Notif Door Open
                            </div>

                            <div class="box-body">
                                <form action="<?= base_url('admin/notif-door/store') ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="room">Room</label>
                                                <select name="room" id="room" class="form-control">
                                                    <option disabled selected>-- Select Room --</option>
                                                    <?php foreach ($rooms as $room) : ?>
                                                        <option value="<?= $room->id_room ?>"><?= $room->nama_room ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="karyawan">Karyawan</label>
                                                <select name="karyawan" id="karyawan" class="form-control karyawan">
                                                    <option disabled selected>-- Select Room --</option>
                                                    <?php foreach ($karyawan as $kry) : ?>
                                                        <option value="<?= $kry->id_karyawan ?>"><?= $kry->nama_karyawan ?> - <?= $kry->nik ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="idchat">Id Chat</label>
                                                <input type="text" name="idchat" id="idchat" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="waktu">Waktu</label>
                                                <input type="number" name="waktu" id="waktu" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <?php $this->load->view('admin/contain/footer.php'); ?>

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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $("#t1").DataTable();
        });

        $(document).ready(function() {
            $('.karyawan').select2();
        });
    </script>
</body>

</html>