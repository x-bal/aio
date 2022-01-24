<?php
if (isset($mode)) {
	if ($mode == "karyawan") {
?>
		<!DOCTYPE html>
		<html>
		<head>
		  <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <title>Login Pegawai</title>
		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		  <link rel="shortcut icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">
		  <link rel="icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">

		  <!-- Bootstrap 3.3.7 -->
		  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/bootstrap/dist/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/font-awesome/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/Ionicons/css/ionicons.min.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="<?=base_url();?>component/dist/css/AdminLTE.min.css">
		  <!-- iCheck -->
		  <link rel="stylesheet" href="<?=base_url();?>component/plugins/iCheck/square/green.css">

		</head>
		<body class="hold-transition login-page" style="background-image:url('<?=base_url();?>component/dist/img/bg-aio2.jpeg');background-size: cover;">
		<div class="login-box">
		  <div class="login-logo" style="margin-bottom:50%">
		    <!-- <a href="#" style="color:#00a65a">Login <b>Pegawai</b></a> -->
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">
		    <p class="login-box-msg" style="color:#00a65a;font-size:24px">Login <b>Pegawai</b></p>

		    <?php echo $this->session->flashdata('pesan')?>

		    <form action="<?=base_url();?>login/karyawan_check" method="post">
		      <div class="form-group has-feedback">
		        <input type="text" class="form-control" placeholder="NIK" name="nik">
		        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <input type="password" class="form-control" placeholder="Password" name="password">
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row">
		        <div class="col-xs-8">
		          <div class="checkbox icheck">
		            <label>
		              <input type="checkbox"> Remember Me
		            </label>
		          </div>
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">
		          <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
		        </div>
		        <!-- /.col -->
		      </div>
		    </form>
		    <a href="<?=base_url();?>karyawan/register" style="color:#00a65a;">Daftar Akun Baru</a>
		    <br>
		    <a href="<?=base_url();?>login/admin" style="color:#00a65a;">Login Admin</a>

		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 3 -->
		<script src="<?=base_url();?>component/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?=base_url();?>component/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?=base_url();?>component/plugins/iCheck/icheck.min.js"></script>
		<script>
		  $(function () {
		    $('input').iCheck({
		      checkboxClass: 'icheckbox_square-green',
		      radioClass: 'iradio_square-green',
		      increaseArea: '20%' /* optional */
		    });
		  });
		</script>
		</body>
		</html>
<?php
	}else if($mode == "admin"){
?>
		<!DOCTYPE html>
		<html>
		<head>
		  <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <title>Login Admin</title>
		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		  <link rel="shortcut icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">
		  <link rel="icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">

		  <!-- Bootstrap 3.3.7 -->
		  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/bootstrap/dist/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/font-awesome/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="<?=base_url();?>component/bower_components/Ionicons/css/ionicons.min.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="<?=base_url();?>component/dist/css/AdminLTE.min.css">
		  <!-- iCheck -->
		  <link rel="stylesheet" href="<?=base_url();?>component/plugins/iCheck/square/blue.css">

		</head>
		<body class="hold-transition login-page" style="background-image:url('<?=base_url();?>component/dist/img/background-aio.jpeg');background-size: cover;">
		<div class="login-box">
		  <div class="login-logo" style="margin-bottom:50%">
		    <!-- <a href="#" style="color:#004d9f">Login <b>Admin</b></a> -->
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">
		    <p class="login-box-msg" style="color:#337ab7;font-size:24px">Login <b>Admin</b></p>

		    <?php echo $this->session->flashdata('pesan')?>

		    <form action="<?=base_url();?>login/admin_check" method="post">
		      <div class="form-group has-feedback">
		        <input type="text" class="form-control" placeholder="Username" name="username">
		        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <input type="password" class="form-control" placeholder="Password" name="password">
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row">
		        <div class="col-xs-8">
		          <div class="checkbox icheck">
		            <label>
		              <input type="checkbox"> Remember Me
		            </label>
		          </div>
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">
		          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
		        </div>
		        <!-- /.col -->
		      </div>
		    </form>

		    <a href="<?=base_url();?>login">Login Pegawai</a>

		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 3 -->
		<script src="<?=base_url();?>component/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?=base_url();?>component/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?=base_url();?>component/plugins/iCheck/icheck.min.js"></script>
		<script>
		  $(function () {
		    $('input').iCheck({
		      checkboxClass: 'icheckbox_square-blue',
		      radioClass: 'iradio_square-blue',
		      increaseArea: '20%' /* optional */
		    });
		  });
		</script>
		</body>
		</html>
<?php
	}
}
?>