<?php 

 //koneksi ke database
$conn = mysqli_connect("localhost","root","","smkn1pungging");

// ambil data atau query dari tabel
$result=mysqli_query($conn,"SELECT * FROM siswasiswi");

// ambil data siswa dari object result
// mysqli_fetch_row() mengembalikan array numerik
// mysqli_fetch_assoc() mengembalikan array assosiatif
// mysqli_fetch_array() mengembalikan 22 nya tapi datanya dobble

$ss=mysqli_fetch_assoc($result);




 ?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD SMKN 1 PUNGGING</title>
</head>
<body>
	<h1>Daftar Mahasiswa</h1>

<table cellpadding="10" border="1" cellspacing="0">
	<tr>
		<th>no</th>
		<th>aksi</th>
		<th>gambar</th>
		<th>nama</th>
		<th>nisn</th>
		<th>jurusan</th>
		<th>email</th>
	</tr>

<form method="post" action="">

<?php foreach ($ss as $wa) : ?>
		<tr>
		<td>1</td>
		<td>
			<a href="">ubah</a>
			<a href="">hapus</a>
		</td>
		<td><img src="img/hafid.jpg" width="50"></td>
		<td><?= $wa["nama"]; ?></td>
		<td>08374704</td>
		<td>teknik komputer</td>
		<td>afandimboizz@gmail.com</td>
	</tr>
<?php endforeach; ?>


</form>
</table>
</body>
</html>