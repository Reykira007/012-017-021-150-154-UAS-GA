<?php
session_start();
require_once("koneksi.php");
if (isset($_SESSION['username'])) {
	$sql_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username ='$_SESSION[username]'");
	$result_user = mysqli_fetch_array($sql_user);
	$_SESSION['hakuser'] = $result_user['level'];
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pelaporan Kebakaran</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/datepicker3.css" rel="stylesheet">
		<link href="assets/css/styles.css" rel="stylesheet">

		<!--Custom Font-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	</head>

	<body>
		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="#"><span>DAMKAR</span> BANGKA BELITUNG</a>
					<ul class="nav navbar-top-links navbar-right">
						<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<em class="fa fa-envelope"></em><span class="label label-danger">15</span>
							</a>
							<ul class="dropdown-menu dropdown-messages">
								<li>
									<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
										</a>
										<div class="message-body"><small class="pull-right">3 mins ago</small>
											<a href="#"><strong>Nadia Asdayanti</strong> commented on <strong>your photo</strong>.</a>
											<br /><small class="text-muted">1:24 pm - 25/03/2021</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
										</a>
										<div class="message-body"><small class="pull-right">1 hour ago</small>
											<a href="#">New message from <strong>Tri Firda Dewi</strong>.</a>
											<br /><small class="text-muted">12:27 pm - 25/03/2022</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="all-button"><a href="#">
											<em class="fa fa-inbox"></em> <strong>All Messages</strong>
										</a></div>
								</li>
							</ul>
						</li>
						<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<em class="fa fa-bell"></em><span class="label label-info">5</span>
							</a>
							<ul class="dropdown-menu dropdown-alerts">
								<li><a href="#">
										<div><em class="fa fa-envelope"></em> 1 New Message
											<span class="pull-right text-muted small">3 mins ago</span>
										</div>
									</a></li>
								<li class="divider"></li>
								<li><a href="#">
										<div><em class="fa fa-heart"></em> 12 New Likes
											<span class="pull-right text-muted small">4 mins ago</span>
										</div>
									</a></li>
								<li class="divider"></li>
								<li><a href="#">
										<div><em class="fa fa-user"></em> 5 New Followers
											<span class="pull-right text-muted small">4 mins ago</span>
										</div>
									</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
				<div class="profile-userpic">
					<img src="assets/images/profil.jpg" alt="">
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name"><?php echo $_SESSION['username']; ?></div>
					<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>
			<form role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
			</form>
			<ul class="nav menu">
				<li class="active"><a href="index.php"><em class="fa fa-fw fa-dashboard">&nbsp;</em> Dashboard</a></li>
				<li><a href="tambah_laporan.php"><em class="fa fa-fw fa-plus">&nbsp;</em> Tambah Lokasi Kebakaran</a></li>
				<li><a href="maps.php"><em class="fa fa-fw fa-map">&nbsp;</em> Maps Lokasi Kebakaran</a></li>
				<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
			</ul>
		</div>
		<!--/.sidebar-->

		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#">
							<em class="fa fa-home"></em>
						</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</div>
			<!--/.row-->

			<div class="col-lg-12">
				<h1 class="font-weight-bold" align="center">Daftar Pelaporan Kebakaran</h1>
				<a href="tambah_laporan.php" class="btn btn-primary">Tambah Pelaporan</a>
				<a href="" class="btn btn-warning">Refresh</a><br><br>
				<table class="table">
					<tr class="text-danger">
						<th>No</th>
						<th>Nama</th>
						<th>ID</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Tanggal Kejadian</th>
						<th>Foto Bukti</th>
						<th>Sudah Verifikasi?</th>
						<th></th>
						<th>Action</th>
						<th></th>
						<th></th>
					</tr>
					<?php
					require 'koneksi.php';

					$sql = mysqli_query($koneksi, "SELECT * FROM studio");
					$no = 1;

					$data = array();
					if ($sql) {
						while ($result = mysqli_fetch_array($sql)) { ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $result['nama']; ?></td>
								<td><?php echo $result['id']; ?></td>
								<td><?php echo $result['latitude']; ?></td>
								<td><?php echo $result['longitude']; ?></td>
								<td><?php echo $result['tgl_kejadian']; ?></td>
								<td><a target="_blank" href="../upload/<?php echo $result['img']; ?>"><img width="200px" height="180px" src="../upload/<?php echo $result['img']; ?>"></a></td>
								<td><?php
									if ($result['verifikasi'] == 'y') {
										echo "<b>Ya</b>";
									} else {
										echo "Belum";
									} ?>
								</td>
								<form action="action.php?id=<?php echo $result['id']; ?>" method="post">
									<td><input name="verifikasi" class="btn btn-primary" type="submit" value="Verifikasi" onclick="if (!confirm('Konfirmasi Verifikasi?')) { return false; }"></td>
									<td><input name=" ubah" class="btn btn-warning" type="submit" value="Ubah"></td>
									<td><input name="hapus" class="btn btn-danger" type="submit" value="Hapus" onclick="if (!confirm('Konfirmasi Hapus Laporan?')) { return false; }"></td>
								</form>
							</tr>
					<?php
							$no++;
						}
					}

					?>
				</table>
			</div>
			<!-- Footer -->
			<div class="col-sm-12">
				<p class="back-link">Copyright &copy; <?= date('Y') ?> UAS GIS. <br>Ari Januari, Dimas Pratama, Nadia Asdayanti, Tri Firda Dewi, Yori Wiartama</a></p>
			</div>
		</div>
		<!--/.main-->

		<script src="assets/js/jquery-1.11.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/chart.min.js"></script>
		<script src="assets/js/chart-data.js"></script>
		<script src="assets/js/easypiechart.js"></script>
		<script src="assets/js/easypiechart-data.js"></script>
		<script src="assets/js/bootstrap-datepicker.js"></script>
		<script src="assets/js/custom.js"></script>
		<script>
			window.onload = function() {
				var chart1 = document.getElementById("line-chart").getContext("2d");
				window.myLine = new Chart(chart1).Line(lineChartData, {
					responsive: true,
					scaleLineColor: "rgba(0,0,0,.2)",
					scaleGridLineColor: "rgba(0,0,0,.05)",
					scaleFontColor: "#c5c7cc"
				});
			};
		</script>

	</body>

	</html>
<?php
} else {
	echo "<meta http-equiv='refresh' content='0 url=login.php'>";
}
?>