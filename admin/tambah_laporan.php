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
				<li><a href="index.php"><em class="fa fa-fw fa-dashboard">&nbsp;</em> Dashboard</a></li>
				<li class="active"><a href="tambah_laporan.php"><em class="fa fa-fw fa-plus">&nbsp;</em> Tambah Lokasi Kebakaran</a></li>
				<li><a href="maps.php"><em class="fa fa-fw fa-map">&nbsp;</em> Maps Lokasi Kebakaran</a></li>
				<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
			</ul>
		</div>
		<!--/.sidebar-->

		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="index.php">
							<em class="fa fa-home"></em>
						</a></li>
					<li class="active">Tambah Lokasi Kebakaran</li>
				</ol>
			</div>
			<!--/.row-->

			<!-- content -->
			<div class="page-header">
				<h1 align="center">Tambah Data Laporan Kebakaran</h1>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<?php if ($_POST) include 'action.php' ?>
					<form method="post" action="action.php" Enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Tempat <span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="nama" id="nama" required />
						</div>
						<div class="form-group">
							<label>Latitude <span class="text-danger">*</span></label>
							<input class="form-control" type="text" id="lat" name="latitude" required />
						</div>
						<div class="form-group">
							<label>Longitude <span class="text-danger">*</span></label>
							<input class="form-control" type="text" id="lng" name="longitude" required />
						</div>
						<div class="form-group">
							<label>Tanggal Kejadian <span class="text-danger">*</span></label>
							<input class="form-control" type="date" id="date" name="tgl_kejadian" required />
						</div>
						<div class="form-group">
							<label>Bukti Gambar <span class="text-danger">*</span></label>
							<input class="form-control" type="file" name="gambar" id="gambar" />
						</div>
						<div class="form-group">
							<input type="submit" onclick="if (!confirm('Konfirmasi Tambah Laporan?')) { return false; }" name="tambah_laporan" class="btn btn-primary" value="Tambah Laporan">
							<input type="reset" id="btnCancel" name="reset" class="btn btn-warning" value="Reset">
							<a class="btn btn-danger" href="index.php">Kembali</a>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<div id="googleMap" style="height: 400px;"></div>
				</div>
			</div>

			<script>
				var defaultCenter = {
					lat: -2.2897803577478166,
					lng: 106.07227501054686
				};

				function initMap() {

					var map = new google.maps.Map(document.getElementById('googleMap'), {
						zoom: 10,
						center: defaultCenter
					});

					var marker = new google.maps.Marker({
						position: defaultCenter,
						map: map,
						title: 'Click to zoom',
						draggable: true
					});


					marker.addListener('drag', handleEvent);
					marker.addListener('dragend', handleEvent);

					var infowindow = new google.maps.InfoWindow({
						content: '<h4>Drag untuk pindah lokasi</h4>'
					});

					infowindow.open(map, marker);
				}

				function handleEvent(event) {
					document.getElementById('lat').value = event.latLng.lat();
					document.getElementById('lng').value = event.latLng.lng();
				}

				$(function() {
					initMap();
				})
			</script>
			<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDtZd08p2_hIAB8Dx2cuH0Y1dohcGXfu4I&callback=initMap">
			</script>

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
			<!-- Footer -->
			<div class="col-sm-12">
				<p class="back-link">Copyright &copy; <?= date('Y') ?> UAS GIS. <br>Ari Januari, Dimas Pratama, Nadia Asdayanti, Tri Firda Dewi, Yori Wiartama</a></p>
			</div>
	</body>

	</html>
<?php
} else {
	echo "<meta http-equiv='refresh' content='0 url=login.php'>";
}
?>