<?php
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WEB Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="home.php">WEB GALERI FOTO</a></h1>
			<ul>
				<li><a href="home.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="dataimage.php">Album</a></li>
				<li><a href="logout.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Tambah Data Foto</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<?php $result = mysqli_query($conn, "select * from album");
					$jsArray = "var prdName = new Array();\n";
					echo '<select class="input-control" name="album" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" required>  <option>-Pilih Album Foto-</option>';
					while ($row = mysqli_fetch_array($result)) {
						echo ' <option value="' . $row['AlbumID'] . '!!!'.$row['NamaAlbum'].'">' . $row['NamaAlbum'] . '</option>';
						$jsArray .= "prdName['" . $row['AlbumID'] . "'] = '" . addslashes($row['NamaAlbum']) . "';\n";
					}
					echo '</select>'; ?>
					</select>
					<input type="hidden" name="UserID" value="<?php echo $_SESSION['a_global']->UserID ?>">
					<input type="text" name="username" class="input-control"
						value="<?php echo $_SESSION['a_global']->Username ?>" readonly="readonly">
					<input type="text" name="judul" class="input-control" placeholder="Nama Foto" required>
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br />
					<input type="file" name="foto" class="input-control" required>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
				if (isset($_POST['submit'])) {

					// print_r($_FILES[gambar']);
					// menampung inputan dari form
					$aid = $_POST['album'];
					$namafoto = $_POST['judul'];
					$deskripsi = $_POST['deskripsi'];
					$tgl = date("Y:m:d");
					$uid = $_POST['UserID'];

					// menampung data file yang diupload
					$filename = $_FILES['foto']['name'];
					$tmp_name = $_FILES['foto']['tmp_name'];

					$type1 = explode('.', $filename);
					$type2 = $type1[1];

					$newname = 'asset' . time() . '.' . $type2;

					// menampung data format file yang diizinkan
					$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
					$x=explode('!!!',$aid)[0];
					$z=explode('!!!',$aid)[1];
					$lokasi = '/Asset/AlbumUser/' .$z .'/'. $newname;

					// validasi format file
					if (!in_array($type2, $tipe_diizinkan)) {
						// jika format file tidak ada di dalam tipe diizinkan
						echo '<script>alert("Format file tidak diizinkan")</script>';
					} else {
						// jika format file sesuai dengan yang ada di dalam array tipe diizinkan
						// proses upload file sekaligus insert ke database
						move_uploaded_file($tmp_name, './Asset/AlbumUser/' .$z .'/'. $newname);
						$sql = "INSERT INTO foto(FotoID,JudulFoto,DeskripsiFoto,TanggalUnggah,LokasiFile,AlbumID,UserID) 
						VALUES (null,'$namafoto','$deskripsi','$tgl','$lokasi','$x','$uid')";
						$insert = mysqli_query($conn, $sql) or die(mysqli_error());

						if ($insert) {
							echo '<script>alert("Tambah Foto berhasil")</script>';
							echo '<script>window.location="dataimage.php"</script>';
						} else {
							echo 'gagal' . mysqli_error($conn);

						}
					}


				}
				?>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2024 - Web Galeri Foto.</small>
		</div>
	</footer>
	<script>
		CKEDITOR.replace('deskripsi');
	</script>
	<script type="text/javascript"><?php echo $jsArray; ?></script>
</body>

</html>