<?php
if (isset($_POST['edit_buku'])) {
	// code...
	$id_buku	= $_POST['id_buku'];
	$id_buku	= $_POST['judul'];
	$id_buku	= $_POST['kategori'];
	$id_buku	= $_POST['pengarang'];
	$id_buku	= $_POST['penerbit'];
	$id_buku	= $_POST['status'];
	if (empty($id_buku) || empty($judul) || empty($kategori) || empty($pengarang) || empty($penerbit)) {
		// code...
		echo "<div class='warning'>Data tidak boleh kosong</div>";
	}else{
		$edit = mysqli_query($koneksi, "UPDATE buku SET judul='$judul', kategori='$kategori', pengarang='$pengarang', penerbit='$penerbit', status='$status' WHERE id_buku='$id_buku'");
		if ($edit) {
			// code...
			echo '<div class="success">buku berhasil diedit</div>';
		}else{
			echo '<div class="error">buku gagal diedit</div>';
		}
	}
}
$id_buku = $_GET['id'];
$sql = mysqli_query($koneksi,"SELECT * FROM buku WHERE id_buku = '$id_buku'");
$result = mysqli_fetch_array($sql);
?>
<div class="col-lg-6">
	<form method="post" action="">
	<fieldset style="border: 1px solid orange;">
		<legend>Edit buku</legend>
		<input type="hidden" name="id_buku" class="form-control" value="<?php echo $result['id_buku'];?>">
		<label> Judul buku</label>
		<input type="text" name="judul" placeholder="Judul Buku" class="form-control" value="<?php echo $result['judul'];?>"><br>
		<label> Kategori</label>
		<input type="text" name="kategori" placeholder="Kategori" class="form-control" value="<?php echo $result['kategori'];?>"><br>
		<label> Pengarang</label>
		<input type="text" name="pengarang" placeholder="Pengarang" class="form-control" value="<?php echo $result['pengarang'];?>">
		<br><label> Penerbit</label>
		<input type="text" name="penerbit" placeholder="Penerbit" class="form-control" value="<?php echo $result['penerbit'];?>"><br>
		<label> Status</label>
		<select name="status" class="form-control">
			<option value="tersedia">Tersedia</option>
			<option value="dipinjam">Dipinjam</option>
		</select><br><br>
		<input type="submit" name="edit_buku" value="Edit buku" class="submit">
	</fieldset>
	</form>
</div>