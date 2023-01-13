<?php 
session_start();


if (!isset($_SESSION['login'])) {
	header("Location:login.php");
}
require 'fungsi.php';
// cek tombol submit ditekan atau belum

if (isset($_POST['submit'])) {


	if ( tambah($_POST)>0) {
		echo "<script>
			alert('Data berhasil ditambahkan!');
			document.location.href = 'index.php';
		</script>";
	}else {
		echo "<script>
			alert('Data gagal ditambahkan!');
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
	<title>tambah data siswa siswi</title>
</head>
<body>

<h1>Tambah Data Siswa Siswi</h1>
<form method="post" action="" enctype="multipart/form-data">
	<ul>
		<li>
			<label for="nisn">Nisn : </label>
			<input type="text" name="nisn" required>
		</li>
		<li>
			<label for="nama">Nama:</label>
			<input type="text" name="nama" id="nama" required> 
		</li>
		<li>
			<label for="jurusan">Jurusan:</label>
			<input type="text" name="jurusan" id="jurusan" required> 
		</li>
		<li>
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" required> 
		</li>
		<li>
			<label for="gambar">Gambar:</label>
			<input type="file" name="gambar" id="gambar"> 
		</li>
		<li>
			<button type="submit" name="submit">Tambah Data!</button>
		</li>
	</ul>


</form>


</body>
</html>