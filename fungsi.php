<?php 

//koneksi ke database
$conn = mysqli_connect("localhost","root","","smkn1pungging");

function query($query){
	global $conn;
	$result = mysqli_query($conn,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data){
	global $conn;


	$nisn = htmlspecialchars($data["nisn"]);
	$nama = htmlspecialchars ($data["nama"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$email = htmlspecialchars($data["email"]);

	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO siswasiswi VALUES('id', '$nama', '$nisn', '$jurusan', '$email', '$gambar')";

	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function upload(){
	$namaFile = $_FILES['gambar']['name'];
	$ukuranGambar = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpname = $_FILES['gambar']['tmp_name'];

	// cek apakagh ada gambar yang diupload
	if ($error === 4) {
		echo "<script>
			alert('pilih gambar dulu');
		</script>";
		return false;
	}

	// cek apakah yang diupload gambar?
	$ekstensiValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if ( !in_array($ekstensiGambar, $ekstensiValid)) {
		echo "<script>
			alert('yang anda upload bukan gambar');
		</script>";
		return false;
	}

	// cek jika ukuran terlalu besar
	if ($ukuranGambar > 10000000) {
		echo "<script>
			alert('ukuran gambar terlalu besar');
		</script>";
		return false;
	}

	// lolos pengecekan , siap upload
	// generate nama baru 
	$namaNewFile = uniqid(); //angka random
	$namaNewFile .= '.';
	$namaNewFile .= $ekstensiGambar;

	move_uploaded_file($tmpname, 'img/'. $namaNewFile);
	return $namaNewFile;



}


function hapus($id){
	global $conn;
	mysqli_query($conn,"DELETE FROM siswasiswi WHERE id =$id");
	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$id = $data["id"];
	$nisn = htmlspecialchars($data["nisn"]);
	$nama = htmlspecialchars ($data["nama"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$email = htmlspecialchars($data["email"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	// cek apakah user pilih gambar baru?
	if ($_FILES['gambar']['error']=== 4) {
		$gambar = $gambarLama;
	}else{
		$gambar =upload();
	}


	$query = "UPDATE siswasiswi SET 
				nisn = '$nisn',
				nama = '$nama',
				jurusan = '$jurusan',
				email = '$email',
				gambar = '$gambar'
				WHERE id = $id
				";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$query = "SELECT * FROM siswasiswi 
				WHERE
				nama LIKE '%$keyword%' OR
				nisn LIKE '%$keyword%' OR
				email LIKE '%$keyword%' OR
				jurusan LIKE '%$keyword%'

			";
		return query($query);
}

function registrasi($data){
	global $conn;
	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["password2"]);

	// usename sudah ada atau belum
	$result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
			alert('username sudah ada');
		</script>";
		return false;
	}
	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
			alert('Password tidak sama');
		</script>";
		return false;
	}

	// enkripsi password
	$password =password_hash($password, PASSWORD_DEFAULT);

	// insert user ke database
	mysqli_query($conn,"INSERT INTO user VALUES ('','$username','$password')");

	return mysqli_affected_rows($conn);

}





 ?>