<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Door Lock Access - Daftar Karyawan</title>
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
                    Daftar Karyawan Department <?= $this->db->get_where('department', ['id_department' => $this->db->get_where('room', ['id_room' => $this->uri->segment(3)])->row()->id_department])->row()->nama_department ?>
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url(); ?>admin/list_room"><i class="fa fa-home"></i> List Room</a></li>
                    <li class="active">Daftar Karyawan</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <?= $this->session->flashdata('pesan') ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <a href="<?= base_url('admin/export-karyawan/' . $this->uri->segment(3)) ?>" class="btn btn-sm btn-primary" style="margin-bottom: 20px;">Export</a>
                                <div class="table-responsive">
                                    <table id="t1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Nik</th>
                                                <th>Department</th>
                                                <th>Section</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($karyawan as $kary) :
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $this->db->get_where('karyawan', ['id_karyawan' => $kary->id_karyawan])->row()->nama_karyawan ?></td>
                                                    <td><?= $this->db->get_where('karyawan', ['id_karyawan' => $kary->id_karyawan])->row()->nik ?></td>
                                                    <td><?= $this->db->get_where('department', ['id_department' => $this->db->get_where('department_section', ['id_section' => $this->db->get_where('karyawan', ['id_karyawan' => $kary->id_karyawan])->row()->id_section])->row()->id_department])->row()->nama_department  ?></td>
                                                    <td><?= $this->db->get_where('department_section', ['id_section' => $this->db->get_where('karyawan', ['id_karyawan' => $kary->id_karyawan])->row()->id_section])->row()->nama_section ?></td>
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