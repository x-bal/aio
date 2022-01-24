<?php
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AIO</b></span>
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
              <img src="<?=base_url();?>component/dist/img/admin/<?=$avatar;?>" class="user-image" alt="User Image">
              <span class="hidden-xs">
              	<?php if (isset($namauser)) {
                  	echo $namauser;
                  }?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url();?>component/dist/img/admin/<?=$avatar;?>" class="img-circle" alt="User Image">

                <p>
                  <?php if (isset($namauser)) {
                  	echo $namauser;
                  }?>
                  <small>
                  	<?php if (isset($role)) {
                  		if ($role == 1) {
                  			echo "Super Admin";
                  		}
                  		if ($role ==2) {
                  			echo "Admin<br>Department ";
                  			echo $this->session->userdata('nama_department');;
                  		}
                  	} ?>
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url();?>admin/setting" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url();?>login/logout" class="btn btn-default btn-flat">Sign out</a>
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
          <img src="<?=base_url();?>component/dist/img/admin/<?=$avatar;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if (isset($namauser)) echo $namauser; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if($this->uri->segment(2)=="dashboard") echo 'class="active"';?>>
          <a href="<?=base_url();?>admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
<?php 
if (isset($role)) {
	if ($role == 1) {
?>
        <li <?php if($this->uri->segment(2)=="control") echo 'class="active"';?>>
          <a href="<?=base_url();?>admin/control?page=1">
            <i class="fa fa-keyboard-o"></i> <span>Control Room</span>
          </a>
        </li>
        <li <?php if($this->uri->segment(2)=="monitoring") echo 'class="active"';?>>
          <a href="<?=base_url();?>admin/monitoring">
            <i class="fa fa-window-restore"></i> <span>Monitoring Room</span>
          </a>
        </li>
        <li <?php if($this->uri->segment(2)=="department") echo 'class="active"';?>>
          <a href="<?=base_url();?>admin/department">
            <i class="fa fa-building"></i> <span>Department</span>
          </a>
        </li>
        <li <?php if($this->uri->segment(2)=="position"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/position"><i class="fa fa-bookmark"></i> Position</a>
        </li>
        <li <?php if($this->uri->segment(2)=="list_admin"){echo 'class="active"';}?>>
        	<a href="<?=base_url();?>admin/list_admin"><i class="fa fa-user"></i> Daftar Admin</a>
        </li>
        <li <?php if($this->uri->segment(2)=="list_karyawan"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/list_karyawan"><i class="fa fa-users"></i> Daftar Karyawan</a>
        </li>
        <li <?php if($this->uri->segment(2)=="list_room"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/list_room"><i class="fa fa-home"></i> Room</a>
        </li>
        <li <?php if($this->uri->segment(2)=="free_access_room"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/free_access_room"><i class="fa fa-exchange"></i> Free Access Room</a>
        </li>
        <!-- <li <?php if($this->uri->segment(2)=="list_device_rfid"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/list_device_rfid"><i class="fa fa-address-card"></i> Penambah RFID</a>
        </li> -->
        <li <?php if($this->uri->segment(2)=="log"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/log"><i class="fa fa-book"></i> Log Aktivitas</a>
        </li>
        <li <?php if($this->uri->segment(2)=="setting"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/setting"><i class="fa fa-cog"></i> Setting</a>
        </li>
<?php
	}else if ($role == 2) {
?>
        <li <?php if($this->uri->segment(2)=="list_karyawan"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/list_karyawan"><i class="fa fa-users"></i> Daftar Karyawan</a>
        </li>
        <li <?php if($this->uri->segment(2)=="list_room_dep"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/list_room_dep"><i class="fa fa-home"></i> Daftar Ruangan</a>
        </li>
        <li <?php if($this->uri->segment(2)=="setting"){echo 'class="active"';}?>>
          <a href="<?=base_url();?>admin/setting"><i class="fa fa-cog"></i> Setting</a>
        </li>
<?php  
  }
}
?>	
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>