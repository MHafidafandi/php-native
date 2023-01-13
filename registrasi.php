<?php 
require 'fungsi.php';

if ( isset($_POST["register"]) ) {

	if (registrasi($_POST) > 0) {
		echo "<script>
			alert('User baru telah dibuat');
		</script>";
	}else {
		echo mysqli_error($conn);
	}
}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman registrasi</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>
<h1>Halaman Registrasi</h1>
<form action="" method="post">
	<ul>
		<li>
			<label for="username">Username :</label>
			<input type="text" name="username" id="username"> 
		</li>
		<li>
			<label for="password">Password :</label>
			<input type="password" name="password" id="password"> 
		</li>
		<li>
			<label for="password2">Konfirmasi password :</label>
			<input type="password" name="password2" id="password2"> 
		</li>
		<li>
			<button type="submit" name="register">Register!</button>
		</li>
	</ul>
</form>
</body>
</html>