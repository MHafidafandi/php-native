<?php
session_start();

if (!isset($_SESSION['login'])) {
	header("Location:login.php");
}
require 'fungsi.php';

// pagination
// konfigurasi
$jumlahPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM siswasiswi"));
$jumlahHalaman = ceil($jumlahData / $jumlahPerhalaman);
if (isset($_GET["halaman"])) {
	$halamanAktif = $_GET["halaman"];
} else {
	$halamanAktif = 1;
}
$awalData = ($jumlahPerhalaman * $halamanAktif) - $jumlahPerhalaman;





$siswa = query("SELECT * FROM siswasiswi LIMIT $awalData,$jumlahPerhalaman ");

if (isset($_POST["cari"])) {
	$siswa = cari($_POST["keyword"]);
}


?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD SMKN 1 PUNGGING</title>
</head>

<body>
	<a href="logout.php">Logout!</a>
	<h1>Daftar Mahasiswa</h1>

	<form method="post" action="">
		<input id="keyword" type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pecarian..." autocomplete="off">
		<button type="submit" name="cari" id="cari">Cari!</button>
		<br><br>
	</form>

	<a href="tambah.php">Tambah Siswa Siswi</a> <br><br>

	<!-- navigasi -->
	<?php if ($halamanAktif > 1) : ?>
		<a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo</a>
	<?php endif; ?>

	<?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
		<?php if ($i == $halamanAktif) : ?>
			<a href="?halaman=<?= $i; ?>" style="font-weight:bold; color:royalblue;"><?= $i; ?></a>
		<?php else : ?>
			<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if ($halamanAktif < $jumlahHalaman) : ?>
		<a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo</a>
	<?php endif; ?>

	<div id="container">
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
				<?php $i = 1; ?>
				<?php foreach ($siswa as $wa) : ?>
					<tr>
						<td>
							<?= $i; ?>
						</td>
						<td>
							<a href="ubah.php?id=<?= $wa["id"]; ?>">ubah</a> |
							<a href="hapus.php?id=<?= $wa["id"]; ?>" onclick="return confirm('yakin');">hapus</a>
						</td>
						<td><img src="img/<?= $wa["gambar"]; ?>" width="50"></td>
						<td><?= $wa["nama"]; ?></td>
						<td><?= $wa["nisn"]; ?></td>
						<td><?= $wa["jurusan"]; ?></td>
						<td><?= $wa["email"]; ?></td>
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>


			</form>
		</table>
	</div>
	<script src=js/script.js></script>
</body>

</html>