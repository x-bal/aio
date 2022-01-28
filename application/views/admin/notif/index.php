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
                    Daftar Notif Room
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url(); ?>admin/notif"><i class="fa fa-home"></i> Notif Room</a></li>
                    <li class="active">Daftar Notif</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <?= $this->session->flashdata('pesan') ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form action="" class="select-room">
                                            <div class="form-group">
                                                <label for="room">Room</label>
                                                <select name="room" id="room" class="form-control">
                                                    <option value="all">All</option>
                                                    <?php foreach ($rooms as $room) : ?>
                                                        <option <?= $this->input->get('room') == $room->id_room ? 'selected' : '' ?> value="<?= $room->id_room ?>"><?= $room->nama_room ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>

                                    <?php if ($this->input->get('room') != 'all') : ?>
                                        <?php if (isset($enable)) : ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="enable">Status Enable</label><br>
                                                    <form action="<?= base_url('admin/notif/enable') ?>" method="post">
                                                        <input type="hidden" name="room" value="<?= $enable->id_room ?>">
                                                        <input type="hidden" name="enable" value="<?= $enable->enable ?>">

                                                        <button type="submit" class="btn btn-sm btn-<?= $enable->enable == 1 ? 'success' : 'danger' ?>" onclick="return confirm('<?= $enable->enable == 1 ? 'Disable Notif Room ?' : 'Enable Notif Room ?' ?>')"><?= $enable->enable == 1 ? 'Enable' : 'Disable' ?></button>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="box-body">
                                <a href="<?= base_url('admin/notif/create') ?>" class="btn btn-sm btn-primary" style="margin-bottom: 20px;">Tambah</a>
                                <div class="table-responsive">
                                    <table id="t1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Room</th>
                                                <th>Karyawan</th>
                                                <th>Id Chat</th>
                                                <th>Status Enable</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($notifs as $notif) :
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $notif->nama_room ?></td>
                                                    <td><?= $notif->nama_karyawan ?></td>
                                                    <td><?= $notif->id_chat ?></td>
                                                    <td>
                                                        <span class="text-<?= $notif->enable == 1 ? '' : 'danger' ?>"><?= $notif->enable == 1 ? 'Enable' : 'Disable' ?></span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/notif/edit/' . $notif->id_telegram) ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                                                        <a href="<?= base_url('admin/notif/delete/' . $notif->id_telegram) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data berikut ?')"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <script>
        $(function() {
            $("#t1").DataTable();
        });

        $("#room").on('change', function() {
            $('.select-room').submit()

        })
    </script>
</body>

</html>