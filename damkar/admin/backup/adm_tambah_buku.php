<?php
if (isset($_POST['submit_buku'])) {
	// code...
	$id_buku = $_POST['id_buku'];
	$judul = $_POST['judul'];
	$kategori = $_POST['kategori'];
	$pengarang = $_POST['pengarang'];
	$penerbit = $_POST['penerbit'];
	$status = $_POST['status'];
	if (empty($id_buku) || empty($judul)) {
		// code...
		echo '<div class="warning">Data tidak boleh kosong</div>';
	}else{
		$insert = mysqli_query($koneksi, "INSERT INTO buku(id_buku, judul, kategori, pengarang, penerbit, status) VALUES('$id_buku','$judul','$kategori','$pengarang','$penerbit','$status')");
		if ($insert) {
			// code...
			echo '</div class="success">Buku berhasil disimpan</div>';
		}else{
			echo '<div class="error">Buku gagal disimpan</div>';
		}
	}
}
?>
<div class="col-lg-12">
	<section class="panel">
		<h2 align="center">Halaman Tambah Buku</h2>
		<a href="index.php?page=buku"> << Kembali ke Buku management </a>
		<form method="post" action="">
			<input type="text" name="id_buku" placeholder="Id buku" maxlength="3" required="required" class="form-control"> <br>
			<input type="text" name="judul" placeholder="Judul buku" class="form-control"> <br>
			<input type="text" name="kategori" placeholder="Kategori buku" class="form-control"> <br>
			<input type="text" name="pengarang" placeholder="Pengarang buku" class="form-control"> <br>
			<input type="text" name="penerbit" placeholder="Penerbit buku" class="form-control"> <br>
			<select name="status" class="form-control">
				<option value="tersedia">Tersedia</option>
				<option value="dipinjam">Dipinjam</option>
			</select>
			<input type="submit" name="submit_buku" value="Tambah buku" class="submit">
		</form>
	</section>
</div>