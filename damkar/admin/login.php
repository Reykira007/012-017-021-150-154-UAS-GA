<?php
include "koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Login</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/datepicker3.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">

					<form method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="username" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button type="submit" name="login" value="login" class="btn btn-primary btn-block">LOGIN</button>
						</fieldset>
					</form>

				</div>
			</div>
		</div><!-- /.col-->
		<!-- Footer -->
		<div class="col-sm-12">
			<p class="back-link">Copyright &copy; <?= date('Y') ?> UAS GIS. <br>Ari Januari, Dimas Pratama, Nadia Asdayanti, Tri Firda Dewi, Yori Wiartama</a></p>
		</div>
	</div><!-- /.row -->


	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
<?php
if (isset($_POST['login']) == 'LOGIN') {
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	if (empty($username) || empty($password)) {
		echo "<script>alert('Username / Password Tidak Boleh Kosong')</script>";
		echo "<meta http-equiv='refresh' content='0 url = login.php'>";
	} else {
		$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' and password='$password'");
		$result = mysqli_fetch_array($sql);
		if ($result[1]) {
			$_SESSION['level'] = 'admin';
			$_SESSION['username'] = $username;
			echo "<div class='alert alert-success alert-dismissible'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
							<h5><i class='icon fas fa-check'></i> Alert!</h5>
							LOGIN SUKSES
							</div>";
			echo "<meta http-equiv='refresh' content='0 url=index.php'>";
		} else {
			echo "<div class='alert alert-danger alert-dismissible'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
				<h5><i class='icon fas fa-ban'></i> Alert!</h5>
				LOGIN GAGAL
				</div>";
		}
	}
}
?>