<div class="col-lg-12"><h3>Data Buku</h3></div>
<?php
	if (isset($_GET['action'])) {
		// code...
		if ($_GET['action'] =="hapus") {
			// code...
			$id = $_GET['id'];
			$sql = mysqli_query($koneksi,"DELETE FROM buku WHERE id_buku = '$id'");
			if ($sql) {
				// code...
				echo 'Buku berhasil dihapus';
			}else{
				echo 'Buku gagal dihapus';
			}
		}
	}
?>
<div class="col-lg-12">
	<section class="panel">
		<a href="index.php?page=adm_tambah_buku" class="btn btn-success">TAMBAH</a>
		<table class="table">
			<tr>
				<th>No</th>
				<th>Judul</th>
				<th>Kategori</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
				<th>Action</th>
			</tr>
			<?php
			$sql = mysqli_query($koneksi, "SELECT * FROM buku");
			$no=1;
			if ($sql) {
				// code...
				while($result=mysqli_fetch_array($sql)){
					?>
					<tr>
						<td><?php echo $no ?></td>
						<td><?php echo $result['judul'];?></td>
						<td><?php echo $result['kategori'];?></td>
						<td><?php echo $result['pengarang'];?></td>
						<td><?php echo $result['penerbit'];?></td>
						<td>
							<a href="index.php?page=adm_edit_buku&id=<?php echo $result['id_buku']; ?>" class="btn btn-warning">EDIT</a>
							<a href="index.php?page=buku&action=hapus&id=<?php echo $result['id_buku']; ?>" class="btn btn-danger">HAPUS</a>
						</td>
					</tr>
					<?php
					$no++;
				}
			}
			?>
		</table>
	</section>
</div>