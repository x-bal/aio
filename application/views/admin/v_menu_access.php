<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Door Lock Access - Notif Telegram</title>
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

        <?php
        $this->load->view('admin/contain/header.php');



        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $page ?>
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url(); ?>admin/notif"><i class="fa fa-users"></i> Karyawan</a></li>
                    <li class="active"><?= $page ?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                <?= $page ?>
                            </div>

                            <div class="box-body">
                                <form action="<?= $action ?>" method="post">
                                    <input type="hidden" name="role" value="<?= $this->input->get('role') ?>">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="checkbox" name="control_room" id="control_room" <?= $user->control_room == 1 ? 'checked' : '' ?> value="<?= $user->control_room ?? 0 ?>">
                                                <label for="control_room">Control Room</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="checkbox" name="monitoring_room" id="monitoring_room" <?= $user->monitoring_room == 1 ? 'checked' : '' ?> value="<?= $user->monitoring_room ?? 0 ?>">
                                                <label for="monitoring_room">Monitoring Room</label>
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



        <?php
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $("#t1").DataTable();
        });

        $(document).ready(function() {
            $('#control_room').on('click', function() {
                if ($(this).is(':checked')) {
                    $(this).val(1)
                } else {
                    $(this).val(0)
                }
            })

            $('#monitoring_room').on('click', function() {
                if ($(this).is(':checked')) {
                    $(this).val(1)
                } else {
                    $(this).val(0)
                }
            })
        });
    </script>
</body>

</html>