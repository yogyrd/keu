<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title><?= $title; ?></title>
	<link href="<?= base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="logo-kiri">
					<img src="<?= base_url(); ?>/assets/images/logo%20mmc%20transparan.png" class="img-responsive">
				</div>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<div class="logo-kanan">
					<img src="<?= base_url(); ?>/assets/images/Logo%20cahaya%20medika.jpg" class="img-responsive">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4  col-md-offset-4">
				<div class="logo-tengah">
					<img src="<?= base_url(); ?>/assets/images/logo%20cdc%20transparan.png" class="img-responsive">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="login col-md-offset-4 col-md-4 panel panel-default">
				<h4><em class="glyphicon glyphicon-log-in"></em> Halaman Login </h4>
				<form action="<?= base_url('login'); ?>" method="post">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					</div>
					<?php if($this->session->flashdata('warning')!="") { ?>
						<div class="alert alert-danger alert-dismissible" role="alert" align="center">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h5><?= $this->session->flashdata('warning');?></h5>
						</div>
					<?php } ?>
					<div class="text-right">
						<input type="submit" class="btn btn-primary" name="submit" id="submit" value="Login">
					</div>
				</form>
			</div>
		</div>

	</div>
</body>
</html>