<?php
?>
<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>IO</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>AIO</b> System Lock</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= base_url(); ?>component/dist/img/karyawan/<?= $avatar; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs">
              <?php if (isset($namauser)) {
                echo $namauser;
              } ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?= base_url(); ?>component/dist/img/karyawan/<?= $avatar; ?>" class="img-circle" alt="User Image">

              <p>
                <?php if (isset($namauser)) {
                  echo $namauser;
                } ?>
                <small>
                  <?php
                  if (isset($nama_department)) {
                    echo $nama_department;
                    echo "<br>";
                    if (isset($nama_section)) {
                      echo $nama_section;
                    }
                  } ?>
                </small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?= base_url(); ?>karyawan/setting" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?= base_url(); ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url(); ?>component/dist/img/karyawan/<?= $avatar; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php if (isset($namauser)) echo $namauser; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <?php
      if ($nama_position == "M1" || $nama_position == "M2" || $nama_position == "M3") {
      ?>
        <li <?php if ($this->uri->segment(2) == "dashboard") echo 'class="active"'; ?>>
          <a href="<?= base_url(); ?>karyawan/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
      <?php
      }
      ?>

      <?php if ($this->session->userdata('id_karyawan')) : ?>
        <?php
        $karyawan = $this->db->get_where('karyawan', ['id_karyawan' => $this->session->userdata('id_karyawan')])->row();

        if ($karyawan->control_room == 1) {
        ?>
          <li <?php if ($this->uri->segment(2) == "control") {
                echo 'class="active"';
              } ?>>
            <a href="<?= base_url(); ?>karyawan/control?page=1"><i class="fa fa-keyboard-o"></i> Control Room</a>
          </li>
        <?php } ?>

        <?php if ($karyawan->monitoring_room == 1) : ?>
          <li <?php if ($this->uri->segment(2) == "monitoring") {
                echo 'class="active"';
              } ?>>
            <a href="<?= base_url(); ?>karyawan/monitoring"><i class="fa fa-window-restore"></i> Monitoring Room</a>
          </li>
        <?php endif; ?>
      <?php endif; ?>
      <li <?php if ($this->uri->segment(2) == "log") {
            echo 'class="active"';
          } ?>>
        <a href="<?= base_url(); ?>karyawan/log"><i class="fa fa-book"></i> Log Aktivitas</a>
      </li>
      <li <?php if ($this->uri->segment(2) == "remarksroom") {
            echo 'class="active"';
          } ?>>
        <a href="<?= base_url(); ?>karyawan/remarksroom"><i class="fa fa-building-o"></i> Remarks Room</a>
      </li>
      <li <?php if ($this->uri->segment(2) == "setting") {
            echo 'class="active"';
          } ?>>
        <a href="<?= base_url(); ?>karyawan/setting"><i class="fa fa-cog"></i> Setting</a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>