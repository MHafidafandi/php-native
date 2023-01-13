<?php 
session_start();

if (!isset($_SESSION['login'])) {
	header("Location:login.php");
}
require 'fungsi.php';

$id = $_GET["id"];

$siswa = query("SELECT * FROM siswasiswi WHERE id=$id")[0];
// cek tombol submit ditekan atau belum

if (isset($_POST['submit'])) {

	if ( ubah($_POST)>0) {
		echo "<script>
			alert('Data berhasil diubah!');
			document.location.href = 'index.php';
		</script>";
	}else {
		echo "<script>
			alert('Data gagal diubah!');
			document.location.href = 'index.php';
		</script>";
	}


}



 ?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ubah data siswa siswi</title>
</head>
<body>

<h1>Ubah Data Siswa Siswi</h1>
<form method="post" action="" enctype="multipart/form-data">
	<ul>
		<input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $siswa["gambar"]; ?>">
		<li>
			<label for="nisn">Nisn : </label>
			<input type="text" name="nisn" required 
			value="<?= $siswa["nisn"]; ?>">
		</li>
		<li>
			<label for="nama">Nama:</label>
			<input type="text" name="nama" id="nama" required
			value="<?= $siswa["nama"]; ?>"> 
		</li>
		<li>
			<label for="jurusan">Jurusan:</label>
			<input type="text" name="jurusan" id="jurusan" required
			value="<?= $siswa["jurusan"]; ?>"> 
		</li>
		<li>
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" required
			value="<?= $siswa["email"]; ?>"> 
		</li>
		<li>
			<label for="gambar">Gambar:</label><br><br>
			<img src="img/<?= $siswa['gambar']; ?>" width="80"><br><br>
			<input type="file" name="gambar" id="gambar"> 
		</li>
		<li>
			<button type="submit" name="submit">ubah Data!</button>
		</li>
	</ul>


</form>


</body>
</html>